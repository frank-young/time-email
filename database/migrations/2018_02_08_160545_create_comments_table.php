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
            $table->integer('post_id')->default(0)->comment('邮件id');
            $table->string('content')->nullable()->comment('回复内容');
            $table->text('images')->nullable()->comment('图片');
            $table->integer('from_wxuser_id')->default(0)->comment('用户id');
            $table->integer('to_wxuser_id')->default(0)->comment('用户id');

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
