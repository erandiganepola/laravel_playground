@extends('layouts.master')


@section('page_header')
    Classes
@endsection


@section('sub_header')
    Symphony Music School
@endsection

@section('content')

    <link href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}" rel="script"></script>



    <div class="container-fluid" style="margin-bottom: 5px">
        <a class="btn btn-sm btn-primary pull-right" href="{{route('addClass')}}">Add Class</a>
    </div>

    {{--Table showing classes--}}
    <div class="box box-primary">

        <style>
            table td, th {
                text-align: center;
            }

        </style>

        <div class="box-body">
            <table class="table table-condensed table-hover" id="classesTable">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Starts From</th>
                    <th>Type</th>
                </tr>
                </thead>
                <tbody>
                @foreach($classes as $class)
                    <tr>
                        <td>{{$class->getID()}}</td>
                        <td>{{$class->getName()}}</td>
                        <td>{{$class->getStartDate()}}</td>
                        <td>{{$class->getType()==="I"? "Individual":"Group"}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $('#classesTable').DataTable();
        });
    </script>




@endsection
