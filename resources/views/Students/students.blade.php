@extends('layouts.master')


@section('page_header')
    Students
@endsection


@section('sub_header')
    Symphony Music School
@endsection

@section('content')

    {{--Basic buttons to add student and etc--}}
    <div class="container-fluid">
        <a href="{{route('addStudent')}}" class="btn btn-sm btn-primary pull-right">Add Student</a>
    </div>


@endsection
