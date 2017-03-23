@extends('layouts.client-update')

@section('user-management-for-client')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Access Management</h4>
        </div>

        <div class="panel-body">
            @if(count($users) > 0)
            <form action="/client/edit/{{$client->uid}}/permissions" method="POST">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="table-responsive">
                <table class="table">
                @foreach($users as $user)
                    <tr>
                        <td>
                            <label for="userName">{{ $user->first_name }} {{ $user->last_name }}</label>
                        </td>
                        <td>
                            <input type="checkbox" name="canAccess-{{$user->uid}}" id="canAccess-{{$user->uid}}" {{ $user->canAccess ? 'CHECKED' : '' }}>
                        </td>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-default">Save</button>
                        </td>
                    </tr>
                </table>
                </div>
            </form>
            @else
                There are no active users in the system at the moment.
            @endif
        </div>
    </div>
@endsection

@section('delete-client-button')
    <form action="/client/edit/{{$client->uid}}" method="POST">
        {{ method_field('DELETE') }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" name="deleteBtn" id="deleteBtn" class="btn btn-danger">Delete client</button>
    </form>
@endsection
