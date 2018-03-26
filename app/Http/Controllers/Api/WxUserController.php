<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Transformers\PostTransformer;

class WxUserController extends Controller
{
  public function login(Request $request)
  {
    $options = [
      'mini_program' => [
        'app_id'   => '----',
        'secret'   => '----',
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
    $wxuser = WxUser::saveData($unique_id, $data);

    $res = returnCode(true,'获取成功', $wxuser);
    return response()->json($res);
  }

  public function show (Request $request)
  {
    $data = Post::getEmail($request);
    return $this->response->item($data, new PostTransformer());
  }
}
