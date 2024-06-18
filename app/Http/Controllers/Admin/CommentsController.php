<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends BaseController
{
    // ჩამონათვალის გვერდი
    public function index()
    {
            $comments = DB::table('comments')
            ->join('users','comments.user_id','users.id')
            ->join('articles_translates','comments.article_id','articles_translates.article_id')
            ->where('articles_translates.lang','ka')
            ->select('comments.*','users.email','articles_translates.title AS article')
            ->orderBy('id','DESC')
            ->get();
                return view('admin.comments.index', compact('comments'));
    }

    // კომენტარის წაშლა მბ-ში
    public function destroy($id)
    {
        $affected = DB::table('comments')->where('id', $id)->delete();

        if (!$affected) {
            session()->flash('message', 'ჩანაწერი ვერ წაიშალა');
            session()->flash('success', false);
        } else {
            session()->flash('message', 'ჩანაწერი წაიშალა');
            session()->flash('success', true);
        }

        return redirect()->back();
    }
    
    // კომენტარის დადასტურება
    public function confirm(Request $request, $id)
    {
        $item = DB::table('comments')->find($id);

        if (!$item) {
            $request->session()->flash('message', 'ჩანაწერი ვერ მოიძებნა');
            $request->session()->flash('success', false);
            return redirect()->back();
        }

        // Debugging: Log the item to check its properties
        \Log::info('Comment item:', (array)$item);

        // Ensure the 'confirmed' property exists before using it
        if (property_exists($item, 'confirmed')) {
            $confirmed = $item->confirmed ? 0 : 1;
        } else {
            $confirmed = 0;
        }

        $affected = DB::table('comments')->where('id', $id)->update(['confirmed' => $confirmed]);

        if (!$affected) {
            $request->session()->flash('message', 'ჩანაწერი ვერ განახლდა');
            $request->session()->flash('success', false);
            return redirect()->back();
        }

        $request->session()->flash('message', 'ჩანაწერი განახლდა');
        $request->session()->flash('success', true);
        return redirect()->back();
    }
    
}             
                         