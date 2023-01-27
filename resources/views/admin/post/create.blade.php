@extends('layouts.app')

@section('content')


<div class="container p-5">

    <h1 class="text-center p-4">insert a New Post</h1>

    <form method="POST" action="{{route('admin.post.store')}}">

        @csrf

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select class="form-control" name="category_id" id="">
                <option value="">Seleziona la categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="my-3">
            <label for="">Tags:</label>
            @foreach ( $tags as $tag )
            <label for="">
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                {{ $tag->name }}
            </label>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Add Post</button>

    </form>

</div>

@endsection