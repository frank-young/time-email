<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Transformers\CommentTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Models\Letter;

class CommentController extends Controller
{
  private $commentTransform;
  private $fractal;

  function __construct(Manager $fractal, CommentTransformer $commentTransform)
  {
      $this->fractal = $fractal;
      $this->commentTransform = $commentTransform;
  }

  /*  提交邮件  */
  public function store (Request $request)
  {
    $data = Comment::saveData($request);
    Letter::find($request->letter_id)->increment('comment_count', 1);
    return $this->responseOk('评论成功');
  }

  /*  公开邮件列表，只会显示已到达的邮件  */
  public function list (Request $request)
  {
    $this->fractal->parseIncludes($request->get('include', ''));
    $dataPaginator = Comment::getList($request);
    $data = new Collection($dataPaginator->items(), $this->commentTransform);
    $data->setPaginator(new IlluminatePaginatorAdapter($dataPaginator));
    $data = $this->fractal->createData($data);

    return $this->responseSuccess($data->toArray());
  }

  public function incrementLikeCount (Request $request)
  {
    Comment::find($request->id)->increment('comment_like_count', 1);
    return $this->responseOk('点赞成功');
  }

  public function decrementLikeCount (Request $request)
  {
    Comment::find($request->id)->decrement('comment_like_count', 1);
    return $this->responseOk('取消点赞成功');
  }

}
