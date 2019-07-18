<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('emails');
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->index('link_id');
            $table->string('email',255);
            $table->timestamps();
            $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emails', function(Blueprint $table)
        {
            $table->dropForeign('link_id');
        });
        Schema::dropIfExists('emails');
    }
}
