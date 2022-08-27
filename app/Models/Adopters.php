<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopters extends Model
{
    use HasFactory;

    public $table = 'adopters';
    public $timestamps = true;

    protected $primaryKey = 'id';

    protected $fillable = [
        'adopter_fname','Lname','Age','Gender','Address','Contact','user_id'

    ];

    public function animals(){
        return $this->belongsToMany('App\Models\Animal',
        'animal_adopters','adopter_id','animal_id');
    }


}
