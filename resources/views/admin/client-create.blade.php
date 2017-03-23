@extends('layouts.client-create')

@section('user-management-for-client')
    @if(count($users) > 0)
            <tr>
                <td colspan="2"><h4>User Access</h4></td>
            </tr>
        @foreach($users as $user)
            <tr>
                <td>
                    <label for="userName">{{ $user->first_name }} {{ $user->last_name }}</label>
                </td>
                <td>
                    <input type="checkbox" name="canAccess-{{$user->uid}}" id="canAccess-{{$user->uid}}">
                </td>
            </tr>
        @endforeach
    @endif
@endsection
