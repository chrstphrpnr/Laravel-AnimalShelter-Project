<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InjuryDisease extends Model
{


    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'health_problem'

    ];


}
