<?php

namespace App\Http\Transformers;

use App\Models\WxUser;
use League\Fractal\TransformerAbstract;

class WxUserTransformer extends TransformerAbstract
{
    public function transform(WxUser $wxuser)
    {
        return [
          'nickname' => $wxuser['nickname'],
          'avatar' => $wxuser['avatar']
        ];
    }
}
