@extends('layout')

@section('content')
<div class="row centered-form">
    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Please Login</h3>
            </div>
            <div class="panel-body">
                <form role="form" method="post">

                    <div class="form-group">
                        <input type="username" name="username" class="form-control input-sm" placeholder="Username">
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control input-sm" placeholder="Password">
                    </div>

                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                        </label>
                    </div>

                    <input type="submit" value="Login" class="btn btn-info btn-block">

                </form>
            </div>
        </div>
    </div>
</div>

@stop