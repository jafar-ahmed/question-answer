<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            // id BIGINT UNSIGNED AUTO INCREMENT PRIMARY KEY
            $table->bigInteger('id')->unsigned()->autoIncrement();
            // $table->unsignedBigInteger('id')->autoIncrement()->primary();
            //$table->bigIncrements('id');

           // $table->id();

            //name varchar(255)
            $table->string('name');
            $table->string('slug')->unique(); 

            //created_at timestamp,updated_at timestamp
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
        Schema::dropIfExists('tags');
    }
}
