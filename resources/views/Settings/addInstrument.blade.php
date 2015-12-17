@extends('layouts.master')


@section('page_header')
    Add Instruments
@endsection


@section('sub_header')
    Symphony Music School
@endsection


@section('content')


    {{--Error--}}
    @if(Session::has('errors'))

        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Oops!</h4>
            <ul>
                @foreach(Session::get('errors') as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

    @endif

    {{--Success Message--}}
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Successful!</h4>
            {{Session::get('success')}}
        </div>
    @endif

    {{-- Panel showing form --}}
    <div class="col-sm-6 col-sm-offset-3">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Instrument </h3>
            </div><!-- /.box-header -->


            <!-- form start -->
            <form class="form-horizontal" action="{{route('addStudent')}}" method="post">

                {{csrf_field()}}

                <div class="box-body">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="name" placeholder="Name"
                                       name="name"
                                       value="{{old('name')}}">
                            </div>
                        </div>
                    </div>


                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-info pull-right">Add</button>
                </div><!-- /.box-footer -->


            </form>
        </div>
    </div>


@endsection
