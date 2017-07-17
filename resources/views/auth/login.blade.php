@extends("layouts.landing")

@section("content")
    <div class="login-box">
        <div class="login-logo">
            <a href="{{url('/')}}"><b>Admin</b>DOE</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Please sign in</p>

            <form action="{{url('login')}}" method="post">

                {{csrf_field()}}

                @if(Session::has('errors'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Oops!</h4>
                        @foreach(Session::get('errors')->all() as $error)
                            {{$error}}
                        @endforeach
                    </div>
                @endif


                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" required name="username"
                           value="{{old('username')}}">

                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div><!-- /.col -->
                </div>
            </form>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
@endsection
