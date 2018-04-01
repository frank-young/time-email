<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
      'title',
      'content',
      'images',
      'arrive_time',
      'arrive_status',
      'is_public',
      'email',
      'phone',
      'wxuser_id',
      'type',
      'address_id',
      'like_count',
      'comment_count'
    ];

    // 保存邮件
    public static function saveEmail ($request) {
      return self::create($request->all());
    }

    // 查询个人邮件
    public static function getEmailList ($request) {
      return self::where([
        'arrive_status' => 1,
        'is_public' => 1
        ])->get();
    }

    // 查询个人邮件
    public static function getUserEmail ($request) {
      return self::where([
        'wxuser_id' => $request->wxuser_id,
        'arrive_status' => 1
        ])->get();
    }
}
