@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Clients</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 bg-primary">
                            <p><h4>Police Academy</h4></p>
                        </div>
                        <div class="col-xs-12 col-sm-10 bg-info">
                            <p class="text-centered">800 Principal St, Wichita, KS, 02991</p>
                        </div>
                        <div class="col-xs-12 col-sm-2 bg-info text-center">
                            <button type="button" class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-pencil"></span> Edit
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 bg-primary">
                            <h4>Batman Inc</h4>
                        </div>
                        <div class="col-xs-12 col-sm-10 bg-info">
                            <p class="text-centered">800 Principal St, Wichita, KS, 02991</p>
                        </div>
                        <div class="col-xs-12 col-sm-2 bg-info text-center">
                            <button type="button" class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-pencil"></span> Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
