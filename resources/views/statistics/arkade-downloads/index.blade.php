@extends('layouts.app')
@section('title', 'Arkadenedlastinger')
@section('content')
    <div class="container">
        <h1>Arkadenedlastinger</h1>
        <a class="nav-link float-right" href="{{ route('statistics.index') }}">Tilbake til oversikt</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Tidspunkt</th>
                <th scope="col">Bruker - Organisasjon</th>
                <th scope="col">Utgivelse</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($downloads->sortByDesc('downloaded_at') as $download)
                <tr>
                    <td>{{ $download->downloaded_at->format('d.m.y - H:i') }}</td>
                    <td>{{ $download->arkadeDownloader->email }}
                        @isset($download->organization) - {{ $download->organization->name }}@endisset
                    </td>
                    <td>{{ $download->arkadeRelease->version_number }}
                        - {{ $download->arkadeRelease->user_interface }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $downloads->links() }}
    </div>
@endsection
