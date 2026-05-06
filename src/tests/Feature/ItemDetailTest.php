<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Category;
use App\Enums\Condition;
use App\Models\ItemCategory;
use Database\Seeders\CategorySeeder;

class ItemDetailTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(CategorySeeder::class);
    }

    public function test_7_1(): void
    {
        $likeUser1 = User::factory()->create();
        $likeUser2 = User::factory()->create();
        $commentUser = User::factory()->create();
        $item = Item::factory()->create([
            'name' => 'テスト商品',
            'price' => '777',
            'brand' => 'テストブランド',
            'description' => 'テスト商品説明',
            'image' => 'test/image.jpg',
            'condition' => Condition::BadCondition,
        ]);
        $like = Like::create([
            'user_id' => $likeUser1->id,
            'item_id' => $item->id,
        ]);
        $like = Like::create([
            'user_id' => $likeUser2->id,
            'item_id' => $item->id,
        ]);
        $comment = Comment::create([
            'user_id' => $commentUser->id,
            'item_id' => $item->id,
            'comment' => 'テストコメント99',
        ]);
        $comment = Comment::create([
            'user_id' => $commentUser->id,
            'item_id' => $item->id,
            'comment' => 'テストコメント999',
        ]);
        $comment = Comment::create([
            'user_id' => $commentUser->id,
            'item_id' => $item->id,
            'comment' => 'テストコメント9999',
        ]);

        $response = $this->get('/item/' . $item->id);

        $response->assertStatus(200);
        $response->assertSee('テスト商品');
        $response->assertSee('テストブランド');
        $response->assertSee('777');
        $response->assertSee('テスト商品説明');
        $response->assertSee('test/image.jpg');
        $response->assertSee('状態が悪い');
        $response->assertSee($commentUser->id);
        $response->assertSee(['テストコメント99', 'テストコメント999', 'テストコメント9999']);
        $response->assertSee('2'); // いいね数
        $response->assertSee('3'); // コメント数
    }

    public function test_7_2(): void
    {
        $item = Item::factory()->create();
        ItemCategory::create(['item_id' => $item->id,'category_id' => '1']);
        ItemCategory::create(['item_id' => $item->id,'category_id' => '4']);
        ItemCategory::create(['item_id' => $item->id,'category_id' => '11']);

        $response = $this->get('/item/' . $item->id);

        $response->assertStatus(200);
        $response->assertSee('ファッション');
        $response->assertSee('レディース');
        $response->assertSee('ハンドメイド');

    }
}
