@extends('layouts.master')


@section('page_header')
    Instruments
@endsection


@section('sub_header')
    Symphony Music School
@endsection


@section('content')

    <link href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}" rel="script"></script>

    {{--Basic buttons to add student and etc--}}
    <div class="container-fluid" style="margin-bottom: 5px;">
        <a href="{{route('addInstrument')}}" class="btn btn-sm btn-primary pull-right">Add Instrument</a>
    </div>

    <div class="col-sm-6 col-sm-offset-3">
        <div class="box box-info with-border ">
            <div class="box-body">

                <style>
                    table td, th {
                        text-align: center;
                    }

                    td:hover {
                        text-decoration: underline;
                        cursor: pointer;
                    }
                </style>

                <table class="table table-condensed table-hover table-hover" id="instrumentTable">
                    <thead>
                    <tr>
                        <th>Instrument Name</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($instruments as $instrument)
                        <tr>
                            <td>{{$instrument}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#instrument').DataTable();
        });
    </script>
@endsection
