<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

        protected $primaryKey = 'id';

        protected $fillable = [
        'personnel_fname',
        'Lname',
        'Age',
        'Gender',
        'Role',
        'Email',
        'Password',
        'user_id',
        'Address',
        'Contact',
        'status'

    ];


    protected $hidden = [
        'Password',
    ];


    public function animals(){
        return $this->belongsToMany('App\Models\Animal',
        'animal_personnels','animal_id','personnel_id');
    }

    public function users(){
        return $this->hasMany('App\Models\User','id');
    }




    
}
