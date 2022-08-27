<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
Use App\Models\Animal;


class SearchController extends Controller
{
    public function search(Request $request){
        $searchResults = (new Search())
        ->registerModel(Animal::class,'Name','Type','Breed','Sex','HealthStatus','AdaptionStatus','Age')
        ->search($request->input('search'));

        return view('frontend.search',compact('searchResults'));
    }
}
