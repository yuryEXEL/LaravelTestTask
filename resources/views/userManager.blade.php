@extends('layouts.main')

@section('title', 'Users manager')

@section('content')
    <button id="createUserButton">Create User</button>
    <button id="updateUserButton">Update User</button>
    <button id="deleteUserButton">Delete User</button>
    <div id="errorContainer" style="display: none; color: red;">
        <ul></ul>
    </div>
    <div id="createUserForm" style="display: none;">
        <form id="userCreateForm">
            @csrf
            @include('layouts.partials.input_fields')
            <input type="submit" class="btn btn-primary" id="createUser" value="Create user" />
        </form>
    </div>
    <div id="updateUserForm" style="display: none;">
        <form id="userUpdateForm">
            @method('PUT')
            @csrf
            @include('layouts.partials.input_fields')
            <input type="submit" class="btn btn-primary" id="updateUser" value="Update user" />
        </form>
    </div>
    <div id="deleteUserForm" style="display: none;">
        <form id="userDeleteForm">
            @method('DELETE')
            @csrf
            <input type="text" name="username" placeholder="Username"><br>
            <input type="submit" class="btn btn-primary" id="deleteUser" value="Delete user" />
        </form>
    </div>
    <div id="successMessages" style="color: green;"></div>
    <div id="errorMessage" style="color: red;"></div>

@endsection

@push('custom-scripts')
    <script src="{{ asset('js/users_manager.js') }}" defer></script>
@endpush
