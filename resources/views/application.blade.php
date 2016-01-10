@extends('layouts.master')


@section('page_header')
    Nipun Sandaruwan
@endsection

@section('sub_header')
    Application for School Preferences |
@endsection

@section('content')

    <link href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}" rel="script"></script>


    {{--Table showing classes--}}
    <div class="box box-primary">

        <style>
            table td, th {
                text-align: center;
            }

        </style>

        <div class="box-body">

            <form action="#" onsubmit="return false" class="form-horizontal">

                <div class="form-group">
                    <label for="examNo" class="col-sm-2 control-label">Examination No</label>

                    <div class="col-sm-4">
                        5623965
                    </div>
                </div>

                <div class="form-group">
                    <label for="examNo" class="col-sm-2 control-label">School</label>

                    <div class="col-sm-10">
                        Horagasmulla Primary School, Divulapitiya
                    </div>
                </div>

                <div class="form-group">
                    <label for="examNo" class="col-sm-2 control-label">Marks Obtained</label>

                    <div class="col-sm-2">
                        167
                    </div>
                </div>


                <div class="form-group">
                    <label for="examNo" class="col-sm-2 control-label">Preference List</label>

                    <div class="col-sm-8">
                        <table class="table table-hover table-condensed">
                            <tr>
                                <td>1</td>
                                <td>Royal College, Colombo 07</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Dharmaraja College, Kandy</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Ananda College, Colombo 10</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Nalanda College, Colombo 10</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Bandaranayake College, Gampaha</td>
                            </tr>

                            <tr>
                                <td>6</td>
                                <td>Thurstan College, Colombo 07</td>
                            </tr>

                            <tr>
                                <td>7</td>
                                <td>Maliyadeva College, Kurunegala</td>
                            </tr>
                        </table>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <p class="text-red" style="font-size: large">Please, verify the application after manually
                                reviewing the printed copy of the
                                application provided by the candidate with the parent's signature
                            </p>
                        </div>
                    </div>


                </div>


            </form>

        </div>

        <div class="box-footer">
            <button class="btn btn-primary pull-right">Verify</button>
            <button class="btn btn-danger pull-left">Reject</button>
        </div>
    </div>

@endsection
