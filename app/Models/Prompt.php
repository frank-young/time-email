<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prompt extends Model
{
  protected $fillable = [
      'tips',
      'title_placeholder',
      'letter_placeholder',
      'success_tip',
      'images_url',
      'share_message',
      'text1',
      'text2',
      'text3'
    ];

    public static function saveData ($request) {
      return self::create($request->all());
    }

    public static function getData ($request) {
      $data = self::where([
        'id' => 1,
        ])->first();
      return $data;
    }
}
