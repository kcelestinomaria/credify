<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Student Information Card -->
            @if(auth()->user()->isStudent())
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Student Information') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Your student details and institution information.') }}
                        </p>
                    </header>

                    <div class="mt-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                                <div class="mt-1 text-sm text-gray-900">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Student ID</label>
                                <div class="mt-1 text-sm text-gray-900">{{ auth()->user()->school_id }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <div class="mt-1 text-sm text-gray-900">{{ auth()->user()->email }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Institution</label>
                                <div class="mt-1 text-sm text-gray-900">{{ auth()->user()->institution->name ?? 'N/A' }}</div>
                            </div>
                        </div>
                        
                        @if(auth()->user()->temporary_password)
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <h3 class="text-sm font-medium text-yellow-800">Temporary Password Active</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>Your temporary password: <span class="font-mono font-semibold">{{ auth()->user()->temporary_password }}</span></p>
                                        <p class="mt-1">Please change your password for security.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Profile Information -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <!-- Password Update -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <!-- Delete Account (only for non-students) -->
            @if(!auth()->user()->isStudent())
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
