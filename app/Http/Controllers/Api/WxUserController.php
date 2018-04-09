<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use EasyWeChat\Foundation\Application;
use App\Models\WxUser;

class WxUserController extends Controller
{

  public function login(Request $request)
  {
    $options = [
      'mini_program' => [
        'app_id'   => 'wx1c426b7c3311c97d',
        'secret'   => '96e7138c8f77743424de076871a39629',
        // token 和 aes_key 开启消息推送后可见
        'token'    => 'your-token',
        'aes_key'  => 'your-aes-key'
      ]
    ];
    $app = new Application($options);
    $code = $request->input('code');
    $session_key = $app->mini_program->sns->getSessionKey($code)->session_key;
    $iv = $request->input('userInfo.iv');
    $encryptedData = $request->input('userInfo.encryptedData');
    $data = $app->mini_program->encryptor->decryptData($session_key, $iv, $encryptedData);
    $wxuser = WxUser::saveData($data);

    return $this->responseSuccess($wxuser);
  }
}
