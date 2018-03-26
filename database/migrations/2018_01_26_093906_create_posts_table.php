<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * 邮件表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->text('content')->comment('内容');
            $table->text('images')->nullable()->comment('图片');
            $table->dateTime('arrive_time')->comment('到达时间');
            $table->tinyInteger('arrive_status')->default(0)->comment('到达状态，1: 已到达，0:未到达');
            $table->tinyInteger('is_public')->default(1)->comment('是否公开，1:是，0:否');
            $table->string('email')->comment('接收的邮箱');
            $table->string('phone')->comment('接收的手机号');
            $table->integer('wxuser_id')->default(0)->comment('接收的微信用户id');
            $table->tinyInteger('type')->default(0)->comment('寄送方式，0:邮件/手机寄送，平台查看，1:真实快递寄送');
            $table->integer('address_id')->default(0)->nullable()->comment('收货地址id');
            $table->integer('like_count')->default(0)->comment('喜欢数量');
            $table->integer('comment_count')->default(0)->comment('评论数量');

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
        Schema::dropIfExists('posts');
    }
}
