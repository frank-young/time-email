<?php

namespace App\Http\Transformers;

use App;
use App\Models\Letter;
use League\Fractal\TransformerAbstract;

class LetterTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'wxuser'
    ];

    public function transform(Letter $letter)
    {
        return [
          'title'   => $letter['title'],
          'content' => $letter['content'],
          'images' => $letter['images'],
          'arrive_time' => $letter['arrive_time'],
          'arrive_status' => $letter['arrive_status'],
          'is_public' => $letter['is_public'],
          'like_count' => $letter['like_count'],
          'comment_count' => $letter['comment_count']
        ];
    }

    public function includeWxUser(Letter $letter)
    {
        return $this->item($letter->wxuser, App::make(WxUserTransformer::class));
    }
}
