<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\WxUser;

class Comment extends Model
{
    protected $fillable = [
      'letter_id',
      'comment_id',
      'content',
      'images',
      'wxuser_id',
      'to_wxuser_id',
      'comment_like_count'
    ];

    // 保存评论
    public static function saveData ($request) {
      return self::create($request->all());
    }

    // 评论列表
    public static function getList ($request) {
      return self::where([
        'letter_id' => $request->letter_id
        ])->paginate($request->page_size);
    }

    public function wxuser()
    {
        return $this->belongsTo(WxUser::class);
    }
}
