<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;
use App\Models\Post;
use CyrildeWit\EloquentViewable\Support\Period;
class AdminController extends Controller
{
    
    
    public function index(){

    $totalvisitorsCount = Visitor::sum('visits');
    $todayvisitorsCount = Visitor::whereDate('created_at', Carbon::today())->sum('visits');
    // dd($todayvisitorsCount);
    
    //////////////
    $viewsCounts = [];
    $currentDate = now();
    // Loop through each day of the week (starting from Sunday = 0 to Saturday = 6)
    for ($i = 0; $i < 7; $i++) {
        // Calculate the date for the current day
        $dayDate = $currentDate->startOfWeek()->addDays($i);
        // Calculate the start and end dates for the current day
        $startDate = $dayDate->copy()->startOfDay();
        $endDate = $dayDate->copy()->endOfDay();
        
        // Calculate the count of views for the current day
        $viewsCounts[] = views(Post::class)->period(Period::create($startDate, $endDate))->count();
        }
    // Format the views counts as a comma-separated string
    $viewsCountsString = implode(',', $viewsCounts);
    // dd($viewsCountsString);
        return view('dashboard.index2',[
            'totalvisitorsCount' => $totalvisitorsCount,
            'todayvisitorsCount' => $todayvisitorsCount,
            'viewsCounts' => $viewsCounts ,
             'viewsCountsString'=> $viewsCountsString ,
            
            ]);

    }

}
