<x-app-layout>
    <div class="py-6 max-w-3xl mx-auto px-4">
        <h2 class="text-xl font-medium mb-4 text-gray-800">My Favorite Spaces</h2>
        @forelse ($favorites as $favorite)
            <div
                class="border border-gray-200 rounded-md p-3 mb-2 hover:border-blue-300 transition-colors"
            >
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <div class="font-medium text-gray-900 truncate">
                            {{ $favorite->nextspace->title }}
                        </div>
                        <div class="text-sm text-gray-600 truncate">
                            {{ $favorite->nextspace->address }}
                        </div>
                    </div>
                    <a
                        href="{{ route('nextspaces.show', $favorite->nextspace->id) }}"
                        class="ml-3 text-blue-600 hover:text-blue-700 text-sm font-medium whitespace-nowrap"
                    >
                        View
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center py-8">
                <p class="text-gray-500">No favorite spaces yet</p>
            </div>
        @endforelse
    </div>
</x-app-layout>
