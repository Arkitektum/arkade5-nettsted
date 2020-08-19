@extends('layouts.app')
@section('title', 'Arkadenedlastere')
@section('content')
    <div class="container">
        <h1>Arkadenedlastere</h1>
        <a class="nav-link float-right" href="{{ route('statistics.index') }}">Tilbake til oversikt</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">E-post</th>
                <th scope="col">Erfaring fra Arkade 1.x</th>
                <th scope="col">Ønsker Arkade-nyheter</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($downloaders as $downloader)
                <tr>
                    <td>{{ $downloader->email }}</td>
                    <td>{{ $downloader->has_arkade_v1_experience ? 'Ja' : '' }}</td>
                    <td>{{ $downloader->wants_news ? 'Ja' : '' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $downloaders->links() }}
    </div>
@endsection
