<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex pl-3 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ ucfirst(str_replace("_", " ", $buildType)) }}
        </h2>
        <a href="{{ route('builds.index') }}" class="float-right px-3 pt-1 border border-transparent text-sm font-medium
                    rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700
                    dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
            &#x2190 Til Arkadebygg-oversikt
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <ul class="list-none space-y-4">
                    @php rsort($builds) @endphp
                    @foreach ($builds as $build)
                    @php $buildFileBaseName = pathinfo($build)['basename'] @endphp
                    <li>
                        <a title="Arkade-bygg" class="p-4 block shadow rounded hover:bg-gray-50"
                           href="{{ route('builds.buildDownload', [$buildType, $buildFileBaseName]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 inline float-right">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12
                                      16.5m0 0L7.5 12m4.5 4.5V3"/>
                            </svg>
                            {{ $buildFileBaseName }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
