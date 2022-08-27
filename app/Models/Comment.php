<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'animal_id','name','comment'
    ];

    public function animals(){
        return $this->hasMany('App\Models\Animal', 'id' );
    }

}
