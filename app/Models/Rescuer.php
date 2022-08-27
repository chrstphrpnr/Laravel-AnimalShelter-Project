<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\Animal;


class Rescuer extends Model
{
    use HasFactory;
    public $table = 'rescuers';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'rescuer_fname','Lname','Age','Gender','Address','Contact','user_id','email',
    ];

    public function animals(){
        return $this->belongsToMany('App\Models\Animal',
        'animal_rescuers','rescuer_id','animal_id');
    }





}



