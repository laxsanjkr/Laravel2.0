<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();
        return Item::where('idUser',$user['id'])->orderBy('created_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {   
        // $value = $request->session()->get('key', 'default');
        // dd($value);
        $user = Auth::user();
        return Item::create([
            'name' => $request['name'],
            'idUser' => $user['id']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $newItem = $this->create($request);

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
        $existItem = Item::findOrFail($id);

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
        $existItem = Item::findOrFail($id);

        if($existItem){
            $existItem->completed = $request->item['completed'] ? true : false;
            $existItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $existItem->save();

            return $existItem;
        }

        return response()->json(["message" => 'Item not found']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('auth');
        $existItem = Item::findOrFail($id);

        if($existItem){
            $existItem->delete();
            return response()->json(["message" => "Item successfully deleted"]);
        }

        return response()->json(["message" => "Item not found"]);
    }
}
