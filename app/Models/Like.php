<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  protected $fillable = [
    'letter_id',
    'wxuser_id'
  ];

  public static function saveData ($request) {
    $count = self::where([
      'wxuser_id' => $request->wxuser_id,
      'letter_id' => $request->letter_id
    ])->count();
    if ($count == 0) {
      self::create($request->all());
    }
    return $count == 0;
  }

  public static function deleteData ($request) {
    $data = self::where([
      'wxuser_id' => $request->wxuser_id,
      'letter_id' => $request->letter_id
    ]);
    if ($data->count() != 0) {
      $data->delete();
      return true;
    } else {
      return false;
    }
  }
}
