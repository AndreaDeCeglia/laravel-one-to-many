@extends('layouts.app')

@section('content')

<div>
    {{ $item->title }}
</div>
<div>
    {{ $item->body }}
</div>

@endsection