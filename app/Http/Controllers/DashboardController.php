<?php

namespace App\Http\Controllers;
Use App\Models\User;
use Illuminate\Http\Request;
use App\Charts\AdoptChart;
use App\Charts\HealthChart;
use App\Charts\RescueChart;
use DB;
use View;

class DashboardController extends Controller
{
    public function admin(){
        $admins = DB::table('users')
        ->select('users.*')
        ->whereIn('role', ['admin'])->get();

        $adopt = DB::table('adopters')
        ->join('animal_adopters','adopters.id','=','animal_adopters.adopter_id')
        ->join('animals','animal_adopters.animal_id','=','animals.id')
        ->select(DB::raw('count(adopters.created_at) AS Total'),
        DB::raw('MONTHNAME(adopters.created_at) as Month'))
        ->groupBy('Month')
        ->pluck(DB::raw('count(month) AS Total'),'Month')
        ->all();

        $adoptChart = new AdoptChart;

        $dataset = $adoptChart->labels(array_keys($adopt));

        $dataset= $adoptChart->dataset('Adopted Animals Demographics', 'horizontalBar', array_values($adopt));
   
        $dataset= $dataset->backgroundColor(collect(['#6CFF00','#7158e2','#3ae374',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));

        $adoptChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],

                            'ticks' => [
                            'beginAtZero' => true,
                            ]
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            'barThickness' => 100,
                            'barPercentage' => 1,
                            'gridLines' => ['display' => false],
                            'display' => true,
                            'ticks' => [
                             'beginAtZero' => true,
                             'min'=> 0,
                             'stepSize'=> 10,
                        ]
                    ]],
                 ],
        ]);

        $rescue = DB::table('rescuers')
        ->join('animal_rescuers','rescuers.id','=','animal_rescuers.rescuer_id')
        ->join('animals','animal_rescuers.animal_id','=','animals.id')
        ->select(DB::raw('count(rescuers.created_at) AS Total'),
        DB::raw('MONTHNAME(rescuers.created_at) as Month'))
        ->groupBy('Month')
        ->pluck(DB::raw('count(month) AS Total'),'Month')
        ->all();

        $rescueChart = new RescueChart;

        $dataset = $rescueChart->labels(array_keys($rescue));

        $dataset= $rescueChart->dataset('Rescued Animals Demographics', 'horizontalBar', array_values($rescue));
   
        $dataset= $dataset->backgroundColor(collect(['#00C5FF','#7158e2', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));

        $rescueChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],

                            'ticks' => [
                            'beginAtZero' => true,
                            ]
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            'barThickness' => 100,
                            'barPercentage' => 1,
                            'gridLines' => ['display' => false],
                            'display' => true,
                            'ticks' => [
                             'beginAtZero' => true,
                             'min'=> 0,
                             'stepSize'=> 10,
                        ]
                    ]],
                 ],
        ]);

        $health = DB::table('injury_diseases')
        ->join('animal_injuries','injury_diseases.id','=','animal_injuries.injurydisease_id')
        ->join('animals','animal_injuries.animal_id','=','animals.id')
        ->groupBy('injury_diseases.health_problem')
        ->pluck(DB::raw('count(injury_diseases.health_problem) as total'),'injury_diseases.health_problem')
        ->all();

            $healthChart = new healthChart;
            // dd(array_values($customer));
            $dataset = $healthChart->labels(array_keys($health));
           // dd($dataset);
           $dataset= $healthChart->dataset('Common Sickness Demographics', 'pie', array_values($health));
           // dd($customerChart);
           $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
           // dd($customerChart);
           $healthChart->options([
               'responsive' => true,
               'legend' => ['display' => true],
               'tooltips' => ['enabled'=>true],
               // 'maintainAspectRatio' =>true,
               // 'title' => 'test',
               'aspectRatio' => 1,
               'scales' => [
                   'yAxes'=> [[
                               'display'=>false,
                               'ticks'=> ['beginAtZero'=> true],
                               'gridLines'=> ['display'=> false],
                             ]],
                   'xAxes'=> [[
                               'categoryPercentage'=> 0.8,
                               //'barThickness' => 100,
                               'barPercentage' => 1,
                               'ticks' => ['beginAtZero' => false],
                               'gridLines' => ['display' => false],
                               'display' => true
                             ]],
               ],
           ]);

        
        
        return view('Dashboard.index',compact('admins','adoptChart','rescueChart','healthChart'));
    }

    

    public function editdashboard($id){
        $admins = User::find($id);
        return View::make('Dashboard.edit',compact('admins'));
    }

    public function updatedashboard(Request $request,$id){
        $admins = User::find($id);
        $admins->update($request->all());
        return redirect()->route('Dashboard.index')->with('success','A Record was updated successfully.');
    }


  
 
}
