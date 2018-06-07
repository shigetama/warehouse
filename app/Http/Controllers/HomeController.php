<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recplan;
use App\Shipplan;
use Carbon\Carbon;

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

    public function index() {
      $now = Carbon::now()->toDateString();
      $comRec = Recplan::where('rec_date', '<=', $now)->get()->toArray();
      $comShip = Shipplan::where('ship_date', '<=',$now)->get()->toArray();
      if($comRec || $comShip){
        return redirect('/shigewarehouse/top')->with('status', __('本日の入出荷オーダーがまだ残っています'));
      }else{
        return redirect('/shigewarehouse/top');
      }
    }
}
