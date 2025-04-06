<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';
    protected $fillable = [
        'agent_id',    // Required: ID of the agent who listed the property
        'title',       // Required: Name/title of the property
        'description', // Optional: Detailed description of the property
        'price',       // Required: Property price
        'address',     // Required: Physical address of the property
    ];

    public function recommendations()
    {
        return $this->hasOne('App\Models\PropertyRecommendation', 'property_id');
    }
}
