<?php

namespace Modules\CMS\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CMSController extends Controller
{
    public function index()
    {
        $usersWithPosts = DB::table('users')
        ->join('cms_posts', 'users.id', '=', 'cms_posts.user_id')
        ->select('users.*', 'cms_posts.description as post_desc', 'cms_posts.id as post_id')
        ->orderBy('cms_posts.id', 'desc')
        ->get();    
        return view('cms::index', compact('usersWithPosts'));
    }
}
