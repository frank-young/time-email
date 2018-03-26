<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WxUser extends Model
{
  public static function saveData ($data) {
    $user = WxUser::where(['openid' => $data['openId']])->first();
    if (empty($user)) {
      // $wx_user = new WxUser;
      // $wx_user->nickname = $data['nickName'];
      // $wx_user->avatar = $data['avatarUrl'];
      // $wx_user->gender = $data['gender'];
      // $wx_user->country = $data['country'];
      // $wx_user->province = $data['province'];
      // $wx_user->city = $data['city'];
      // $wx_user->openid = $data['openId'];
      // $wx_user->save();
      $wx_user = WxUser::created($data);
      $res = [
        'userInfo' => [
          'nickname' => $wx_user->nickname,
          'avatar' => $wx_user->avatar,
        ],
        'token' => $wx_user->id
      ];
    } else {
      $res = [
        'userInfo' => [
          'nickname' => $user->nickname,
          'avatar' => $user->avatar,
        ],
        'token' => $user->id
      ];
    }

    return $res;
  }

  public function toArray()
  {
      return [
          'errcode' => 0,
          'success' => true,
          'content' => '查询成功'
      ];
  }

}
