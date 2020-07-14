<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_group', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('activity_id')->unsigned();
            $table->foreign('activity_id')->references('id')->on('activities')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->bigInteger('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->text('observation')->nullable();

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
        Schema::dropIfExists('activity_group');
    }
}
