<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPosts = DB::table('cms_posts')->where('user_id', auth()->user()->id)->count();
        return view('dashboard', compact('totalPosts'));
    }
}
