@extends('layouts.app')
@section('page_title', 'Add User')

@section('content')
<div class="card p-4 shadow-sm">
    <h4 class="mb-3">Add New User</h4>

    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Role</label>
                <select name="role" class="form-select" required>
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="trainer">Trainer</option>
                    <option value="student">Student</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save User</button>
    </form>
</div>

<script>
function togglePassword() {
    const password = document.getElementById('password');
    password.type = password.type === 'password' ? 'text' : 'password';
}
</script>
@endsection
