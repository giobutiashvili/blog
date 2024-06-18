<?php

namespace App\Http\Controllers;

use DB;
use View;
use Cache;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct() 
    {
        View::share('contact', Cache::has('contacts') ? Cache::get('contacts') : DB::table('contacts')->first());      
    } 
    
}
                
