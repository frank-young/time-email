<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Prompt;

class PromptController extends Controller
{
    public function store (Request $request)
    {
      $data = Prompt::saveData($request);
      return $this->responseOk('添加成功');
    }

    public function show (Request $request)
    {
      $data = Prompt::getData($request);
      return $this->responseSuccess($data);
    }
}
