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
                            <x-product-card
                                imageUrl="{{ $nextspace->image ?? 'https://placehold.co/400x250/E0F2F7/00B4D8?text=NextSpace+Image' }}"
                                title="{{ $nextspace->title }}"
                                addressLine1="{{ $nextspace->address }}"
                                addressLine2=""
                                hours="{{ $nextspace->hours ?? 'N/A' }}"
                                :timeSlots="$nextspace->time_slots ?? []"
                                :detailUrl="route('nextspaces.show', ['id' => $nextspace->id])"
                            >
                                {{-- Display Amenities and Services names --}}
                                @if(!empty($nextspace->amenities))
                                    <div class="mt-2 text-sm text-gray-600">
                                        Amenities: {{ $nextspace->amenities->pluck('name')->implode(', ') }}
                                    </div>
                                @endif
                                @if(!empty($nextspace->services))
                                    <div class="mt-1 text-sm text-gray-600">
                                        Services: {{ $nextspace->services->pluck('name')->implode(', ') }}
                                    </div>
                                @endif

                                <div class="flex justify-end gap-2 mt-4 pt-4 border-t border-gray-100">
                                    <a href="{{ route('admin.nextspaces.edit', $nextspace->id) }}" class="text-primary hover:text-primary-dark text-sm font-medium">Edit</a>
                                    <form action="{{ route('admin.nextspaces.destroy', $nextspace->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium" onclick="return confirm('Are you sure you want to delete this NextSpace?');">Delete</button>
                                    </form>
                                </div>
                            </x-product-card>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
