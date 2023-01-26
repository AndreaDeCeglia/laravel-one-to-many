@extends('layouts.app')

@section('content')

  <div class="container p-5">

    <h1 class="text-center p-4">Modify Post</h1>

    <form method="POST" action="{{ route('admin.post.update', $item->id) }}">

      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" value="{{$item->title}}" type="text" class="form-control @error('title') is-invalid @enderror">
        @error('title')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="body" class="form-control @error('body') is-invalid @enderror">
          {{$item->body}}
        </textarea>
        @error('description')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div>
        <label>Categories</label>
        <select class="form-control" name="category_id">
            <option value="">Seleziona</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{$category->id == old('category_id', $item->category_id) ? 'selected' : ''}}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Modify Post</button>

    </form>

  </div>

@endsection
