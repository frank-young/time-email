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

    public function toArray()
    {
        return [
            'errcode' => 0,
            'success' => true,
            'content' => '添加成功'
        ];
    }

    // 查询个人邮件
    public static function getEmail ($request) {
      return self::where(['wxuser_id' => $request->wxuser_id])->get();
    }
}
