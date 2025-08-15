<x-institutional-admin-layout>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Student Details
                </h1>
                <p class="text-gray-600 mt-2">View and manage student information</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('institutional-admin.students.edit', $student) }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Edit Student
                </a>
                <a href="{{ route('institutional-admin.students.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Back to Students
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Student Information -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Student Information</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-xl">{{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}</span>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $student->first_name }} {{ $student->last_name }}</h2>
                            <p class="text-gray-600">{{ $student->email }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <div class="text-lg text-gray-900">{{ $student->first_name }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <div class="text-lg text-gray-900">{{ $student->last_name }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">School ID</label>
                            <div class="text-lg text-gray-900 font-mono">{{ $student->school_id }}</div>
                        </div>
                        <div class="min-w-0">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <div class="text-lg text-gray-900" style="word-break: break-all; overflow-wrap: break-word; max-width: 100%;">{{ $student->email }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Institution</label>
                            <div class="text-lg text-gray-900">{{ $student->institution->name ?? 'N/A' }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Registered</label>
                            <div class="text-lg text-gray-900">{{ $student->created_at->format('M j, Y \a\t g:i A') }}</div>
                        </div>
                    </div>

                    @if($student->temporary_password)
                        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <h4 class="text-sm font-medium text-blue-800">Temporary Password</h4>
                                        <p class="text-sm text-blue-700 mt-1">Student must use this password for first login.</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <code class="bg-blue-100 text-blue-800 px-3 py-1 rounded font-mono text-sm font-semibold">{{ $student->temporary_password }}</code>
                                    <button onclick="copyToClipboard('{{ $student->temporary_password }}')" 
                                            class="text-blue-600 hover:text-blue-800 p-1 rounded hover:bg-blue-100 transition-colors duration-200"
                                            title="Copy to clipboard">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @elseif($student->must_change_password)
                        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-yellow-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-yellow-800">Password Change Required</h4>
                                    <p class="text-sm text-yellow-700 mt-1">This student must change their password on next login.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Student Credentials -->
            <div class="mt-8 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Student Credentials</h3>
                        <a href="{{ route('institutional-admin.credentials.create', ['student_id' => $student->id]) }}" 
                           class="inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Issue Credential
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    @if($credentials->count() > 0)
                        <div class="space-y-4">
                            @foreach($credentials as $credential)
                                <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-300 transition-colors duration-200">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900">{{ $credential->credential_name ?? $credential->type }}</h4>
                                                <p class="text-sm text-gray-600">{{ $credential->type }} • Verification: {{ $credential->verification_code }}</p>
                                                <p class="text-xs text-gray-500">Issued {{ $credential->created_at->format('M j, Y') }} by {{ $credential->issuedBy->first_name }} {{ $credential->issuedBy->last_name }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            @if($credential->file_path)
                                                <a href="{{ route('institutional-admin.credentials.download', $credential) }}" 
                                                   class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                                    Download
                                                </a>
                                            @endif
                                            <a href="{{ route('institutional-admin.credentials.show', $credential) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                                View
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No credentials issued</h3>
                            <p class="text-gray-500 mb-4">This student hasn't been issued any credentials yet.</p>
                            <a href="{{ route('institutional-admin.credentials.create', ['student_id' => $student->id]) }}" 
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Issue First Credential
                            </a>
                        </div>
                    @endif
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
                    <!-- Edit Student -->
                    <a href="{{ route('institutional-admin.students.edit', $student) }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Edit Details
                    </a>

                    <!-- Reset Password -->
                    <form action="{{ route('institutional-admin.students.reset-password', $student) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                onclick="return confirm('Are you sure you want to reset this student\'s password? They will need to change it on their next login.')">
                            Reset Password
                        </button>
                    </form>

                    <!-- Issue Credential -->
                    <a href="{{ route('institutional-admin.credentials.create', ['student_id' => $student->id]) }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Issue Credential
                    </a>

                    <!-- Delete Student -->
                    <form action="{{ route('institutional-admin.students.destroy', $student) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                onclick="return confirm('Are you sure you want to delete this student? This action cannot be undone and will also delete all their credentials.')">
                            Delete Student
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show success feedback
                const button = event.target.closest('button');
                const originalHTML = button.innerHTML;
                button.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                button.classList.add('text-green-600');
                
                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.classList.remove('text-green-600');
                }, 2000);
            }).catch(function(err) {
                console.error('Failed to copy text: ', err);
                alert('Failed to copy to clipboard');
            });
        }
    </script>
</x-institutional-admin-layout>
