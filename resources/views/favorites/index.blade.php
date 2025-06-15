<x-app-layout>
    <div class="py-8 max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold mb-6">My Favorite Spaces</h2>
        @forelse($favorites as $favorite)
            <div class="bg-white rounded shadow p-4 mb-4 flex items-center justify-between">
                <div>
                    <div class="font-semibold text-lg">{{ $favorite->nextspace->title }}</div>
                    <div class="text-gray-500">{{ $favorite->nextspace->address }}</div>
                </div>
                <a href="{{ route('nextspaces.show', $favorite->nextspace->id) }}" class="text-blue-600 underline">View</a>
            </div>
        @empty
            <p class="text-gray-500">You have no favorite spaces yet.</p>
        @endforelse
    </div>
</x-app-layout>