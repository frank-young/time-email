<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Transformers\PostTransformer;

class PostController extends Controller
{
  protected $postTransform;
  public function __construct(PostTransformer $postTransform)
  {
      $this->postTransform = $postTransform;
  }

  /*  提交邮件  */
  public function store (Request $request)
  {
    $data = Post::saveEmail($request);
    // return $this->response->item($data, new PostTransformer());
    return $this->responseOk('添加成功');
  }

  /*  公开邮件列表，只会显示已到达的邮件  */
  public function publicList (Request $request)
  {
    $data = Post::getEmailList($request);
    return $this->responseSuccess($this->postTransform->transforms($data->toArray()));
  }

  /*  用户邮件列表  */
  public function userPostList (Request $request)
  {
    $data = Post::getUserEmail($request);
    return $this->responseSuccess($this->postTransform->transforms($data->toArray()));
  }

}
