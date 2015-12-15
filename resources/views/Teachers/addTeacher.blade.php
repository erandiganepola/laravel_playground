@extends('layouts.master')


@section('page_header')
    Add Teacher
@endsection


@section('sub_header')
    Symphony Music School
@endsection

@section('content')

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Teacher Details</h3>
        </div><!-- /.box-header -->

        <!-- form start -->
        <form class="form-horizontal" action="{{route('addTeacher')}}" method="post">

            {{csrf_field()}}

            <div class="box-body">

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="name" placeholder="Name" name="name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="genderMale" class="col-sm-2 control-label">Gender</label>

                    <div class="col-sm-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" id="genderMale" value="M" checked="checked">
                                Male
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" id="genderFemale" value="F">
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
                        <input type="text" required class="form-control" id="address" placeholder="Address"
                               name="address">
                    </div>
                </div>


                <div class="form-group">
                    <label for="birthday" class="col-sm-2 control-label">Date of Birth</label>

                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="birthday" placeholder="Date of Birth" required
                               name="birthday">
                    </div>
                </div>

                @for($i=1;$i<3;$i++)
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">Phone {{$i}}</label>

                        <div class="col-sm-4">
                            <input type="tel" class="form-control" id="phone[]" placeholder="Phone"
                                   name="phone[]">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                @endfor


                {{--
                ========================================================
                Enter the parent's details. First, search for the parent.
                ========================================================
                --}}
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Parent's Details</h3>
                    </div>

                    <div class="box-body">

                        {{--Search for the student's parent if exists, else, give the option to enter the student's details--}}
                        <div class="form-group">
                            <label for="parentSearchNic" class="col-sm-2 control-label">Parent's NIC</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="parentSearchNic"
                                       placeholder="Parent's NIC (xxxxxxxxxV)" name="parenSearchNic"
                                       required pattern="{10}" oninput="searchParent()">

                                <div class="container-fluid collapse" id="parentSearchNicLabel">
                                    <label class="label label-danger">
                                        Please enter a valid NIC
                                    </label>
                                </div>
                            </div>
                        </div>


                        {{--Enter parent's details--}}

                        <div id="parentDetails" class="collapse">
                            <div class="form-group">
                                <label for="parentName" class="col-sm-2 control-label">Parent's Name</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="parentName"
                                           placeholder="Parent's Name" name="parentName">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="parentGenderMale" class="col-sm-2 control-label">Gender</label>

                                <div class="col-sm-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="parentGender" id="parentGenderMale" value="M"
                                                   checked="checked">
                                            Male
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="parentGender" value="F">
                                            Female
                                        </label>
                                    </div>

                                </div>
                            </div>

                            @for($i=1;$i<3;$i++)
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Phone {{$i}}</label>

                                    <div class="col-sm-4">
                                        <input type="tel" class="form-control" placeholder="Phone"
                                               name="parentPhone[]">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            @endfor
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


    <script>

        /**
         * Send an ajax request and check if the parent exists in the database
         */
        function searchParent() {
            $('#parentDetails').collapse('hide');
            $('#parentName').prop('required', false);
            $('#parentPhone').children().eq(0).prop('required', false);

            var nic = $('#parentSearchNic').val();

            if (nic.length < 10) {
                $('#parentSearchNicLabel').collapse('show');
                return;
            }
            else {
                $('#parentSearchNicLabel').collapse('hide');
            }

            //send the ajax
            $.ajax({
                url: '{{url('getParent')}}/' + nic,
                data: {
                    _token: '{{csrf_token()}}'
                },
                type: 'post',
                success: function (data) {
                    console.log(data);
                    if (data == 1) {

                    }
                    else {
                        $('#parentDetails').collapse('show');
                        $('#parentName').prop('required', true);
                        $('#parentPhone').children().eq(0).prop('required', true);
                    }
                }
            });
        }

    </script>
@endsection
