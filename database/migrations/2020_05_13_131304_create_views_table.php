<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('watched')->default(0);
            $table->bigInteger('post_id')->unsigned();
            //создание внешнего ключа для поля 'user_id', который связан с полем id таблицы 'users'
            $table->foreign('post_id')->references('id')->on('posts');
            $table->bigInteger('user_id')->unsigned();
            //создание внешнего ключа для поля 'user_id', который связан с полем id таблицы 'users'
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('views');
    }
}
