@extends('layouts.master')

@section('content')
    {{-- ✅ External CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/project.css') }}">

    <style>
        .addpost {
            background-color: #0C5097;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .addpost:hover {
            background-color: #084170;
        }

        #projects-table th,
        #projects-table td {
            text-align: left;
            font-size: 12px;
            word-wrap: break-word;
        }

        #projects-table th {
            color: #0C5097;
            font-weight: bold;
        }


    </style>

    {{-- ✅ Include Sidebar / Navbar --}}
    @include('pages.main')

    {{-- ✅ Main Table Section --}}
    <div class="container-fluid" id="project-content"
    style="position: absolute; top: 185px; left: 60px; width: 95%;">
    <div class="row">
        <div class="col-lg-12 p-3 mb-3 rounded" style="background-color: #F4F4F4;">
            <table id="projects-table" class="table table-striped"
                style="table-layout: fixed; width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="width: 10%; text-align: left; vertical-align: middle;">ID</th>
                        <th style="width: 15%; text-align: left; vertical-align: middle;">Name</th>
                        <th style="width: 15%; text-align: left; vertical-align: middle;">Email</th>
                        <th style="width: 15%; text-align: left; vertical-align: middle;">Phone</th>
                        <th style="width: 15%; text-align: left; vertical-align: middle;">Role</th>

                        <th style="width: 15%; text-align: left; vertical-align: middle;">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td style="vertical-align: middle;">{{ $user->id }}</td>
                            <td style="vertical-align: middle;">{{ $user->name }}</td>
                            <td style="vertical-align: middle;">{{ $user->email }}</td>
                            <td style="vertical-align: middle;">{{ $user->phone_num ?? 'N/A' }}</td>
                            <td style="vertical-align: middle;">
                                <select class="form-select user-role" data-id="{{ $user->id }}">
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
                                    <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>super admin</option>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>user</option>
                                </select>
                            </td>
                            <td style="vertical-align: middle;">
                                <button class="btn btn-primary btn-sm update-role" data-id="{{ $user->id }}">Update Role</button>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


    {{-- ✅ Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).on('click', '.update-role', function() {
        let userId = $(this).data('id');
        let newRole = $(`.user-role[data-id='${userId}']`).val();

        $.ajax({
            url: "{{ route('admin.update.role') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                user_id: userId,
                role: newRole
            },
            success: function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            },
            error: function(xhr) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>



@endsection
