@extends('layouts.master')


@section('page_header')
    {{$student->name}}
@endsection


@section('sub_header')
    Examination No : {{$student->examination_no}}
@endsection

@section('content')

    <link href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}" rel="script"></script>


    {{--Table showing classes--}}
    <div class="box box-primary">

        <style>
            table td, th {
                text-align: center;
            }

        </style>

        <div class="box-body">


        </div>

        <div class="box-footer">

        </div>
    </div>

@endsection
