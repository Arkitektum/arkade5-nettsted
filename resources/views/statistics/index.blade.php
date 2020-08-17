@extends('layouts.app')
@section('title', 'Arkade-statistikk')
@section('content')
    <div class="container">
        <h1>Arkade-statistikk</h1>
        <div class="list-group">
            <ul>
                @foreach($links as $linkName => $href)
                    <li class="list-group-item"><a href="{{ $href }}">{{ ucfirst($linkName) }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
