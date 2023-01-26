@extends('layouts.app')

@section('content')

<div>
    il titolo è:
    {{ $item->title }}
</div>
<div>
    il corpo del post è:
    {{ $item->body }}
</div>
<div>
    la categoria è:
    {{ $item->category['name'] }}
</div>

@endsection