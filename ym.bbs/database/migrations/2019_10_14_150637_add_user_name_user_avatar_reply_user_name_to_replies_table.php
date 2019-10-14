<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserNameUserAvatarReplyUserNameToRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->string('user_name')->nullable(false);
            $table->string('user_avatar')->nullable(false);
            $table->string('reply_user_name')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->dropColumn('user_name');
            $table->dropColumn('user_avatar');
            $table->dropColumn('reply_user_name');
        });
    }
}
