<?php

namespace App\Http\Controllers\Admin;

use Cache;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;


class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        $item = DB::table('contacts')->first();
        return view('admin.admins.contact.edit', compact('item','contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
    
        $item = DB::table('contacts')->first();
        $contacts = Contact::all();
        return view('admin.admins.contact.edit', compact('item','contacts'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ვალიდაცია 
        $this->validate($request,[
            'phone' => 'required|numeric|string|max:9999999999',
            'email' => 'required|email|max:255'
        ]);

        DB::table('contacts')->where('id', $id)->update([
            'phone' => $request->phone,
            'email' => $request->email
        ]);
        $request->session()->flash('result',true);
        return redirect()->back();
    }

    public function cache(Request $request)
    {
        // თუ საკონტაქტო ინფორმაცია უკვე შენახულია ქეშში
        if(Cache::has('contacts'))
        {
            // წავშალოთ იგი
            Cache::forget('contacts');
        }
        else // თუ არადა 
        {
            // შევინახოთ 
            Cache::remember('contacts', 3600, function () {
                return DB::table('contacts')->first();
            });
        }
        
        $request->session()->flash('result', true);
        
        return redirect()->back();  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', __('Contact deleted successfully.'));
    }
}
