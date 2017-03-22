@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{ $client->name }}</h4>
                </div>

                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label for="clientName">Client Name</label>
                            <input type="text" class="form-control" id="clientName" placeholder="Client Name" value="{{ $client->name }}">
                        </div>
                        <div class="form-group">
                            <label for="clientAddress">Address</label>
                            <input type="text" class="form-control" id="clientAddress" placeholder="Client Address" value="{{ $client->address }}">
                        </div>
                        <button type="submit" class="btn btn-default">Save</button>
                    </form>

                </div>
            </div>
            @yield('user-management-for-client')
        </div>
    </div>
</div>
@endsection
