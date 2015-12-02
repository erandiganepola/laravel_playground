@extends('layouts.master')


@section('page_header')
    Home
@endsection


@section('sub_header')
    Symphony Music School
@endsection

@section('content')

    @if(Session::has('error'))

        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Sorry!</h4>
            {{Session::get('error')}}
        </div>

    @endif

    <div class="panel box box-danger">

        
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    Search
                </a>
            </h4>
        </div>

        <div class="box-body">
            <div class="form-group">
                <input type="text" pattern="[0-9]{6}[a-zA-Z]{1}" class="form-control" name="indexNumber"
                       placeholder="Ex: 110001A">
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
       
    </div>

@endsection
