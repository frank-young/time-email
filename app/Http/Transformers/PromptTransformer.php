<?php

namespace App\Http\Transformers;

use App;
use App\Models\Prompt;
use League\Fractal\TransformerAbstract;

class PromptTransformer extends TransformerAbstract
{
    public function transform(Prompt $prompt)
    {
        return [
          'id'   => $prompt['id'],
          'tips'   => $prompt['tips'],
          'title_placeholder' => $prompt['title_placeholder'],
          'letter_placeholder' => $prompt['letter_placeholder'],
          'success_tip' => $prompt['success_tip'],
          'images_url' => $prompt['images_url']
        ];
    }
}
