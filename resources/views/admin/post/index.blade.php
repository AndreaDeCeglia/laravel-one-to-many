@extends('layouts.app')

@section('content')
    <h1>Qui stamperò i posts</h1>

    <div>
        <a class="btn btn-primary" href="{{ route('admin.post.create') }}">
            NEW POST!!
        </a>
    </div>

    @foreach ($posts as $item)
        <div class="card" style="width: 18rem;">
            <a href="{{ route('admin.post.show', $item->id) }}">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $item->title }}
                    </h5>
                    <p class="card-text">
                        {{ $item->body }}
                    </p>
                    <div class="d-flex justify-content-around align-items-center">
                        <a href="{{ route('admin.post.edit', $item->id) }}" class="btn btn-primary">
                            EDIT
                        </a>
                        <form action="{{route('admin.post.destroy', $item->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-dark" type="submit">
                                DELETE
                            </button>
                        </form>
                    </div>
                </div>
            </a>
        </div>
    @endforeach


@endsection