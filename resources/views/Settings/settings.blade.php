@extends('layouts.master')

@section('page_header')
    Settings
@endsection

@section('sub_header')
    Symphony Music School
@endsection

@section('content')

    <link href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}" rel="script"></script>


    <div class="container-fluid" style="margin-bottom: 5px;">

        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>44</h3>

                <p>User Profiles</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="profile" class="small-box-footer">
                View <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>


        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>150</h3>

                <p>Instruments</p>
            </div>
            <div class="icon">
                <i class="ion-ios-musical-notes"></i>
            </div>
            <a href="instruments" class="small-box-footer">
                View <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>


    </div>



@endsection

