<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country_id'];

    // A city belongs to a country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
