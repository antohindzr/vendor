<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendorModel extends Model
{
    use HasFactory;
    protected $table = "vendor";

    protected $fillable = [
        'vendorType',
        'maskSN'
    ];
}

