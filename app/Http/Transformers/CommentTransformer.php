<?php

namespace App\Http\Transformers;

use App;
use App\Models\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'wxuser'
    ];

    public function transform(Comment $comment)
    {
        return [
          'id'   => $comment['id'],
          'letter_id'   => $comment['letter_id'],
          'comment_id' => $comment['comment_id'],
          'content' => $comment['content'],
          'images' => $comment['images'],
          'wxuser_id' => $comment['wxuser_id'],
          'to_wxuser_id' => $comment['to_wxuser_id'],
          'comment_like_count' => $comment['comment_like_count']
        ];
    }

    public function includeWxUser(Comment $comment)
    {
        return $this->item($comment->wxuser, App::make(WxUserTransformer::class));
    }
}
