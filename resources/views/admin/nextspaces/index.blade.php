<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-text-primary">Manage NextSpaces</h2>
                    <a href="{{ route('admin.nextspaces.create') }}" class="bg-primary text-text-light px-4 py-2 rounded-lg hover:bg-primary-dark transition duration-200">Create New NextSpace</a>
                </div>

                @if (session('success'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($nextspaces->isEmpty())
                    <p class="text-text-secondary text-center">No NextSpaces found. Create one!</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($nextspaces as $nextspace)
                            <x-admin-product-card
    imageUrl="{{ is_array($nextspace->image) ? '' : ($nextspace->image ?? 'https://placehold.co/400x250/E0F2F7/00B4D8?text=NextSpace+Image') }}"
    title="{{ is_array($nextspace->title) ? '' : $nextspace->title }}"
    addressLine1="{{ is_array($nextspace->address) ? '' : $nextspace->address }}"
    addressLine2=""
    hours="{{ is_array($nextspace->hours) ? 'N/A' : ($nextspace->hours ?? 'N/A') }}"
    :timeSlots="$nextspace->time_slots ?? []"
    :detailUrl="route('nextspaces.show', ['id' => $nextspace->id])"
    :nextspaceId="$nextspace->id"
/>

                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
