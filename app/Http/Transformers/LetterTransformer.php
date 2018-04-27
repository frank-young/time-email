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
          'id'   => $letter['id'],
          'title'   => $letter['title'],
          'content' => $letter['content'],
          'images' => $letter['images'],
          'arrive_time' => $letter['arrive_time'],
          'arrive_status' => $letter['arrive_status'],
          'is_public' => $letter['is_public'],
          'like_count' => $letter['like_count'],
          'is_like' => $letter['is_like'],
          'comment_count' => $letter['comment_count'],
          'create_date' => date('Y年m月d日', strtotime($letter['created_at'])),
          'arrive_date' => date('Y年m月d日', strtotime($letter['arrive_time'])),
          'create_time' => $letter['created_at']
        ];
    }

    public function includeWxUser(Letter $letter)
    {
        return $this->item($letter->wxuser, App::make(WxUserTransformer::class));
    }
}
