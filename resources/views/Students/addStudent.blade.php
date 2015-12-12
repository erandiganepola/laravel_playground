@extends('layouts.master')


@section('page_header')
    Add Student
@endsection


@section('sub_header')
    Symphony Music School
@endsection

@section('content')

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Student Details</h3>
        </div><!-- /.box-header -->

        <!-- form start -->
        <form class="form-horizontal">

            {{csrf_field()}}

            <div class="box-body">

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="name" placeholder="Name" name="name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Gender</label>

                    <div class="col-sm-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" id="genderMale" value="" checked="checked">
                                Male
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" id="genderFemale" value="">
                                Female
                            </label>
                        </div>

                    </div>
                </div>


                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="address" placeholder="Address">
                    </div>
                </div>


                <div class="form-group">
                    <label for="birthday" class="col-sm-2 control-label">Date of Birth</label>

                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="birthday" placeholder="Date of Birth" required>
                    </div>
                </div>

                @for($i=1;$i<3;$i++)
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">Phone {{$i}}</label>

                        <div class="col-sm-4">
                            <input type="tel" class="form-control" id="phone{{$i}}" placeholder="Date of Birth"
                                   name="phone{{$i}}">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                @endfor

            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Add</button>
            </div><!-- /.box-footer -->
        </form>
    </div>


@endsection
