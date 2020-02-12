@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('home')}}" class="btn btn-info mt-3 mb-3">Go to home</a>
        <div id="app">
            <second-input-form  :user="{{auth()->user()}}" :current_case="{{$case}}" :color="{{$color}}" :drive_options="{{json_encode($case->model->drive_options)}}"></second-input-form>
        </div>
    </div>
@endsection
