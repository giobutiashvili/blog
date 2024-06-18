<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
 

class IndexController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $articles = Article::all(App::getLocale()); // App::getLocale() მიმდინარე ენა

        return view('front.index', compact('articles', 'users'));
    }
    public function article($id)
    {
        $article = Article::item(App::getLocale(), $id); 
        

        if(!$article)
        {
            return redirect()->back();
        }
        
        return view('front.article', compact('article'));
    }
    
}
