<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id(); // SERIAL PRIMARY KEY
            $table->integer('agent_id'); // INTEGER, placeholder for foreign key
            $table->string('title'); // VARCHAR, required
            $table->text('description')->nullable(); // TEXT, optional
            $table->decimal('price', 10, 2); // NUMERIC
            $table->string('address'); // VARCHAR
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
}