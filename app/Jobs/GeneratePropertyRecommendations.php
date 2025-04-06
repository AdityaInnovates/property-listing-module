<?php

namespace App\Jobs;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class GeneratePropertyRecommendations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function handle()
    {
        // Simulate OpenAI API call (mock response)
        $recommendations = [
            ['id' => 1, 'title' => 'Similar Property 1','price'=>20000,'similarity_score'=>95],
            ['id' => 2, 'title' => 'Similar Property 2','price'=>30000,'similarity_score'=>82],
        ];

        // Store recommendations in the database
        DB::table('property_recommendations')->insert([
            'property_id' => $this->property->id,
            'recommendations' => json_encode($recommendations),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}