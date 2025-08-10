<x-institutional-admin-layout>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Issue New Credential
                </h1>
                <p class="text-gray-600 mt-2">Create and issue a new credential to a student</p>
            </div>
            <a href="{{ route('institutional-admin.credentials.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Back to Credentials
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-red-600 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h4 class="text-red-800 font-medium mb-2">Please correct the following errors:</h4>
                    <ul class="text-red-700 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Create Form -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900">Credential Information</h3>
        </div>
        <div class="p-6">
            <form action="{{ route('institutional-admin.credentials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Student Selection -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Select Student <span class="text-red-500">*</span>
                    </label>
                    <select id="user_id" 
                            name="user_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 @error('user_id') border-red-500 @enderror"
                            required>
                        <option value="">Choose a student...</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('user_id', $selectedStudent?->id) == $student->id ? 'selected' : '' }}>
                                {{ $student->first_name }} {{ $student->last_name }} ({{ $student->school_id }}) - {{ $student->email }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Credential Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            Credential Type <span class="text-red-500">*</span>
                        </label>
                        <select id="type" 
                                name="type" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 @error('type') border-red-500 @enderror"
                                required>
                            <option value="">Select type...</option>
                            <option value="Degree" {{ old('type') == 'Degree' ? 'selected' : '' }}>Degree</option>
                            <option value="Certificate" {{ old('type') == 'Certificate' ? 'selected' : '' }}>Certificate</option>
                            <option value="Diploma" {{ old('type') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Credential Name -->
                    <div>
                        <label for="credential_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Credential Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="credential_name" 
                               name="credential_name" 
                               value="{{ old('credential_name') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 @error('credential_name') border-red-500 @enderror"
                               placeholder="e.g., Bachelor of Science in Computer Science"
                               required>
                        @error('credential_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Student Information (Auto-filled) -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-3">Student Information (Auto-filled from selected student)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="student_first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" 
                                   id="student_first_name" 
                                   name="student_first_name" 
                                   value="{{ old('student_first_name') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 @error('student_first_name') border-red-500 @enderror"
                                   placeholder="Will auto-fill when student is selected"
                                   required>
                            @error('student_first_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="student_last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" 
                                   id="student_last_name" 
                                   name="student_last_name" 
                                   value="{{ old('student_last_name') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 @error('student_last_name') border-red-500 @enderror"
                                   placeholder="Will auto-fill when student is selected"
                                   required>
                            @error('student_last_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="student_school_id" class="block text-sm font-medium text-gray-700 mb-1">School ID</label>
                            <input type="text" 
                                   id="student_school_id" 
                                   name="student_school_id" 
                                   value="{{ old('student_school_id') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 font-mono @error('student_school_id') border-red-500 @enderror"
                                   placeholder="Will auto-fill when student is selected"
                                   required>
                            @error('student_school_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- File Upload -->
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        Credential Document (Optional)
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400 transition-colors duration-200">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="file" name="file" type="file" class="sr-only" accept=".pdf,.doc,.docx">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PDF, DOC, DOCX up to 10MB</p>
                        </div>
                    </div>
                    @error('file')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('institutional-admin.credentials.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Issue Credential
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Auto-fill JavaScript -->
    <script>
        document.getElementById('user_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                // Extract student info from the option text
                const optionText = selectedOption.text;
                const matches = optionText.match(/^(.+?) (.+?) \((.+?)\) - (.+)$/);
                
                if (matches) {
                    document.getElementById('student_first_name').value = matches[1];
                    document.getElementById('student_last_name').value = matches[2];
                    document.getElementById('student_school_id').value = matches[3];
                }
            } else {
                // Clear the fields if no student is selected
                document.getElementById('student_first_name').value = '';
                document.getElementById('student_last_name').value = '';
                document.getElementById('student_school_id').value = '';
            }
        });

        // Auto-fill on page load if a student is pre-selected
        window.addEventListener('load', function() {
            const userSelect = document.getElementById('user_id');
            if (userSelect.value) {
                userSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-institutional-admin-layout>
