<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class dashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $month = Carbon::now()->month;
        $year  = Carbon::now()->year;

        $totalToday = Appointment::whereDate('date', $today)->sum('price');

        $totalMonth = Appointment::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->sum('price');

        $appointmentsToday = Appointment::whereDate('date', $today)->count();

        $totalclientsAppoint = Appointment::distinct('client_id')->count('client_id');

        $totalclient = Client::count();

        // total de clientes atendidos hoje
        $totalclientToday = Appointment::whereDate('date', $today)
            ->distinct('client_id')
            ->count('client_id');

        // prepare the data for the graphs
        $last7Days = Appointment::select(
            DB::raw('DATE(date) as day'),
            DB::raw('SUM(price) as total')
        )
            ->whereDate('date', '>=', Carbon::now()->subDays(6))
            ->groupBy('day')
            ->orderBy('day')
        ->get();

        $days = $last7Days->pluck('day');
        $totals = $last7Days->pluck('total');

        return view('dashboard', compact(
            'totalToday',
            'totalMonth',
            'appointmentsToday',
            'totalclientsAppoint',
            'totalclient',
            'days',
            'totals',
            'totalclientToday'
        ));
    }
}
