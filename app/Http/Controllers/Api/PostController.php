<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Transformers\PostTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\ResourceInterface;

class PostController extends Controller
{
  private $postTransform;
  private $fractal;

  function __construct(Manager $fractal, PostTransformer $postTransform)
  {
      $this->fractal = $fractal;
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
    $this->fractal->parseIncludes($request->get('include', ''));
    $dataPaginator = Post::getEmailList($request);
    $data = new Collection($dataPaginator->items(), $this->postTransform);
    $data->setPaginator(new IlluminatePaginatorAdapter($dataPaginator));
    $data = $this->fractal->createData($data);

    return $this->responseSuccess($data->toArray());
  }

  /*  公开邮件，列表详情  */
  public function show (Request $request)
  {
    // $this->fractal->parseIncludes($request->get('include', ''));
    $data = Post::getEmail($request);
    // $data = new Collection($data, $this->postTransform);
    // $data = $this->fractal->createData($data);
    return $this->responseSuccess($data);
  }

  /*  用户邮件列表  */
  public function userPostList (Request $request)
  {
    $this->fractal->parseIncludes($request->get('include', ''));
    $dataPaginator = Post::getUserEmail($request);
    $data = new Collection($dataPaginator->items(), $this->postTransform);
    $data->setPaginator(new IlluminatePaginatorAdapter($dataPaginator));
    $data = $this->fractal->createData($data);

    return $this->responseSuccess($data->toArray());
  }

}
