<?php

namespace Modules\CMS\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CMSPostController extends Controller
{
    public function viewCreatePage() 
    {
        $id = 0;
        return view('cms::createPostPage', compact('id'));
    }
    public function createCmsPost(Request $request)
    {
        $user = session()->has('user_details') ? session()->get('user_details') : null;
        if ($user != null) {
            $request->validate([
                'description' => 'required',
            ]);

            $post = DB::table('cms_posts')->insert([
                'user_id' => $user['user_id'],
                'description' => $request->description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }   if ($post) {
                return redirect()->route('cms.index')->with('success', 'Post uploded successfully');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
    }   
    public function edit($id)
    {
        $post = DB::table('cms_posts')->where('id', $id)->first();
        return view('cms::createPostPage', compact('post', 'id'));
    }

    // Update Post
    public function update(Request $request, $id)
    {
        $update = DB::table('cms::createPostPage')->where('id', $id)->update([
            'description' => $request->description,
            'updated_at' => now(),
        ]);
        if ($update) {
            return redirect()->route('cms')->with('success', 'Post updated successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    } 

     // Delete Post
     public function delete(Request $request)
     {
         DB::table('cms_posts')->where('id', $request->id)->delete();
         return redirect()->back()->with('success', 'Post deleted successfully');
     }

     public function view($id)
     {
        $post = DB::table('cms_posts')->where('id', $id)->first();
        $user = DB::table('users')->where('id', $post->user_id)->select('name', 'email')->first();
        $comments = DB::table('cms_comments')
        ->join('users', 'users.id', '=', 'cms_comments.user_id')
        ->where('cms_comments.post_id', $id)
        ->select('users.id as userId', 
            'users.email as userEmail', 
            'cms_comments.id as commentId',
            'cms_comments.comment', 
            'cms_comments.created_at')
        ->get();
        $comment = '';
        return view('cms::viewPost', compact('post', 'id', 'user', 'comments', 'comment'));
     }
}
