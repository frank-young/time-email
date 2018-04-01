<?php

namespace App\Http\Transformers;

use App\Models\Post;

class PostTransformer extends Transformer
{
    public function transform(array $post)
    {
        return [
          'title'   => $post['title'],
      ];
    }
}
