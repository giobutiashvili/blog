<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ჩამონათვალის გამოსატანი მეთოდი
        $items= Admin::all(); // ყველა ჩანაწერის ამოღება admin ცხრილიდან 
        return view('admin.admins.index', compact('items')); 
        // მივამაგროთ ინფორმაცია და გადავიდეთ items-ის გვერძე
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ადმინსტრატორის დამატების ფორმის გვერდი
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     // ადმინსტრატორის შენახვა მბ-ში
    public function store(Request $request)
    {
        // ვალიდაცია
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|max:255',
            'email' => 'required|email|max:255|unique:admins',
        ]);

        $store = Admin::store($request); // true ან false
        
        // დაბრუნებულ ლოგიკურ შედეგს ვინახავთ სესიაში 
        $request->session()->flash('result', $store);
        // და გადავდივართ ადმინისტრატორების ჩამონათვალის გვერძე
        return redirect()->route('admins.index');
    }

    /**
     * Display the specified resource.
     */
    
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // ადმინსტრატორის რედაქტირების ფორმის გვერდი
    public function edit(string $id)
    {
        $item = Admin::findOrFail($id);

        return view('admin.admins.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */

     // ადმინსტრატორის განახლება მბ-ში
    public function update(Request $request, string $id)
    {
        //ვალიდაცია
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $id,
        ]);
        $item = Admin::findOrFail($id);
        $update = Admin::updateItem($request, $item); // true ან false
        $request -> session()->flash('result', $update);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if($id == 1)
    {
        return redirect()->back();  
    }

    $delete = Admin::find($id)->delete();
    $request->session()->flash('result', $delete);

    return redirect()->back(); 
    }
}
