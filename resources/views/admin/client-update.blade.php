@extends('layouts.client-update')

@section('user-management-for-client')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Access Management</h4>
        </div>

        <div class="panel-body">
            <form>
                <div class="table-responsive">
                <table class="table">
                @foreach($users as $user)
                    <tr>
                        <td>
                            <label for="userName">{{ $user->first_name }} {{ $user->last_name }}</label>
                        </td>
                        <td>
                            <input type="checkbox" id="canAccess{{$user->uid}}" {{ $user->canAccess ? 'CHECKED' : '' }}>
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

        </div>
    </div>
@endsection
