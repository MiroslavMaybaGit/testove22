<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakesRequest;
use App\Makes;
use Illuminate\Http\Request;

class MakesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maker = Makes::all();
        return response()->json($maker,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MakesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MakesRequest $request)
    {
        $maker = new Makes();
        $maker->name = $request->name;
        $maker->save();
        return response()->json(['message'=>'Maker added success'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maker = Makes::findOrFail($id);
        return response()->json($maker,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maker = Makes::findOrFail($id);
        return response()->json($maker,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MakesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MakesRequest $request, $id)
    {
        $maker = Makes::findOrFail($id);
        $maker->name = $request->name;
        $maker->save();
        return response()->json(['message'=>'Maker updated success'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Makes::findOrFail($id)->delete();
        return response()->json(['message'=>'Maker deleted success'],200);
    }
}
