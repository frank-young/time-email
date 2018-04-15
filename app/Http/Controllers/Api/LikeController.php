<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Letter;

class LikeController extends Controller
{
    public function incrementLikeCount (Request $request)
    {
      $res = Like::saveData($request);
      if ($res) {
        Letter::find($request->letter_id)->increment('like_count', 1);
      }
      return $this->responseOk('点赞成功');
    }

    public function decrementLikeCount (Request $request)
    {
      $res = Like::deleteData($request);
      if ($res) {
        Letter::find($request->letter_id)->decrement('like_count', 1);
      }
      return $this->responseOk('取消点赞成功');
    }
}
