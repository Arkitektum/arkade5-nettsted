@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ ucfirst($buildType) }}</h1>
        <a class="nav-link text-right" href="{{ route('builds.index') }}">Tilbake til oversikt</a>
        <ul class="list-group">
            @php rsort($builds) @endphp
            @foreach ($builds as $build)
                @php $buildFileBaseName = pathinfo($build)['basename'] @endphp
                <a class="page-link" title="Arkade-bygg"
                   href="{{ route('builds.buildDownload', [$buildType, $buildFileBaseName]) }}"> {{ $buildFileBaseName }}
                </a>
            @endforeach
        </ul>
    </div>
@endsection
