@extends('site.layout.master')

@section('content')

            <div class="panel panel-default panel-login" >
                <div class="panel-heading"><h3>Login</h3></div>
                <div class="panel-body">

                @include('errors.errors')
                @if(Session::has('login'))
                        <div class="alert alert-warning">
                        <em>{!! Session('login') !!}</em>
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times</span>
                        </button>
                        </div>
                 @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/customerlogin') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">UserName</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                            </div>
                        </div>

                       
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a href="{{url('customersignup')}}" class="btn btn-success">
                                    <i class="fa fa-btn fa-sign-up"></i> Register
                                </a>

                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>

@endsection
