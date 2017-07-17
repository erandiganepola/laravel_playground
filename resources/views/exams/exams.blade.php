@extends('layouts.master')


@section('page_header')
    Examinations
@endsection


@section('sub_header')
@endsection

@section('content')

    <div class="box box-primary">
        <div class="box-header">
            <h4 class="box-title">Examinations</h4>
        </div>
        <div class="box-body">
            <div class="container-fluid margin">
                @can("add","App\\Examination")
                    <button class="btn btn-primary pull-left" data-toggle="modal" data-target="#addExamModal">
                        Add Examination
                    </button>
                @endcan
            </div>

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    {{session('success')}}
                </div>
            @endif

            <table class="text-center table table-responsive table-condensed table-hover" id="examinationsTable">
                <thead>
                <tr>
                    <th class="col-md-2">Year</th>
                    <th class="col-md-5">Name</th>
                    <th class="col-md-1">Status</th>
                    <th class="col-md-4">Created By</th>
                </tr>
                </thead>

                <tbody>
                @foreach($exams as $exam)
                    <tr>
                        <td>{{$exam->year}}</td>
                        <td>{{$exam->name}}</td>
                        <td>
                            @if($exam->status==1)
                                <label class="label label-success">Finished</label>
                            @else
                                <label class="label label-danger">Upcoming</label>
                            @endif
                        </td>
                        <td>{{$exam->creator->username}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#examinationsTable").dataTable();
        });
    </script>

    @include("exams.modals.addExamination")
@endsection