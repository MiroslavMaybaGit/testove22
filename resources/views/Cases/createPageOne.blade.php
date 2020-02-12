@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('home')}}" class="btn btn-info mt-3 mb-3">Go to home</a>
            <div id="app">
                <first-input-form :makes="{{$makes}}" :user="{{auth()->user()}}" :current_case="{{$case}}"></first-input-form>
            </div>
    </div>
@endsection
