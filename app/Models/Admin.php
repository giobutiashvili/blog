<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hash;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'password'];

    // ბაზაში ჩაწერის და შენახვის ფუნქცია
    public static function store($request)
    {
        $item = new Admin();
        $item->name = $request->name;
        $item->email = $request->email;
        $item->password = Hash::make($request->password);
        return $item->save(); // true/false
    }

    // ბაზაში განახლების და შენახვის ფუნქცია
    public static function updateItem($request, $item)
    {
        if($request->password)
        {
            $update = $item->update([
                'name' => $request->name,
                'email'=> $request->email,
                'password' => Hash::make($request->password)
            ]);
        }
        else{
            $update = $item->update([
                'name' => $request->name,
                'email'=> $request->email,
            ]);
        }
        return $update;
    }
}
