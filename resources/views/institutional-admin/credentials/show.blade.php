<x-institutional-admin-layout>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Credential Details
                </h1>
                <p class="text-gray-600 mt-2">View and manage credential information</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('institutional-admin.credentials.edit', $credential) }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Edit Credential
                </a>
                <a href="{{ route('institutional-admin.credentials.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Back to Credentials
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Credential Information -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Credential Information</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $credential->credential_name }}</h2>
                            <p class="text-gray-600">{{ $credential->type }} • {{ $credential->verification_code }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Credential Name</label>
                            <div class="text-lg text-gray-900">{{ $credential->credential_name }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                @if($credential->type === 'Degree') bg-blue-100 text-blue-800
                                @elseif($credential->type === 'Certificate') bg-green-100 text-green-800
                                @else bg-purple-100 text-purple-800 @endif">
                                {{ $credential->type }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Verification Code</label>
                            <div class="text-lg text-gray-900 font-mono bg-gray-50 px-3 py-2 rounded-lg">{{ $credential->verification_code }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Issued Date</label>
                            <div class="text-lg text-gray-900">{{ $credential->created_at->format('M j, Y \a\t g:i A') }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Issued By</label>
                            <div class="text-lg text-gray-900">{{ $credential->issuedBy->first_name }} {{ $credential->issuedBy->last_name }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Institution</label>
                            <div class="text-lg text-gray-900">{{ $credential->institution->name }}</div>
                        </div>
                    </div>

                    <!-- Credential Hash -->
                    <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-sm font-medium text-gray-800">Credential Hash</h4>
                            <button onclick="copyCredentialHash('{{ $credential->credential_hash ?: 'N/A' }}')" class="text-xs text-blue-600 hover:text-blue-800">Copy</button>
                        </div>
                        <code class="text-xs text-gray-600 break-all">{{ $credential->credential_hash ?: 'Not available' }}</code>
                        <p class="text-xs text-gray-500 mt-2">Cryptographic hash for credential verification</p>
                    </div>

                    @if($credential->file_path)
                        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <h4 class="text-sm font-medium text-blue-800">Credential Document</h4>
                                        <p class="text-sm text-blue-700">Supporting document attached</p>
                                    </div>
                                </div>
                                <a href="{{ route('institutional-admin.credentials.download', $credential) }}" 
                                   class="inline-flex items-center px-3 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Download
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Student Information -->
            <div class="mt-8 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Student Information</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">{{ substr($credential->student_first_name, 0, 1) }}{{ substr($credential->student_last_name, 0, 1) }}</span>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">{{ $credential->student_first_name }} {{ $credential->student_last_name }}</h4>
                            <p class="text-gray-600">{{ $credential->student_school_id }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <div class="text-gray-900">{{ $credential->student_first_name }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <div class="text-gray-900">{{ $credential->student_last_name }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">School ID</label>
                            <div class="text-gray-900 font-mono">{{ $credential->student_school_id }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Student Profile</label>
                            @if($credential->student)
                                <a href="{{ route('institutional-admin.students.show', $credential->student) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 font-medium">
                                    View Student Profile
                                </a>
                            @else
                                <span class="text-gray-500">Student record not found</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Edit Credential -->
                    <a href="{{ route('institutional-admin.credentials.edit', $credential) }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Edit Credential
                    </a>

                    <!-- Download W3C Credential JSON-LD -->
                    <a href="/credential/{{ $credential->id }}/download/institutional-admin" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-4-4m4 4l4-4m-6 4H6a2 2 0 01-2-2V6a2 2 0 012-2h6"></path>
                        </svg>
                        Download W3C JSON-LD
                    </a>

                    <!-- Download Document -->
                    @if($credential->file_path)
                        <a href="{{ route('institutional-admin.credentials.download', $credential) }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Download Document
                        </a>
                    @endif

                    <!-- View Student -->
                    @if($credential->student)
                        <a href="{{ route('institutional-admin.students.show', $credential->student) }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            View Student
                        </a>
                    @endif

                    <!-- Delete Credential -->
                    <form action="{{ route('institutional-admin.credentials.destroy', $credential) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                onclick="return confirm('Are you sure you want to delete this credential? This action cannot be undone.')">
                            Delete Credential
                        </button>
                    </form>
                </div>
            </div>

            <!-- Verification Info -->
            <div class="mt-6 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Verification</h3>
                </div>
                <div class="p-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Verified Credential</h4>
                        <p class="text-gray-600 text-sm mb-4">This credential is authentic and can be verified using the code below:</p>
                        <div class="bg-gray-50 rounded-lg p-3 mb-4">
                            <div class="text-lg font-mono font-bold text-gray-900">{{ $credential->verification_code }}</div>
                        </div>
                        <p class="text-xs text-gray-500">Use this code to verify the authenticity of this credential</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyCredentialHash(hash) {
            navigator.clipboard.writeText(hash).then(() => {
                const button = event.target;
                const originalText = button.textContent;
                button.textContent = '✓ Copied!';
                button.className = 'text-xs text-green-600 hover:text-green-800';
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.className = 'text-xs text-blue-600 hover:text-blue-800';
                }, 2000);
            }).catch(() => {
                alert('Failed to copy hash. Please copy manually.');
            });
        }
    </script>
</x-institutional-admin-layout>
