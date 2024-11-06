<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewTableCredentialAPIDisasters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credentialsApiDisasters', function(Blueprint $table){
            $table->id();
            $table->string('credential');
            $table->timestamp('createdAt')->useCurrent();
            $table->timestamp('createdAt')->useCurrent();
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
