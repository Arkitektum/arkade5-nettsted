@extends('layouts.app')
@section('title', 'Arkadeutgivelser')
@section('content')
    <div class="container">
        <h1>Arkadeutgivelser
            @isset($totalCount)
                <span class="small">({{ $totalCount }})</span>
            @endisset
        </h1>
        <a class="nav-link float-right" href="{{ route('statistics.index') }}">Tilbake til oversikt</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Versjonsnummer</th>
                <th scope="col">Brukergrensesnitt</th>
                <th scope="col">Utgivelsesdato</th>
                <th scope="col">Antall nedlastinger</th>
                <th title="Automatiserte nedlastinger | manuelle nedlastinger" scope="col">Man. | Auto.</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($releases as $release)
                <tr>
                    <td>{{ $release->version_number }}</td>
                    <td>{{ $release->user_interface }}</td>
                    <td>@if(isset($release->released_at)){{ $release->released_at->format('d.m.y') }}@endisset</td>
                    <td>{{ $release->downloads->count() }}</td>
                    <td>
                        <span title="Manuelle nedlastinger">
                            {{ $release->downloads->where('is_automated', false)->count() }}
                        </span>
                        |
                        <span title="Automatiserte nedlastinger">
                            {{ $release->downloads->where('is_automated')->count() }}
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $releases->links() }}
    </div>
@endsection
