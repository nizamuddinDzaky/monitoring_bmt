<?php

namespace App\Http\Controllers;

use App\Tausiah;
use Illuminate\Http\Request;
use App\Repositories\PengajuanReporsitories;
use DB;
use App\Models\Footer ;
use App\Models\HomePage ;

class LandingHomeController extends Controller
{

    public function __construct()
    {
        // $this->pengajuanReporsitory = $pengajuanReporsitory;
    }

    public function home(){
        $homepage = Homepage::find(1);
        $footer = Footer::first();
        return view('welcome', compact(
            'homepage', 
            'footer'
        ));
    }


    
}
