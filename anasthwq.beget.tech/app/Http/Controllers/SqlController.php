<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SqlController extends Controller
{
    public function index(){
        $users = DB::table('users')->get();
        dd($users);
    }
}
