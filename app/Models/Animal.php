<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Animal extends Model implements Searchable
{
    use HasFactory;
    public $table = 'animals';
    public $timestamps = true;

    protected $primaryKey = 'id';

    protected $fillable = [
        'Name','Type','Breed','Sex','image','HealthStatus','AdaptionStatus','Age'

    ];

    public function injuryDisease(){
        return $this->belongsToMany('App\Models\InjuryDisease',
        'animal_injuries','animal_id','injurydisease_id');
    }

    public function getSearchResult(): SearchResult
     {
        $url = route('frontend.info', $this->id);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->Name,
            $url
               );
     }

 


}

// ,'','RescuerId','RescuedDate'
