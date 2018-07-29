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
        $content = $letter['content'];
        $description = mb_strlen($content) > 60 ? mb_substr($content, 0, 60, 'utf-8').'...' : $content;
        $arrive_time_stemp = strtotime($letter['arrive_time']);
        $created_at_stemp = strtotime($letter['created_at']);
        $diff = $this->timediff($arrive_time_stemp, $created_at_stemp);
        $meta = '寄给'.$diff.'后';

        return [
          'id'   => $letter['id'],
          'title'   => $letter['title'],
          'meta'   => $meta,
          'description' => $description,
          'content' => $letter['content'],
          'images' => $letter['images'],
          'arrive_time' => $letter['arrive_time'],
          'arrive_status' => $letter['arrive_status'],
          'is_public' => $letter['is_public'],
          'like_count' => $letter['like_count'],
          'is_like' => $letter['is_like'],
          'comment_count' => $letter['comment_count'],
          'create_date' => date('Y-m-d', $created_at_stemp),
          'arrive_date' => date('Y', $arrive_time_stemp),
          'create_time' => $letter['created_at']
        ];
    }

    public function includeWxUser(Letter $letter)
    {
        return $this->item($letter->wxuser, App::make(WxUserTransformer::class));
    }

    function timediff( $begin_time, $end_time )
    {
      if ( $begin_time < $end_time ) {
        $starttime = $begin_time;
        $endtime = $end_time;
      } else {
        $starttime = $end_time;
        $endtime = $begin_time;
      }
      $timediff = $endtime - $starttime;
      $years = intval( $timediff / 31536000 );
      $months = intval( $timediff / 2628000 );

      return $years != 0 ? $years.'年' : $months.'月';
    }
}
