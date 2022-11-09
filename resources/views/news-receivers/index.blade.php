@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Arkade-nyhetsinteressenter <span class="small">({{ $numberOfNewsReceivers }})</span></h1>
        <a class="nav-link text-right" href="{{ route('dashboard') }}">Tilbake til kontrollpanel</a>
        <div>
            <hr/>
            <div class="text-field">{{ implode('; ', $newsReceiverEmails) }}</div>
            <hr/>
            <b><a href="mailto:{{ Auth::user()->email }}?bcc={{ implode('; ', $newsReceiverEmails) }}
           &subject=Arkade5%20versjon%20{{ $latestArkadeVersionNumber }}%20er%20utgitt&body=Kjære%20Arkade-bruker.%0D%0A%0D%0AArkade5%20versjon%20{{ $latestArkadeVersionNumber }}%20er%20utgitt.%0D%0A%0D%0ADu%20finner%20alltid%20nyeste%20Arkade-versjon,%20siste%20release-notes%20og%20oppdatert%20dokumentasjon%20på%20https://arkade.arkivverket.no.%0D%0A%0D%0ADu%20mottar%20denne%20e-posten%20fordi%20du%20ved%20tidligere%20nedlasting%20av%20Arkade5%20har%20huket%20av%20for%20at%20du%20ønsker%20Arkade-nyheter.%20Dersom%20du%20ikke%20lenger%20vil%20motta%20slik%20informasjon,%20kan%20du%20melde%20fra%20ved%20å%20svare%20på%20denne%20e-posten.%0D%0AVennlig%20hilsen%20Arkivverket.">
                    Komponer e-postmelding</a></b>
        </div>
    </div>
@endsection
