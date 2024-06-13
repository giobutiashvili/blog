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
        $items = Comment::join('users','comments.user_id','users.id')
                ->join('articles_translates','comments.article_id','articles_translates.article_id')
                ->where('articles_translates.lang','ka')
                ->select('comments.*','users.email','articles_translates.title AS article')
                ->orderBy('id','DESC')
                ->get();
        
        return view('admin.comments.index', compact('items'));
    }

    // კომენტარის წაშლა მბ-ში
    public function destroy(Request $request, $id)
    {
        $delete = Comment::find($id)->delete();
        $request->session()->flash('result', $delete);
        
        return redirect()->back();      
    }
    
    // კომენტარის დადასტურება
    protected function confirm(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $item = DB::table('comments')->find($id);

            if(!$item)
            {
                return response()->json([
                    'success' => false, 
                    'message' => 'ჩანაწერი ვერ მოიძებნა'
                ]);
            }

            $affected = DB::table('comments')->where('id', $id)->update(['confirmed' => $item->confirmed ? 0 : 1]);

            if(!$affected)
            {
                return response()->json([
                    'success' => false, 
                    'message' => 'ჩანაწერი ვერ განახლდა'
                ]);
            }

            return response()->json([
                'success' => true, 
                'message' => 'ჩანაწერი განახლდა'
            ]);
        }   
           
    }  
}             
                