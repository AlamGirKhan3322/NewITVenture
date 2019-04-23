<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msgs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('msgbody');
            $table->unsignedInteger('role_id')->nullable();
            $table->unsignedInteger('member_id');
            $table->foreign('role_id')->references('id')->on('team_roles')->OnDelete('SET NULL');
            $table->foreign('member_id')->references('id')->on('team_members')->OnDelete('CASCADE');
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
        Schema::dropIfExists('msgs');
    }
}
