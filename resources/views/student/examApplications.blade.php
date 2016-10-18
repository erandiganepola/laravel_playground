@extends('layouts.master')


@section('page_header')
    Apply for Examinations
@endsection


@section('sub_header')
    Upcoming Examinations
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h4 class="box-title">Apply for Examinations</h4>
        </div>
        <div class="box-body">
            @if(Session::has('errors'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Oops!</h4>
                    @foreach(Session::get('errors')->all() as $error)
                        {{$error}}
                    @endforeach
                </div>
            @endif
            <table class="text-center table table-responsive table-condensed table-hover" id="examinationsTable">
                <thead>
                <tr>
                    <th class="col-md-2">Year</th>
                    <th class="col-md-5">Name</th>
                    <th class="col-md-1">Status</th>
                    <th class="col-md-4"></th>
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
                        <td>
                            <form action="{{route("applyExamination",['id'=>$exam->id])}}" method="post">
                                {{csrf_field()}}
                                <button class="btn btn-sm btn-primary" type="submit">Apply</button>
                            </form>
                        </td>
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
@endsection