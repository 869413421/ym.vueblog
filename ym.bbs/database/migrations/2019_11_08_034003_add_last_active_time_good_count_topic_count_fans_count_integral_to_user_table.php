<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastActiveTimeGoodCountTopicCountFansCountIntegralToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->date('last_active_time')->nullable(false)->default('2001-01-01 00:00:00');
            $table->integer('good_count')->unsigned()->nullable(false)->default(0);
            $table->integer('topic_count')->unsigned()->nullable(false)->default(0);
            $table->integer('fans_count')->unsigned()->nullable(false)->default(0);
            $table->integer('integral')->unsigned()->nullable(false)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->dropColumn('last_active_time');
            $table->dropColumn('good_count');
            $table->dropColumn('topic_count');
            $table->dropColumn('fans_count');
            $table->dropColumn('integral');
        });
    }
}
