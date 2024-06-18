<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use Hash;
use Auth;


class UserController extends Controller
{
    public function dashboard()
    {
        
        $users = Auth::user();
        return view('front.dashboard', compact('users'));
    }
    public function update_data(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::user()->id,
        ]);
        $update = Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        if($update)
        {
            $request->session()->flash('updating_results', [
                'class' => 'success',
                'message' => trans('site.info_updated')
            ]);
        }
        else
        {
            $request->session()->flash('updating_results', [
                'class' => 'danger',
                'message' => trans('site.update_error')
            ]);
        }
    return redirect()->back();
    }
    public function update_password(Request $request)
    {
        if(!Hash::check($request->old_password, Auth::user()->password))
        {
            $request->session()->flash('update_results', [
                'class' => 'danger',
                'message' => trans('site.old_password_error'),
            ]);
            return redirect()->back();
        }
        $this->validate($request, [
            'old_password' => 'required|min:8|max:255',
            'new_password' => 'required|min:8|confirmed'
        ]);
        $update = Auth::user()->update([
            'password' => Hash::make($request->new_password)
        ]);
        if($update) 
        {
            $request->session()->flash('updating_results', [
                'class' => 'success', 
                'message' => trans('site.info_updated')
            ]);
        } 
        else
        {
            $request->session()->flash('updating_results', [
                'class' => 'danger', 
                'message' => trans('site.update_error')
            ]);
        }
        
        return redirect()->back();
    }
    public function comment(Request $request)
    {
        $this->validate($request,[
            'article_id' => 'required|integer',
            'comment' => 'required|string|max:255',
        ]); 

        $article = Article::find($request->article_id); 

        if(!$article)
        {
            return redirect()->back();
        }

        $create = Comment::create([
            'user_id' => Auth::user()->id,
            'article_id' => $request->article_id,
            'comment' => $request->comment, 
            'created_at' => new \DateTime()
        ]);

        if($create) 
        {
            $request->session()->flash('inserting_results', [
                'class' => 'success', 
                'message' => trans('site.waiting_for_admin_confirm')
            ]);
        } 
        else
        {
            $request->session()->flash('inserting_results', [
                'class' => 'danger', 
                'message' => trans('site.inserting_error')
            ]);
        }

        return redirect()->back();
    }
    
}
