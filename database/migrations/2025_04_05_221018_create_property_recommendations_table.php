<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyRecommendationsTable extends Migration
{
    public function up()
    {
        Schema::create('property_recommendations', function (Blueprint $table) {
            $table->id(); // SERIAL PRIMARY KEY
            $table->unsignedBigInteger('property_id'); // Foreign key to properties
            $table->jsonb('recommendations'); // JSONB for storing recommendations
            $table->timestamps(); // created_at, updated_at

            $table->foreign('property_id')
                  ->references('id')
                  ->on('properties')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('property_recommendations');
    }
}