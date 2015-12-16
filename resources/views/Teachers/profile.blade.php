@extends('layouts.master')


@section('page_header')
    {{$teacher->getName()}}
@endsection


@section('sub_header')
    Symphony Music School
@endsection

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{route('teachers')}}"><i class="fa fa-dashboard"></i> Teachers</a></li>
        <li class="active">{{$teacher->getID()}}</li>
    </ol>


    <div class="row">
        <div class="col-sm-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>Classes</h3>
                    <p>0</p>
                </div>
                <div class="icon">
                    <i class="fa fa-graduation-cap"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>Concert <sup style="font-size: 20px">Items</sup></h3>
                    <p>0</p>
                </div>
                <div class="icon">
                    <i class="glyphicon glyphicon-stats"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>


    </div>



    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$teacher->getID()}} - {{$teacher->getName()}}</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-6">
                    <ul class="nav nav-stacked">
                        <li><a href="#">Address <span class="pull-right text-bold">{{$teacher->getAddress()}}</span></a>
                        </li>
                        <li><a href="#">Gender <span class="pull-right text-bold">{{$teacher->getGender()}}</span></a>
                        </li>
                        <li><a href="#">NIC <span class="pull-right text-bold">{{$teacher->getNic()}}</span></a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6">
                    <ul class="nav nav-stacked">
                        <li><a href="#">Date of Birth
                                <span class="pull-right text-bold">{{date("M d, Y",strtotime($teacher->getDOB()))}}</span></a>
                        </li>
                        <li><a href="#">Contact No
                                @foreach($teacher->getPhones() as $phone)
                                    <span class="pull-right text-bold">{{$phone}}</span><br>
                                @endforeach
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>


@endsection