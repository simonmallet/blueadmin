@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (session('save_successful'))
                <div class="alert alert-success">
                    {{ session('save_successful') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        Clients
                        @if (Auth::user()->userPrivilege->level == 'ADMIN')
                            <a href="/client/new" class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-plus-sign"></span> Add Client
                            </a>
                        @endif
                    </h4>

                </div>

                <div class="panel-body">
                    @if (count($clients) > 0)
                        @foreach ($clients as $client)
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 bg-primary">
                                    <p><h4>{{ $client->name }}</h4></p>
                                </div>
                                <div class="col-xs-12 col-sm-10 bg-info">
                                    <p class="text-centered">{{ $client->address or '- No address on file -' }}</p>
                                </div>
                                <div class="col-xs-12 col-sm-2 bg-info">
                                    <a href="/client/edit/{{ $client->uid }}" class="btn btn-default btn-sm text-centered">
                                        <span class="glyphicon glyphicon-pencil"></span> Edit
                                    </a>
                                </div>
                            </div>
                            @if (!$loop->last)
                                <div class="row">
                                    <div class="col-xs-12"></div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="row">
                            <div class="col-xs-12">
                                <h5>No client could be found in the system</h5>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
