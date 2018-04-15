<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * 评论表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('letter_id')->default(0)->comment('邮件id');
            $table->integer('comment_id')->default(0)->comment('评论id，用于回复评论');
            $table->string('content')->nullable()->comment('评论内容');
            $table->text('images')->nullable()->comment('图片');
            $table->integer('wxuser_id')->default(0)->comment('用户id');
            $table->integer('to_wxuser_id')->default(0)->comment('用户id');
            $table->integer('comment_like_count')->default(0)->comment('评论喜欢数量');

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
        Schema::dropIfExists('comments');
    }
}
