<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class Address extends Model
{
    use HasFactory;

    public function get_pat()
    {
        return $this->hasMany(Patient::class);
    }
}
