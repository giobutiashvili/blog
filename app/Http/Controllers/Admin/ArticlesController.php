<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticlesController extends BaseController
{
    public function index()
    {
        $items = Article::all('ka');
    
        return view('admin.articles.index', compact('items')); // მივამაგროთ ინფორმაცია და დავაბრუნოთ წარმოდგენის ფაილი
    }

    public function create()
    {
    
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        // სათარგმნი ველების ქართულ ენაზე შევსება აუცულებელია
        $this->validate($request,[
            'translates.ka.title' => 'required|max:100',
            'translates.ka.description' => 'required|max:255',
            'translates.ka.text' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);  
        
        $store = Article::store($request); // true ან false
        
        $request->session()->flash('result', $store);
        
        return redirect()->route('articles.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $items_with_translates = Article::itemByIdWithTranslates($id);
        if($items_with_translates->count() != 2)
        {
            redirect()->route('articles.index');
        }

        return view('admin.articles.edit', compact('items_with_translates')) ;
    }

    public function update(Request $request, $id)
    {
        // სათარგმნი ველების ქართულ ენაზე შევსება აუცულებელია
        $this->validate($request,[
            'translates.ka.title' => 'required|max:100',
            'translates.ka.description' => 'required|max:255',
            'translates.ka.text' => 'required',
            'image' => 'mimes:jpeg,jpg,png', // ფოტოს არჩევა აღარაა აუცილებელი, თუმცა თუ აირჩევს ფორმატი უნდა გადამოწმდეს
        ]);  

        $item = Article::findOrFail($id);
        $update = Article::updateItem($request, $item); // true ან false
        $request->session()->flash('result', $update);

        return redirect()->back();            
    }

    public function destroy(Request $request, $id)
    {
        $delete = Article::find($id)->delete();
        $request->session()->flash('result', $delete);
        return redirect()->back();
    }
}
                