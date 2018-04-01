<?php

namespace App\Models;

use App\Models\WxUser;
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

    // 公开邮件列表
    public static function getEmailList ($request) {
      return self::where([
        'arrive_status' => 1,
        'is_public' => 1
        ])->paginate($request->page_size);
    }

    // 公开邮件详情
    public static function getEmail ($request) {
      return self::where([
        'id' => $request->id,
        'arrive_status' => 1,
        'is_public' => 1
        ])->first();
    }

    // 查询个人邮件
    public static function getUserEmail ($request) {
      return self::where([
        'wxuser_id' => $request->wxuser_id,
        'arrive_status' => 1
        ])->paginate($request->page_size);
    }

    public function wxuser()
    {
        return $this->belongsTo(WxUser::class);
    }
}
