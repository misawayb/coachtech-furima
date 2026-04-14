<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store($item_id, CommentRequest $request)
    {
        $user_id = auth()->id();
        $comment = $request->input('comment');
        Comment::create(['item_id' => $item_id, 'user_id' => $user_id, 'comment' => $comment]);

        return redirect(route('item.show', ['item_id' => $item_id,]));
    }
}
