<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * 收货地址
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function(Blueprint $table){
        $table->increments('id');
        $table->integer('wxuser_id')->default(0)->comment('用户id');
        $table->string('name')->comment('收货人');
        $table->string('country')->comment('国家');
        $table->string('province')->comment('省份');
        $table->string('city')->comment('城市');
        $table->string('district')->comment('区县');
        $table->string('address')->comment('详细地址');
        $table->string('mobile')->comment('手机');
        $table->string('postal_code')->nullable()->comment('邮编');
        $table->tinyInteger('is_default')->default(0)->comment('是否默认地址');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
