@extends('layouts.app')
@section('title', 'Arkade-nedlastingsstatistikk')
@section('content')
    <div class="container">
        <h1>Arkade-nedlastingsstatistikk</h1>
        <a class="nav-link text-right" href="{{ route('dashboard') }}">Tilbake til kontrollpanel</a>
        <div class="list-group">
            <ul>
                @foreach($links as $linkName => $href)
                    <li class="list-group-item"><a href="{{ $href }}">{{ ucfirst($linkName) }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
