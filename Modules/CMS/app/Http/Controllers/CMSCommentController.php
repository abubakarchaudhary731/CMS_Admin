<?php

namespace Modules\CMS\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CMSCommentController extends Controller
{
    public function storeComment(Request $request, $id)
    {
        DB::table('cms_comments')->insert([
            'user_id' => session()->get('user_details')['user_id'],
            'post_id' => $id,
            'comment' => $request->comment,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->back();
    }

    public function deleteComment($id)
    {
        DB::table('cms_comments')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully');
    }

    // public function editComment($id)
    // {
    //     $comment = DB::table('comments')->where('id', $id)->first();
    //     // dd($comment);
    //     return redirect()->back()->with('comment', $comment);
    // }
}
