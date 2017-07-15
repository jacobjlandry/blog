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
            ->get();

        $todayPageVisits = Stat::select(DB::raw('count(*) as count'), 'url')
            ->where(DB::raw('CAST(created_at as DATE)'), date('Y-m-d'))
            ->groupBy('url')
            ->get();
        
        $totalVisitors = Stat::select(DB::raw('count(*) as count'), 'ip_address', DB::raw('CAST(created_at as DATE) as date'))
            ->groupBy('ip_address')
            ->groupBy(DB::raw('CAST(created_at AS DATE)'))
            ->orderBy(DB::raw('CAST(created_at AS DATE)'), 'asc')
            ->get();

        $totalVisits = Stat::select(DB::raw('count(*) as count'), DB::raw('CAST(created_at as DATE) as date'))
            ->groupBy(DB::raw('CAST(created_at AS DATE)'))
            ->orderBy(DB::raw('CAST(created_at as DATE)'), 'asc')
            ->limit(7)
            ->get();

        return view('auth.home')
            ->with('settings', Setting::all())
            ->with('pageVisits', $pageVisits)
            ->with('todayPageVisits', $todayPageVisits)
            ->with('totalVisitors', $totalVisitors)
            ->with('totalVisits', $totalVisits);
    }
}
