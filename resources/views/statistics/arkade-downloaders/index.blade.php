<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex pl-3 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Arkadenedlastere') }} ({{ $totalCount }})
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
                        <th class="p-4">E-post</th>
                        <th class="p-4">Erfaring fra Arkade 1.x</th>
                        <th class="p-4">Ønsker Arkade-nyheter</th>
                        <th class="p-4">Nedlastinger</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($downloaders as $downloader)
                    <tr class="border-b dark:border-neutral-500">
                        <td class="p-4">{{ $downloader->email }}</td>
                        <td class="p-4">{{ $downloader->has_arkade_v1_experience ? 'Ja' : '' }}
                        </td>
                        <td class="p-4">{{ $downloader->wants_news ? 'Ja' : '' }}</td>
                        <td class="p-4">{{ $downloader->downloads->count() }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="p-4 pt-6">{{ $downloaders->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
