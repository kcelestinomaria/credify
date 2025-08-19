@props([
    'url',
    'title' => 'Download PDF',
    'description' => '',
    'icon' => 'download',
    'color' => 'blue',
    'size' => 'default'
])

@php
$colorClasses = [
    'blue' => 'from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 border-blue-100 text-blue-600',
    'red' => 'from-red-50 to-orange-50 hover:from-red-100 hover:to-orange-100 border-red-100 text-red-600',
    'green' => 'from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 border-green-100 text-green-600',
    'purple' => 'from-purple-50 to-pink-50 hover:from-purple-100 hover:to-pink-100 border-purple-100 text-purple-600',
    'gray' => 'from-gray-50 to-slate-50 hover:from-gray-100 hover:to-slate-100 border-gray-100 text-gray-600'
];

$sizeClasses = [
    'small' => 'p-3',
    'default' => 'p-4',
    'large' => 'p-6'
];

$iconSizes = [
    'small' => 'w-4 h-4',
    'default' => 'w-6 h-6',
    'large' => 'w-8 h-8'
];

$icons = [
    'download' => 'M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z',
    'document' => 'M9 2a1 1 0 000 2h2a1 1 0 100-2H9z M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5z',
    'report' => 'M9 2a1 1 0 000 2h2a1 1 0 100-2H9z M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5z M7 8a1 1 0 012 0v2a1 1 0 11-2 0V8z M11 8a1 1 0 112 0v2a1 1 0 11-2 0V8z'
];
@endphp

<a href="{{ $url }}" 
   class="flex items-center {{ $sizeClasses[$size] }} bg-gradient-to-r {{ $colorClasses[$color] }} rounded-xl transition-all duration-200 group border">
    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform duration-300 border {{ str_replace('text-', 'border-', explode(' ', $colorClasses[$color])[6]) }}">
        <svg class="{{ $iconSizes[$size] }} {{ explode(' ', $colorClasses[$color])[6] }}" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="{{ $icons[$icon] }}" clip-rule="evenodd"/>
        </svg>
    </div>
    <div class="ml-4">
        <h4 class="font-semibold text-gray-900">{{ $title }}</h4>
        @if($description)
            <p class="text-sm text-gray-600">{{ $description }}</p>
        @endif
    </div>
</a>
