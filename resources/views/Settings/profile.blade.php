@extends('layouts.master')

@section('page_header')
    User Profile
@endsection

@section('sub_header')
    Symphony Music School
@endsection

@section('content')

    <link href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}" rel="script"></script>


    <div class="container-fluid" style="margin-bottom: 5px;">

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class=""><a href="#basicInfo" data-toggle="tab" aria-expanded="false">Basic Info</a></li>
                    <li class="active"><a href="#changePassword" data-toggle="tab" aria-expanded="true">Change Password</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="basicInfo">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Role</label>
                                <div class="col-sm-10">
                                    <div class="btn-group">
                                        <select class="form-control" role="menu">
                                            <option>Admin</option>
                                            <option>Clerk</option>

                                        </select>
                                    </div>
                                    {{--<input type="text" class="form-control" id="inputName" placeholder="Name">--}}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> I agree to change my basic Info.</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.tab-pane -->


                    <div class="tab-pane active" id="changePassword">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Current Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputCurrentPWD" placeholder="Enter Current Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputNewPWD" placeholder="Enter New Password ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Re-Enter New Password</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputReEnterNewPWD" placeholder="Re-Enter New Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">Change my password</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div>
    </div>



@endsection



