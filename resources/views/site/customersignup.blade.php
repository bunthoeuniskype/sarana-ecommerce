@extends('site.layout.master')

@section('content')

            <div class="panel panel-default panel panel-default col-md-6 col-md-offset-3">
                <div class="panel-heading"><h3>Sign Up</h3></div>
                <div class="panel-body">
                 @include('errors.errors')
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/customersignup') }}">
                        {{ csrf_field() }}
                         <div class="form-group">
                            <label for="email" class="control-label">Email</label>

                            <div class="col-xs-12">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">

                            </div>
                        </div>

                         <div class="form-group">
                            <label for="phone" class="control-label">Phone</label>

                            <div class="col-xs-12">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                            </div>
                        </div>

                         <div class="form-group">
                            <label for="email" class="control-label">UserName</label>

                            <div class="col-xs-12">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>

                            <div class="col-xs-12">
                                <input id="password" type="password" class="form-control" name="password">

                            </div>
                        </div>

                         <div class="form-group">
                            <label for="password" class="control-label">Confirm Password</label>

                            <div class="col-xs-12">
                                <input id="password_confirm" type="password" class="form-control" name="confirm_password">

                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="agree"> Agreement Our Policy!
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right clearfix">
                                    <i class="fa fa-btn fa-sign-in"></i> Sign Up
                                </button>

                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>

@endsection
