<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex pl-3 font-semibold text-xl text-gray-800 dark:text-gray-200">
            {{ __('Arkade-nedlastingsstatistikk') }}
        </h2>
        <a href="{{ route('dashboard') }}" class="float-right px-3 pt-1 border border-transparent text-sm font-medium
                    rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700
                    dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
            &#x2190 Til oversikt
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <ul class="list-none space-y-4">
                    @foreach($links as $linkName => $href)
                    <li>
                        <a class="p-4 block shadow rounded hover:bg-gray-50"
                           href="{{ $href }}">
                            <x-list-link-arrow/>
                            {{ ucfirst($linkName) }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
