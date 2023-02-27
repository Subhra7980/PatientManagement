<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;

class Patient extends Model
{
    use HasFactory;

    public function get_address()
    {
        return $this->belongsTo(Address::class, 'addressId');
    }
}
