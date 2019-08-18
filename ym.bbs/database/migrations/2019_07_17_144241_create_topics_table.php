<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('title')->nullable(false);
            $table->text('content')->nullable(false);
            $table->integer('user_id')->unsigned()->nullable(false)->index('user_id');
            $table->integer('categorie_id')->unsigned()->nullable(false)->index('categorie_id');
            $table->integer('reply_count')->unsigned()->nullable(false)->default(0);
            $table->integer('view_count')->unsigned()->nullable(false)->default(0);
            $table->integer('order')->unsigned()->nullable(false)->default(0);
            $table->text('excerpt')->nullable();
            $table->string('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
