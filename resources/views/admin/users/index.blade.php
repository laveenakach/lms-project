@extends('layouts.app')
@section('title', 'Manage Users')

@section('content')
<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-semibold"><i class="bi bi-people me-2"></i> Manage Users</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" onclick="openCreateModal()">
            <i class="bi bi-plus-circle"></i> Add User
        </button>
    </div>

    <div class="table-responsive">
        <table id="userTable" class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Sr No.</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <img src="{{ $user->photo ? asset('uploads/profile/'.$user->photo) : asset('images/default-user.png') }}"
                            class="rounded-circle" width="40" height="40">
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge bg-info text-dark">{{ ucfirst($user->role) }}</span></td>
                    <td>
                        <!-- <button class="btn btn-sm btn-warning" onclick="openEditModal('{{ $user }}')">
                            <i class="bi bi-pencil"></i>
                        </button> -->

                        <button class="btn btn-sm btn-warning"
                            onclick='openEditModal(@json($user))'>
                             <i class="bi bi-pencil"></i>
                        </button>

                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- 🧩 Add/Edit Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" id="userForm">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTitle">Add User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="trainer">Trainer</option>
                                <option value="student">Student</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control" accept="image/*" onchange="previewPhoto(event)">
                        </div>
                        <div class="col-md-6 text-center">
                            <img id="previewImg" src="{{ asset('images/default-user.png') }}" width="80" class="rounded-circle border mt-3">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-save"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Include DataTables CDN --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#userTable').DataTable();

        // Reset modal when closed
        $('#userModal').on('hidden.bs.modal', function() {
            $('#userForm')[0].reset();
            $('#previewImg').attr('src', '{{ asset("images/default-user.png") }}');
        });
    });

    function previewPhoto(event) {
        const output = document.getElementById('previewImg');
        output.src = URL.createObjectURL(event.target.files[0]);
    }

    function openCreateModal() {
        $('#modalTitle').text('Add User');
        $('#formMethod').val('POST');
        $('#userForm').attr('action', '{{ route("admin.users.store") }}');
        $('#userModal').modal('show');
    }

    function openEditModal(user) {
        $('#modalTitle').text('Edit User');
        $('#formMethod').val('PUT');
        $('#userForm').attr('action', '/admin/users/' + user.id);
        $('#name').val(user.name);
        $('#email').val(user.email);
        $('#role').val(user.role);
        $('#previewImg').attr('src', user.photo ? '/uploads/profile/' + user.photo : '{{ asset("images/default-user.png") }}');
        $('#userModal').modal('show');
    }
</script>
@endsection