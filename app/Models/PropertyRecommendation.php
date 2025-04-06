<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyRecommendation extends Model
{
    protected $table = 'property_recommendations';
    protected $fillable = [
        'property_id',
        'recommendations'
    ];

    protected $casts = [
        'recommendations' => 'array'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
} 