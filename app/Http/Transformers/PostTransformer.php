<?php

namespace App\Http\Transformers;

use App;
use App\Models\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'wxuser'
    ];

    public function transform(Post $post)
    {
        return [
          'title'   => $post['title'],
          'content' => $post['content'],
          'images' => $post['images'],
          'arrive_time' => $post['arrive_time'],
          'arrive_status' => $post['arrive_status'],
          'is_public' => $post['is_public'],
          'like_count' => $post['like_count'],
          'comment_count' => $post['comment_count']
        ];
    }

    public function includeWxUser(Post $post)
    {
        return $this->item($post->wxuser, App::make(WxUserTransformer::class));
    }
}
