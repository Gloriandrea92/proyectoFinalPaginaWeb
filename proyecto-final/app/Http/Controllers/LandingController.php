<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    //
    public function getLanding(){
        return view ('landing');
    }
    public function getWork(){
        return view ('welcome');
    }
}
