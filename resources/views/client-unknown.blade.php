@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Whoops!</h4>
                </div>
                <div class="panel-body">
                    <p>It looks like this client does not exist or you don't have permission to view it.</p>
                    <a href="/">Go back to dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
