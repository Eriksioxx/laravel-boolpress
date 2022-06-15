@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                {{-- Title card --}}
                <div class="card">
                    <div class="card-header">Edit a Post</div>

                    <div class="card-body">
                        <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                            {{-- Token --}}
                            @csrf
                            {{-- / Token --}}

                            {{-- title post --}}
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror "
                                    placeholder="Post's title">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="form-group">
                                <label for="title">Category:</label>
                                <select name="category_id">
                                    <option value="">--Choose category--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
                                            {{ $category->name }} </option>
                                    @endforeach
                                </select>

                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- / Category --}}

                            {{-- Tags --}}
                            <div class="form-group ml-1">
                                <h2 for="title">Tags:</h2>
                                @foreach ($tags as $tag)
                                    @if ($errors->any())
                                        <input class="form-check-input " type="checkbox" value="{{ $tag->id }}"
                                            name="tags[]" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                                    @else
                                        <input class="form-check-input " type="checkbox" value="{{ $tag->id }}"
                                            name="tags[]" {{ $post->tags->contains($tag) ? 'checked' : '' }} />
                                    @endif
                                    <div class="form-check-label">{{ $tag->name }}</div>
                                @endforeach

                                @error('tags[]')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- / Tags --}}

                            <div class="form-group">
                                <label for="content">Content:</label>
                                <textarea type="text" name="content" class="form-control @error('content') is-invalid @enderror"
                                    placeholder="Post's content">

                        </textarea>
                                @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- / title post --}}


                            {{-- / content post --}}

                            <div class="form-group">
                                <input type="submit" class="btn btn-info white" value="Edit Post">
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-success"> Back</a>

            </div>
        </div>
    </div>
@endsection