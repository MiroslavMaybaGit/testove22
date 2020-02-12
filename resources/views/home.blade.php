@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    <a href="{{route('create_page_1')}}" class="btn btn-info mt-3 mb-3">Create New</a>
    @if(count($cases)>0)

        <div class="row row-cols-3 row-cols-md-3">

                @foreach($cases as $case)
                <div class="col md-4 mt-3 mb-3">
                    <div class="card">
                        <img src="{{$case->picture?$case->picture:''}}" class="card-img-top" alt="image">
                        <div class="card-body">
                            <h5 class="card-title">{{$case->title?$case->title:'empty'}}</h5>
                            <p class="card-text">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Maker: {{$case->maker?$case->maker->name:'empty'}}</li>
                                <li class="list-group-item">Model: {{$case->model?$case->model->name:'empty'}}</li>
                                <li class="list-group-item">Mileage: {{$case->mileage?$case->mileage:'empty'}} km</li>
                                <li class="list-group-item">Buying date: {{$case->buying_date?$case->buying_date->diffForHumans():'empty'}}</li>
                                <li class="list-group-item">Color: {{$case->color?$case->color->name:'empty'}} </li>
                                <li class="list-group-item">Drive Option: {{$case->drive_options?$case->drive_options:'empty'}} </li>
                            </ul>
                            </p>
                            @if(!$case->full_fill)
                                <a href="{{route('show_to_continue_enter',$case->id)}}" class="btn btn-primary">Continue enter</a>
                                @else
                                <a href="{{route('show_to_continue_enter',$case->id)}}" class="btn btn-primary">Edit</a>
                            @endif
                            <form action="{{route('delete_case',$case->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

        </div>



        @else
        <div class="alert alert-primary" role="alert">
            You don`t have any cases
        </div>

        @endif

</div>
@endsection
