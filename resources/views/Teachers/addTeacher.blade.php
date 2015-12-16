@extends('layouts.master')


@section('page_header')
    Add Teacher
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




    {{--Form to add a teacher--}}
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
                        <input type="text" required class="form-control" id="name" placeholder="Name" name="name"
                               value="{{old('name')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="genderMale" class="col-sm-2 control-label">Gender</label>

                    <div class="col-sm-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" id="genderMale" value="M"
                                       @if(old('gender')==='M') checked @endif>
                                Male
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" id="genderFemale" value="F"
                                       @if(old('gender')==='F') checked @endif>
                                Female
                            </label>
                        </div>

                    </div>
                </div>


                <div class="form-group">
                    <label for="nic" class="col-sm-2 control-label">NIC</label>

                    <div class="col-sm-4">
                        <input type="text" pattern="[0-9]{9}[A-Z]{1}" class="form-control" id="nic"
                               placeholder="NIC" name="nic" required value="{{old('nic')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="address" placeholder="Address"
                               name="address" value="{{old('address')}}">
                    </div>
                </div>


                <div class="form-group">
                    <label for="birthday" class="col-sm-2 control-label">Date of Birth</label>

                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="birthday" placeholder="Date of Birth" required
                               name="birthday" value="{{old('birthday')}}">
                    </div>
                </div>

                @for($i=1;$i<3;$i++)
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">Phone {{$i}}</label>

                        <div class="col-sm-4">
                            <input type="tel" class="form-control" id="phone[]" placeholder="Phone"
                                   name="phone[]" value="{{old('phone')[$i-1]}}">
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
