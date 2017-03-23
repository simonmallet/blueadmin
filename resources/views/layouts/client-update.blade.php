@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Client Update Form</h4>
                </div>

                <div class="panel-body">
                    <form action="/client/edit/{{$client->uid}}" method="POST">
                        {{ method_field('PUT') }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="clientName">Client Name</label>
                            <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" value="{{ (!empty(old('clientName'))) ? old('clientName') : $client->name }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="clientAddress">Address</label>
                            <input type="text" class="form-control" id="clientAddress" name="clientAddress" placeholder="Client Address" value="{{ (!empty(old('clientAddress'))) ? old('clientAddress') : $client->address }}">
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
