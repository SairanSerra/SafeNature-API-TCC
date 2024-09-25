<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OccurrencyDisasters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occurencyDisasters', function(Blueprint $table){
            $table->id();
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
            $table->bigInteger('idCobrade')->unsigned();
            $table->string('city');
            $table->string('state', 2);
            $table->timestamp('createdAt')->useCurrent();
            $table->timestamp('updatedAt')->useCurrent();

            $table->foreign('idCobrade')->references('cobrade')->on('cobrade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
