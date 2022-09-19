@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Kontrollpanel') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="navbar">
                            <div class="navbar-text">Arkade-nedlastingsstatistikk</div>
                            <a class="page-link" title="Statistikk" href="{{ route('statistics.index') }}">HTML</a>
                        </div>
                        <div class="navbar">
                            <div class="navbar-text">Arkade-bygg</div>
                            <a class="page-link" style="display: inline" title="Arkade-bygg"
                               href="{{ route('builds.index') }}">HTML</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
