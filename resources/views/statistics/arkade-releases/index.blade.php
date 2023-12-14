<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex pl-3 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Arkadeutgivelser') }} ({{ $totalCount }})
        </h2>
        <a href="{{ route('statistics.index') }}" class="float-right px-3 pt-1 border border-transparent text-sm font-medium
                    rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700
                    dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
            &#x2190 Til statistikkoversikt
        </a>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 text-gray-900 dark:text-gray-100">
                <table class="w-full text-left text-sm">
                    <thead class="border-b dark:border-neutral-500">
                    <tr>
                        <th class="p-4">Versjonsnummer</th>
                        <th class="p-4">Brukergrensesnitt</th>
                        <th class="p-4">Utgivelsesdato (fra – til)</th>
                        <th class="p-4">Antall nedlastinger</th>
                        <th title="Automatiserte nedlastinger | manuelle nedlastinger" scope="col">Man. | Auto.</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($releases as $release)
                    <tr class="border-b dark:border-neutral-500">
                        <td class="p-4">{{ $release->version_number }}</td>
                        <td class="p-4">{{ $release->user_interface }}</td>
                        <td class="p-4">@if(isset($release->released_at))
                            {{ $release->released_at->format('d.m.y') }}@endisset
                            @if(isset($release->dereleased_at))
                            – {{ $release->dereleased_at->format('d.m.y') }}@endisset
                        </td>
                        <td class="p-4">{{ $release->downloads->count() }}</td>
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
                <div class="p-4 pt-6">{{ $releases->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
