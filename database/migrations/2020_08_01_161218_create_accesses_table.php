<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('endpoint_id')->unsigned();
            $table->bigInteger('response_id')->unsigned();
            $table->timestamp('created_at', 0)->nullable();

            $table->foreign('endpoint_id')
                ->references('id')->on('endpoints')
                ->onDelete('cascade');

            $table->foreign('response_id')
                ->references('id')->on('responses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesses');
    }
}
