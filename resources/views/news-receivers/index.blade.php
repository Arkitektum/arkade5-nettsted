<x-app-layout>
    <x-slot name="header">
        <h2 class="pl-3 font-semibold text-xl text-gray-800 dark:text-gray-200">
            {{ __('Arkade-nyhetsinteressenter') }} <span class="font-light">({{ $numberOfNewsReceivers }})</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <hr/>
                <div class="text-field">{{ implode('; ', $newsReceiverEmails) }}</div>
                <hr class="py-2"/>
                <a class="font-bold border border-transparent rounded-md text-gray-500 dark:text-gray-400 bg-white
                dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition
                ease-in-out duration-150"
                   href="mailto:{{ Auth::user()->email }}?bcc={{ implode('; ', $newsReceiverEmails) }}
           &subject=Arkade5%20versjon%20{{ $latestArkadeVersionNumber }}%20er%20utgitt&body=Kjære%20Arkade-bruker.%0D%0A%0D%0AArkade5%20versjon%20{{ $latestArkadeVersionNumber }}%20er%20utgitt.%0D%0A%0D%0ADu%20finner%20alltid%20nyeste%20Arkade-versjon,%20siste%20release-notes%20og%20oppdatert%20dokumentasjon%20på%20https://arkade.arkivverket.no.%0D%0A%0D%0ADu%20mottar%20denne%20e-posten%20fordi%20du%20ved%20tidligere%20nedlasting%20av%20Arkade5%20har%20huket%20av%20for%20at%20du%20ønsker%20Arkade-nyheter.%20Dersom%20du%20ikke%20lenger%20vil%20motta%20slik%20informasjon,%20kan%20du%20melde%20fra%20ved%20å%20svare%20på%20denne%20e-posten.%0D%0AVennlig%20hilsen%20Arkivverket.">
                    Komponer e-postmelding</a>
            </div>
        </div>
    </div>
</x-app-layout>
