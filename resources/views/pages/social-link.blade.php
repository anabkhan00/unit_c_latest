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

        .modal-backdrop {
    --bs-backdrop-zindex: 1050;
     --bs-backdrop-bg: white !important; 
    --bs-backdrop-opacity: 0.5;
    position: fixed;
    top: 0;
    left: 0;
     z-index:1 !important; 
    width: 100vw;
    height: 100vh;
    background-color: var(--bs-backdrop-bg);
}
    </style>

    {{-- ✅ Include Sidebar / Navbar --}}
    @include('pages.main')

    {{-- ✅ Main Table Section --}}
    <div class="container-fluid" id="project-content"
        style="position: absolute; top: 185px; left: 60px; width: 95%;">
        <div class="row">
            <div class="col-lg-12 p-3 mb-3 d-flex justify-content-end" style="background-color: #F4F4F4;">
                <!-- Add Post Button -->
                <button class="addpost" data-bs-toggle="modal" data-bs-target="#addPostModal">Add Post</button>
            </div>
<div class="col-lg-12 p-3 mb-3 rounded" style="background-color: #F4F4F4;">
    <table id="projects-table" class="table table-striped"
        style="table-layout: fixed; width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="width: 33%; text-align: left; vertical-align: middle;">Title</th>
                <th style="width: 33%; text-align: left; vertical-align: middle;">Image</th>
                <th style="width: 33%; text-align: left; vertical-align: middle;">Description</th>
            </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
                <td style="vertical-align: middle;">{{ $post->title }}</td>
                <td style="vertical-align: middle;">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid"
                             style="height: 40px; width: 40px;" alt="Post Image">
                    @else
                        {{--  <img src="{{ asset('images/default-image.svg') }}" class="img-fluid"
                             style="height: 40px; width: 40px;" alt="Default Image">  --}}
                             NA
                    @endif
                </td>
                <td style="vertical-align: middle;">{!! $post->description !!}</td>
                
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

        </div>
    </div>

    {{-- ✅ Modal --}}
    <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" >
                    <h5 class="modal-title" id="addPostModalLabel">Create New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
    <form id="postForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" id="image" name="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary addpost">Post</button>
        </div>
    </form>
</div>

            </div>
        </div>
    </div>

    {{-- ✅ Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let editorInitialized = false;
            const modal = document.getElementById('addPostModal');

            // Initialize CKEditor when modal is opened
            modal.addEventListener('shown.bs.modal', function() {
                if (!editorInitialized) {
                    CKEDITOR.replace('description');
                    editorInitialized = true;
                }
            });

            // Handle form submission
            
        });
    </script>
@endsection
