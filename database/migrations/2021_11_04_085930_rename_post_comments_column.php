<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePostCommentsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_comments', function(Blueprint $table) {
            $table->renameColumn('writer_id', 'writer_user_id');
            $table->renameColumn('receiver_id', 'receiver_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_comments', function(Blueprint $table) {
            $table->renameColumn('writer_user_id', 'writer_id');
            $table->renameColumn('receiver_user_id', 'receiver_id');
        });
    }
}
