<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\User;
use App\Models\ItemCategory;
use App\Enums\Condition;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::insert([
            ['user_id' => User::inRandomOrder()->first()->id, 'name' => '腕時計', 'price' => '15000', 'brand' => 'Rolax', 'description' => 'スタイリッシュなデザインのメンズ腕時計', 'image' => 'items/item1.jpg', 'condition' => Condition::GoodCondition->value],
            ['user_id' => User::inRandomOrder()->first()->id, 'name' => 'HDD', 'price' => '5000', 'brand' => '西芝', 'description' => '高速で信頼性の高いハードディスク', 'image' => 'items/item2.jpg', 'condition' => Condition::NoScratches->value],
            ['user_id' => User::inRandomOrder()->first()->id, 'name' => '玉ねぎ3束', 'price' => '300', 'brand' => 'なし', 'description' => '新鮮な玉ねぎ3束のセット', 'image' => 'items/item3.jpg', 'condition' => Condition::SlightScratches->value],
            ['user_id' => User::inRandomOrder()->first()->id, 'name' => '革靴', 'price' => '4000', 'brand' => null, 'description' => 'クラシックなデザインの革靴', 'image' => 'items/item4.jpg', 'condition' => Condition::BadCondition->value],
            ['user_id' => User::inRandomOrder()->first()->id, 'name' => 'ノートPC', 'price' => '45000', 'brand' => null, 'description' => '高性能なノートパソコン', 'image' => 'items/item5.jpg', 'condition' => Condition::GoodCondition->value],
            ['user_id' => User::inRandomOrder()->first()->id, 'name' => 'マイク', 'price' => '8000', 'brand' => 'なし', 'description' => '高音質のレコーディング用マイク', 'image' => 'items/item6.jpg', 'condition' => Condition::NoScratches->value],
            ['user_id' => User::inRandomOrder()->first()->id, 'name' => 'ショルダーバッグ', 'price' => '3500', 'brand' => null, 'description' => 'おしゃれなショルダーバッグ', 'image' => 'items/item7.jpg', 'condition' => Condition::SlightScratches->value],
            ['user_id' => User::inRandomOrder()->first()->id, 'name' => 'タンブラー', 'price' => '500', 'brand' => 'なし', 'description' => '使いやすいタンブラー', 'image' => 'items/item8.jpg', 'condition' => Condition::BadCondition->value],
            ['user_id' => User::inRandomOrder()->first()->id, 'name' => 'コーヒーミル', 'price' => '4000', 'brand' => 'Starbacks', 'description' => '手動のコーヒーミル', 'image' => 'items/item9.jpg', 'condition' => Condition::GoodCondition->value],
            ['user_id' => User::inRandomOrder()->first()->id, 'name' => 'メイクセット', 'price' => '2500', 'brand' => null, 'description' => '便利なメイクアップセット', 'image' => 'items/item10.jpg', 'condition' => Condition::NoScratches->value],
        ]);

        ItemCategory::insert([
            ['item_id' => Item::where('name', '腕時計')->first()->id, 'category_id' => 1],
            ['item_id' => Item::where('name', '腕時計')->first()->id, 'category_id' => 5],
            ['item_id' => Item::where('name', '腕時計')->first()->id, 'category_id' => 12],
            ['item_id' => Item::where('name', 'HDD')->first()->id, 'category_id' => 2],
            ['item_id' => Item::where('name', '玉ねぎ3束')->first()->id, 'category_id' => 10],
            ['item_id' => Item::where('name', '玉ねぎ3束')->first()->id, 'category_id' => 11],
            ['item_id' => Item::where('name', '革靴')->first()->id, 'category_id' => 1],
            ['item_id' => Item::where('name', '革靴')->first()->id, 'category_id' => 5],
            ['item_id' => Item::where('name', 'ノートPC')->first()->id, 'category_id' => 2],
            ['item_id' => Item::where('name', 'マイク')->first()->id, 'category_id' => 2],
            ['item_id' => Item::where('name', 'ショルダーバッグ')->first()->id, 'category_id' => 4],
            ['item_id' => Item::where('name', 'タンブラー')->first()->id, 'category_id' => 10],
            ['item_id' => Item::where('name', 'コーヒーミル')->first()->id, 'category_id' => 10],
            ['item_id' => Item::where('name', 'メイクセット')->first()->id, 'category_id' => 6],
        ]);

    }
}