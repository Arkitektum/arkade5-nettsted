@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Arkade-bygg</h1>
        <a class="nav-link text-right" href="{{ route('dashboard') }}">Tilbake til kontrollpanel</a>
        <div class="list-group">
            <ul>
                @foreach($buildTypes as $buildType)
                    <li class="list-group-item">
                        <a href="{{ route('builds.buildList', $buildType) }}">{{ ucfirst($buildType) }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
