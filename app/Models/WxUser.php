<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WxUser extends Model
{
  public static function saveData ($data) {
    $user = WxUser::where(['openid' => $data['openId']])->first();
    $file_name = md5($data['openId']);
    if (empty($user)) {
      if ($data['network'] == 'web') {
        $identicon = new \Identicon\Identicon();
        $imageData = $identicon->getImageData(substr($file_name, 1, rand(3, 25)), 150);
        Storage::disk('local')->put('public/avatar/'.$file_name.'.jpg', $imageData);
        $data['avatarUrl'] = 'http://'.$_SERVER['HTTP_HOST'].'/storage/avatar/'.$file_name.'.jpg';
      }
      $wx_user = new WxUser;
      $wx_user->nickname = $data['nickName'];
      $wx_user->avatar = $data['avatarUrl'];
      $wx_user->gender = $data['gender'];
      $wx_user->country = $data['country'];
      $wx_user->province = $data['province'];
      $wx_user->city = $data['city'];
      $wx_user->openid = $data['openId'];
      $wx_user->save();
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

    public function posts()
    {
    return $this->hasMany(Post::class);
    }

}
