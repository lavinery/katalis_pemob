<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (auth()->user()->isAdmin())
                        <div class="text-2xl mb-4">Welcome Admin!</div>
                    @else
                        <div class="text-2xl mb-4">Welcome Operator!</div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Card Example -->
                        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    <div class="ml-5">
                                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            Total Data
                                        </div>
                                        <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                            100
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tambahkan card lainnya sesuai kebutuhan -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
