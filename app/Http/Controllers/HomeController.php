<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Stat;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageVisits = Stat::select(DB::raw('count(*) as count'), 'url')
            ->groupBy('url')
            ->orderBy('count', 'desc')
            ->get();
        $visits = $pageVisits->filter(function($visit, $key) {
            return $key < 4;
        });
        $other = $pageVisits->filter(function($visit, $key) {
            return $key >= 4;
        });
        $pageVisits = $visits->push(new Stat(['count' => $other->sum('count'), 'url' => 'other']));

        $todayPageVisits = Stat::select(DB::raw('count(*) as count'), 'url')
            ->where(DB::raw('CAST(created_at as DATE)'), date('Y-m-d'))
            ->groupBy('url')
            ->get();
        $todayVisits = $todayPageVisits->filter(function($visit, $key) {
            return $key < 4;
        });
        $todayOther = $todayPageVisits->filter(function($visit, $key) {
            return $key >= 4;
        });
        $todayPageVisits = $todayVisits->push(new Stat(['count' => $todayOther->sum('count'), 'url' => 'other']));
        
        $totalVisitors = Stat::select(DB::raw('count(*) as count'), 'ip_address', DB::raw('CAST(created_at as DATE) as date'))
            ->groupBy('ip_address')
            ->groupBy(DB::raw('CAST(created_at AS DATE)'))
            ->orderBy(DB::raw('CAST(created_at AS DATE)'), 'asc')
            ->get();

        $totalVisits = Stat::select(DB::raw('count(*) as count'), DB::raw('CAST(created_at as DATE) as date'))
            ->groupBy(DB::raw('CAST(created_at AS DATE)'))
            ->orderBy(DB::raw('CAST(created_at as DATE)'), 'desc')
            ->limit(7)
            ->get()
            ->reverse();

        return view('auth.home')
            ->with('settings', Setting::all())
            ->with('pageVisits', $pageVisits)
            ->with('todayPageVisits', $todayPageVisits)
            ->with('totalVisitors', $totalVisitors)
            ->with('totalVisits', $totalVisits);
    }

    /**
     * Truncate the statistics table
     */
    public function clearStats()
    {
        Stat::truncate();
	return redirect('/admin');
    }
}
