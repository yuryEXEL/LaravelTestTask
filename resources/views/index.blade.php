@extends('layouts.main')

@section('content')

    <div class="container" id="user_list">
        @include('layouts.user.partials.export_import')
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
            </tr>
            </thead>
            <tbody id="userBody">
            @foreach ($paginate->items() as $user)
                <tr class="user-row" data-id="{{ $user->id }}">
                    <td>{{ $user->id }}</td>
                    <td id="username_{{ $user->id }}" data-value={{ $user->username }} >{{ $user->username }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if($paginate->hasPages())
        @if($paginate->hasMorePages())
            <div>
                <a href="{{$paginate->nextPageUrl()}}">Next page</a>
            </div>
        @else
            <div>
                <a href="{{$paginate->previousPageUrl()}}">Previous page</a>
            </div>
        @endif
    @endif
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    @csrf
                    <input type="hidden" id="userId" class="form-control">
                    <input type="text" id="newUsername" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-save-user-submit" id="saveUser">Save user</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="{{ asset('js/main.js') }}" defer></script>
@endpush
