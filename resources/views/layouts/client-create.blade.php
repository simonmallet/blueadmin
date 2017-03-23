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
                    <h4>Client Creation Form</h4>
                </div>

                <div class="panel-body">
                    <form action="/client/new" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="table-responsive">
                            <table class="table">
                            <tr>
                                <td>Client Name</td>
                                <td><input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" value="{{ old('clientName') }}" autofocus></td>
                            </tr><tr>
                                <td>Address</td>
                                <td><input type="text" class="form-control" id="clientAddress" name="clientAddress" placeholder="Client Address" value="{{ old('clientAddress') }}"></td>
                            </tr>

                            @yield('user-management-for-client')

                            <tr>
                                <td colspan="2"><button type="submit" class="btn btn-default">Save</button></td>
                            </tr>
                            </table>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
