<!-- CredVerify Logo -->
<div {{ $attributes->merge(['class' => 'flex items-center justify-center']) }}>
    <div class="relative">
        <!-- Shield Background -->
        <div class="w-16 h-20 bg-gradient-to-br from-indigo-600 via-purple-600 to-blue-700 rounded-lg shadow-lg flex items-center justify-center transform rotate-3">
            <!-- Checkmark -->
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <!-- Verification Badge -->
        <div class="absolute -top-1 -right-1 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center shadow-md">
            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
        </div>
    </div>
</div>
