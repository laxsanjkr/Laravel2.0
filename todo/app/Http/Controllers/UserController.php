<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
        $user = User::orderBy('created_at', 'DESC')->get();;
        // if (Auth::check()) {
            return $user;
        // }
        // else{
        //     return view('home'); 
        // }
    }

    /**
     * Display User Info .
     *
     * @return \Illuminate\Http\Response
     */

    public function user()
    {
        $user = Auth::user();
        return $user['api_token'];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return $user
     */
    public function create()
    {
        $user = User::orderBy('created_at', 'DESC')->get();;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $newItem = new User;
        $newItem->name = $request->user["name"];
        $newItem->save();

        return $newItem;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $existItem = User::findOrFail($id);

        return $existItem;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existItem = User::findOrFail($id);

        if($existItem){
            $existItem->completed_at = $request->user['updated_at'] ? Carbon::now() : null;
            $existItem->save();

            return $existItem;
        }

        return response()->json(["message" => 'User not found']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existItem = User::findOrFail($id);

        if($existItem){
            $existItem->delete();
            return response()->json(["message" => "User successfully deleted"]);
        }

        return response()->json(["message" => "User not found"]);
    }
}
