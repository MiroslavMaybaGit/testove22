<?php

namespace App\Http\Controllers;

use App\Cases;
use App\Color;
use App\Http\Requests\CasesRequest;
use App\Makes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $cases = $user->cases()->get();
        return view('home',compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $makes = Makes::all();
        $user = Auth::user();
        $case = $user->cases()->create([]);
        return view('Cases.createPageOne',compact('makes','case'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $makes = Makes::all();
        $user = Auth::user();
        $case = $user->cases()->findOrFail($id);
        return view('Cases.createPageOne',compact('makes','case'));
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
     * @param  CasesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CasesRequest $request, $id)
    {
        $user = Auth::user();
        $case = $user->cases()->findOrFail($id);
        if($request->full_form){
            $case->update($request->all());

            return response()->json(200);
        }else{
            $case->update($request->all());
            return response()->json('upd not full form');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CasesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateWithPhoto(CasesRequest $request, $id)
    {
        $payload = json_decode($request->data);
        $user = Auth::user();
        $case = $user->cases()->findOrFail($id);
        if($case->picture){
            Storage::disk('public')->delete('user_image/'.$case->picture);
        }
        $cover = $request->file('fileToUpload');
        $extension = $cover->getClientOriginalExtension();
        $name=explode('.',$cover->getFilename())[0];
        Storage::disk('public')->put('user_image/'.$name.'.'.$extension,  File::get($cover));
        $case->color_id = $payload->color_id;
        $case->drive_options = $payload->drive_options;
        $case->picture = $name.'.'.$extension;
        $case->full_fill = true;
        $case->save();
        return response()->json(['message'=> 'Photo success upload'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $user->cases()->findOrFail($id)->delete();
        return redirect()->back()->with(['msg'=>'Delete success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSecondPage($id)
    {
        $user = Auth::user();
        $case = $user->cases()->findOrFail($id);
        $color = Color::all();
        return view('Cases.createPageTwo',compact('color','case'));
    }
}
