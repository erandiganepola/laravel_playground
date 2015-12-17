@extends('layouts.master')


@section('page_header')
    Classes
@endsection


@section('sub_header')
    Symphony Music School
@endsection

@section('content')

    <div class="container-fluid" style="margin-bottom: 5px">
        <a class="btn btn-sm btn-primary pull-right" href="{{route('addClass')}}">Add Class</a>
    </div>







@endsection
