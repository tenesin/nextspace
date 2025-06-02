<?php
// resources/views/components/admin-product-card.blade.php
?>
@props(['imageUrl', 'title', 'addressLine1', 'addressLine2', 'hours', 'timeSlots', 'detailUrl', 'nextspaceId'])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 relative group transform hover:-translate-y-1']) }}>
    <div class="absolute top-3 left-3 z-20">
        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 shadow-sm">
            <span class="w-1.5 h-1.5 mr-1.5 bg-green-400 rounded-full animate-pulse"></span>
            Available
        </span>
    </div>

    <div class="absolute top-3 right-3 z-20 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.nextspaces.edit', $nextspaceId) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white p-2.5 rounded-full shadow-lg transition-all duration-200 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
               title="Edit {{ $title }}"
               aria-label="Edit {{ $title }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </a>
            <form action="{{ route('admin.nextspaces.destroy', $nextspaceId) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white p-2.5 rounded-full shadow-lg transition-all duration-200 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                        title="Delete {{ $title }}"
                        aria-label="Delete {{ $title }}"
                        onclick="return confirm('Are you sure you want to delete this NextSpace?');">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <div class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <img src="{{ $imageUrl }}" 
             alt="{{ $title }}" 
             class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
             loading="lazy"
             onerror="this.src='https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&h=250&fit=crop&crop=office'">
        
        <div class="absolute bottom-3 left-3 right-3 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
            <div class="bg-white/90 backdrop-blur-sm rounded-lg p-2">
                <p class="text-sm font-medium text-gray-900 truncate">{{ $title }}</p>
                <p class="text-xs text-gray-600 truncate">{{ $addressLine1 }}</p>
            </div>
        </div>
    </div>

    <a href="{{ $detailUrl }}" 
       class="block focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset"
       aria-label="View details for {{ $title }}">
        <div class="p-5">
            <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-200 line-clamp-2">
                {{ $title }}
            </h3>

            <div class="flex items-start gap-2 mb-3">
                <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <div>
                    <p class="text-sm text-gray-700 font-medium">{{ $addressLine1 }}</p>
                    @if($addressLine2)
                        <p class="text-sm text-gray-500">{{ $addressLine2 }}</p>
                    @endif
                </div>
            </div>

            @if($hours && $hours !== 'N/A')
                <div class="flex items-center gap-2 mb-4">
                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm text-gray-600">{{ $hours }}</p>
                </div>
            @endif

            @php
                $safeTimeSlots = [];
                if (is_array($timeSlots)) {
                    $safeTimeSlots = $timeSlots;
                } elseif (is_string($timeSlots)) {
                    $decoded = json_decode($timeSlots, true);
                    $safeTimeSlots = is_array($decoded) ? $decoded : [];
                }
            @endphp
            
            @if(!empty($safeTimeSlots))
                <div class="mb-4">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Available Times</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach (array_slice($safeTimeSlots, 0, 4) as $slot)
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition-colors duration-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $slot }}
                            </span>
                        @endforeach
                        @if(count($safeTimeSlots) > 4)
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                +{{ count($safeTimeSlots) - 4 }} more
                            </span>
                        @endif
                    </div>
                </div>
            @endif

            @if(!empty($amenities))
                <div class="mt-2 text-sm text-gray-600">
                    Amenities: {{ $amenities->pluck('name')->implode(', ') }}
                </div>
            @endif
            @if(!empty($services))
                <div class="mt-1 text-sm text-gray-600">
                    Services: {{ $services->pluck('name')->implode(', ') }}
                </div>
            @endif

            @if($slot ?? false)
                <div class="mt-4 pt-4 border-t border-gray-100">
                    {{ $slot }}
                </div>
            @endif

            <div class="mt-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-blue-600 group-hover:text-blue-700 transition-colors duration-200">
                        View Details
                    </span>
                    <svg class="w-4 h-4 text-blue-600 group-hover:text-blue-700 transform group-hover:translate-x-1 transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </a>
</div>

@push('scripts')
<script>
    function togglePreview(title, address, hours) {
        let modal = document.getElementById('quickPreviewModal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'quickPreviewModal';
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 hidden';
            modal.innerHTML = `
                <div class="bg-white rounded-xl max-w-md w-full p-6 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Quick Preview</h3>
                        <button onclick="closePreview()" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div id="previewContent">
                        </div>
                </div>
            `;
            document.body.appendChild(modal);
            
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closePreview();
            });
            
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closePreview();
                }
            });
        }
        
        const content = `
            <div class="space-y-3">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <div>
                        <h4 class="font-medium text-gray-900">${title}</h4>
                        <p class="text-sm text-gray-600">${address}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm text-gray-700">${hours || 'Hours not specified'}</span>
                </div>
                <div class="pt-3 border-t border-gray-100">
                    <p class="text-xs text-gray-500 mb-2">Click "View Details" for complete information including booking options.</p>
                </div>
            </div>
        `;
        
        document.getElementById('previewContent').innerHTML = content;
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            const modalContent = document.getElementById('modalContent');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }
    
    function closePreview() {
        const modal = document.getElementById('quickPreviewModal');
        const modalContent = document.getElementById('modalContent');
        
        modalContent.classList.add('scale-95', 'opacity-0');
        modalContent.classList.remove('scale-100', 'opacity-100');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush