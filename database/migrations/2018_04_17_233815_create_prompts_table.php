<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromptsTable extends Migration
{
    /**
     * 系统数据
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prompts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tips')->nullable()->comment('顶部文字');
            $table->string('title_placeholder')->nullable()->comment('标题提示');
            $table->string('letter_placeholder')->nullable()->comment('内容提示');
            $table->text('success_tip')->nullable()->comment('成功内容提示');
            $table->text('images_url')->nullable()->comment('图片');
            $table->string('share_message')->nullable()->comment('分享文字');
            $table->text('text1')->nullable()->comment('文字1');
            $table->text('text2')->nullable()->comment('文字2');
            $table->text('text3')->nullable()->comment('文字3');

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
        Schema::dropIfExists('prompts');
    }
}
