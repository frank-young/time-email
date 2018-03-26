<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxUsersTable extends Migration
{
    /**
     * 微信用户表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wx_users',function(Blueprint $table){
            $table->increments('id');
            $table->string('nickname')->default('匿名用户')->comment('微信昵称');
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('phone')->nullable()->comment('手机号');
            $table->tinyInteger('gender')->default(0)->comment('性别');
            $table->string('birthday')->nullable()->comment('生日');
            $table->string('country')->nullable()->comment('国家');
            $table->string('province')->nullable()->comment('省份');
            $table->string('city')->nullable()->comment('城市');
            $table->string('token')->nullable()->comment('第三方token');
            $table->string('openid')->comment('微信openid');

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
        Schema::dropIfExists('wx_users');
    }
}
