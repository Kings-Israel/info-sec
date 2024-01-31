<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_session', function (Blueprint $table) {
            $table->id();
            $table->unique(['visitor_id', 'session_id']);
            $table->foreignId('visitor_id')->references('id')->on('visitors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('session_id')->references('id')->on('sessions')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('visitor_session');
    }
}
