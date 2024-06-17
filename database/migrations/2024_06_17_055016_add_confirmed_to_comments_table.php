<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConfirmedToCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->boolean('confirmed')->default(false);
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('confirmed');
        });
    }
};

