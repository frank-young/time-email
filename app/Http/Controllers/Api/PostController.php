<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Transformers\PostTransformer;

class PostController extends Controller
{
  /*  提交邮件  */
  public function store (Request $request)
  {
    $data = Post::saveEmail($request);
    return $this->response->item($data, new PostTransformer());
  }
}
