@props(['imageUrl', 'title', 'addressLine1', 'addressLine2', 'hours', 'timeSlots', 'detailUrl'])

<a href="{{ $detailUrl }}" class="block">
    <div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200']) }}>
        {{-- Product Image --}}
        <img src="{{ $imageUrl }}" alt="{{ $title }}" class="w-full h-48 object-cover">

        <div class="p-4">
            {{-- Product Title --}}
            <h3 class="text-lg font-semibold text-text-primary mb-2">{{ $title }}</h3>

            {{-- Address --}}
            <p class="text-sm text-text-secondary mb-1">{{ $addressLine1 }}</p>
            <p class="text-sm text-text-secondary mb-3">{{ $addressLine2 }}</p>

            {{-- Hours --}}
            <p class="text-xs text-gray-500 mb-4">{{ $hours }}</p>

            {{-- Time Slots Buttons --}}
            <div class="flex flex-wrap gap-2">
                @foreach ($timeSlots as $slot)
                    <button type="button" class="bg-primary text-text-light px-3 py-1 rounded-md text-sm hover:bg-primary-dark transition duration-200">
                        {{ $slot }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</a>