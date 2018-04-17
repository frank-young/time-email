<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Letter;
use App\Http\Transformers\LetterTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
// use League\Fractal\Resource\ResourceInterface;

class LetterController extends Controller
{
  private $letterTransform;
  private $fractal;

  function __construct(Manager $fractal, LetterTransformer $letterTransform)
  {
      $this->fractal = $fractal;
      $this->letterTransform = $letterTransform;
  }

  /*  提交邮件  */
  public function store (Request $request)
  {
    $data = Letter::saveLetter($request);
    return $this->responseOk('添加成功');
  }

  /*  公开邮件列表，只会显示已到达的邮件  */
  public function publicList (Request $request)
  {
    $this->fractal->parseIncludes($request->get('include', ''));
    $dataPaginator = Letter::getLetterList($request);
    $data = new Collection($dataPaginator->items(), $this->letterTransform);
    $data->setPaginator(new IlluminatePaginatorAdapter($dataPaginator));
    $data = $this->fractal->createData($data);

    return $this->responseSuccess($data->toArray());
  }

  /*  公开邮件，列表详情  */
  public function show (Request $request)
  {
    $this->fractal->parseIncludes($request->get('include', ''));
    $data = Letter::getLetter($request);
    $data = new Item($data, $this->letterTransform);
    $data = $this->fractal->createData($data);
    return $this->responseSuccess($data->toArray());
  }

  /*  用户邮件列表  */
  public function userLetterList (Request $request)
  {
    $this->fractal->parseIncludes($request->get('include', ''));
    $dataPaginator = Letter::getUserLetter($request);
    $data = new Collection($dataPaginator->items(), $this->letterTransform);
    $data->setPaginator(new IlluminatePaginatorAdapter($dataPaginator));
    $data = $this->fractal->createData($data);

    return $this->responseSuccess($data->toArray());
  }

  /*  检查邮件到达状态 ，轮训调用 */
  public function postArrived (Request $request)
  {
    $now_time = date("Y-m-d H:i:s");
    $data = Letter::where('arrive_time', '<=', $now_time)->update(['arrive_status' => 1]);
    return $this->responseSuccess($data);
  }

}
