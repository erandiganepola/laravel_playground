@extends('layouts.master')


@section('page_header')
    Add Class
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
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Class Details</h3>
        </div><!-- /.box-header -->

        <!-- form start -->
        <form class="form-horizontal" action="{{route('addClass')}}" method="post">

            {{csrf_field()}}

            <div class="box-body">

                <div class="form-group">
                    <label for="code" class="col-sm-2 control-label">Class Code</label>

                    <div class="col-sm-4">
                        <input type="text" maxlength="8" required class="form-control" id="code" placeholder="Code"
                               name="code" value="{{old('code')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Class Name</label>

                    <div class="col-sm-4">
                        <input type="text" required class="form-control" id="name" placeholder="Name" name="name"
                               value="{{old('name')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="individual_class" class="col-sm-2 control-label">Class Type</label>

                    <div class="col-sm-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="class_type" id="individual_class" value="I"
                                       @if(old('class_type')==="I") checked @endif>
                                Individual
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="class_type" id="group_class" value="G"
                                       @if(old('class_type')==="G") checked @endif>
                                Group Class
                            </label>
                        </div>
                    </div>
                </div>

                @for($i=0;$i<3;$i++)
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Instrument {{$i+1}}</label>

                        <div class="col-sm-4">
                            <select @if($i==0) required @endif class="form-control" placeholder="Instrument {{$i+1}}"
                                    name="instrument[]">
                                <option>Select Instrument</option>

                                @foreach($instruments as $instrument)
                                    <option @if(old('instrument')[$i]===$instrument) selected @endif>{{$instrument}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endfor


                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Scheduling</h3>
                    </div>

                    <div class="box-body">

                        <div class="form-group">
                            <label for="start_date" class="col-sm-2 control-label">Start Date</label>

                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="start_date" placeholder="Start Date"
                                       name="start_date" value="{{old('start_date')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="duration_hours" class="col-sm-2 control-label">Duration</label>

                            <div class="col-sm-2">
                                <input type="number" max="12" min="0" class="form-control" id="duration_hours"
                                       placeholder="Hours"
                                       name="duration_hours" value="{{old('duration_hours')}}" required>
                            </div>
                            <div class="col-sm-2">
                                <input type="number" max="59" min="0" step="15" class="form-control"
                                       id="duration_minutes" placeholder="Minutes"
                                       name="duration_minutes" value="{{old('duration_minutes')}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="day_of_week" class="col-sm-2 control-label">Schedule</label>

                            <div class="col-sm-2">
                                <select class="form-control" id="day_of_week" name="day_of_week">
                                    <option id="day_of_week_monday" @if(old('day_of_week')==="MON") selected @endif>
                                        Monday
                                    </option>
                                    <option id="day_of_week_tuesday"
                                            @if(old('day_of_week')==="TUE") selected @endif>
                                        Tuesday
                                    </option>
                                    <option id="day_of_week_wednesday"
                                            @if(old('day_of_week')==="WED") selected @endif>
                                        Wednesday
                                    </option>
                                    <option id="day_of_week_thursday"
                                            @if(old('day_of_week')==="THU") selected @endif>
                                        Thursday
                                    </option>
                                    <option id="day_of_week_friday" @if(old('day_of_week')==="FRI") selected @endif>
                                        Friday
                                    </option>
                                    <option id="day_of_week_saturday"
                                            @if(old('day_of_week')==="SAT") selected @endif>
                                        Saturday
                                    </option>
                                    <option id="day_of_week_sunday" @if(old('day_of_week')==="SUN") selected @endif>
                                        Sunday
                                    </option>
                                </select>

                            </div>

                            <div class="col-sm-2">
                                <input type="time" class="form-control" id="time" name="time"
                                       value="{{old('time')}}"/>

                            </div>
                        </div>

                    </div>

                    <div class="overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="reset" class="btn btn-default">Clear</button>
                <button type="submit" class="btn btn-info pull-right">Add</button>
            </div><!-- /.box-footer -->
        </form>
    </div>


    <script>


        /*
         * Hide the overlay at the begining
         */
        $(document).ready(function () {
            $('.overlay').hide();
            $('#parentFoundAlert').hide();
        });


        /**
         * Send an ajax request and check if the parent exists in the database
         */
        function searchParent() {
            $('#parentFoundAlert').hide();
            $('#parentDetails').collapse('hide');
            $('#parentName').prop('required', false);
            $('#parentPhone').children().eq(0).prop('required', false);

            var nic = $('#parentSearchNic').val();

            if (nic.length != 10) {
                $('#parentSearchNicLabel').collapse('show');
                return;
            }
            else {
                $('#parentSearchNicLabel').collapse('hide');
            }

            $('.overlay').show();

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
                        $('#parentFoundAlert').show();
                    }
                    else {
                        $('#parentDetails').collapse('show');
                        $('#parentName').prop('required', true);
                        $('#parentPhone').children().eq(0).prop('required', true);
                    }

                    $('.overlay').hide();
                }
            });
        }

    </script>
@endsection
