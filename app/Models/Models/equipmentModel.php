<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipmentModel extends Model
{
    use HasFactory;
    protected $table = "equipment";

    protected $fillable = [
        'vendorID',
        'serial'
    ];
}

