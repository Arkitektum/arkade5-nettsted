@extends('layouts.app')
@section('title', 'Arkadenedlaster-organisasjoner')
@section('content')
    <div class="container">
        <h1>Arkadenedlaster-organisasjoner
            @isset($totalCount)
                <span class="small">({{ $totalCount }})</span>
            @endisset
        </h1>
        <a class="nav-link float-right" href="{{ route('statistics.index') }}">Tilbake til oversikt</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Navn</th>
                <th scope="col">Organisasjonsform</th>
                <th scope="col">Organisasjonsnummer</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($organizations as $organization)
                <tr>
                    <td>{{ $organization->name }}</td>
                    <td>{{ $organization->org_form }}</td>
                    <td>{{ $organization->org_number }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $organizations->links() }}
    </div>
@endsection
