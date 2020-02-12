<?php

namespace App\Http\Controllers;

use App\CarModel;
use App\Http\Requests\CarModelsRequest;
use App\Makes;
use Illuminate\Http\Request;

class ModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = CarModel::all();
        return response()->json($models,200);
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
     * @param  CarModelsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarModelsRequest $request)
    {
        $maker = Makes::findOrFail($request->makes_id);
        $maker->model()->create($request->all());
        return response()->json(['message'=>'Model added success'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $models = CarModel::findOrFail($id);
        return response()->json($models,200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getModelForMaker($id)
    {
        $maker = Makes::findOrFail($id);
        return response()->json($maker->model,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $models = CarModel::findOrFail($id);
        return response()->json($models,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CarModelsRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarModelsRequest $request, $id)
    {
       CarModel::findOrFail($id)->update($request->all());
        return response()->json(['message'=>'Model updated success'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CarModel::findOrFail($id)->delete();
        return response()->json(['message'=>'Model deleted success'],200);
    }
}
