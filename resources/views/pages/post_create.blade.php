<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
    <h2>Create New Post</h2>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <!-- Post Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" name="title" id="title" 
                   class="form-control @error('title') is-invalid @enderror" 
                   value="{{ old('title') }}" required>
            @error('title')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Post Content -->
        <div class="mb-3">
            <label for="content" class="form-label">Post Content</label>
            <textarea name="content" id="content" rows="5" 
                      class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
            @error('content')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Post</button>
        {{-- <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a> --}}
    </form>
</div>
</body>
</html>