@extends('layouts.super-admin-layout')

@section('title', 'View Institutional Admin')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-900">Institutional Admin Details</h3>
                <div class="flex space-x-2">
                    <a href="{{ route('institutional-admins.edit', $institutionalAdmin) }}" 
                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-yellow-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                        </svg>
                        Edit Admin
                    </a>
                    <a href="{{ route('institutional-admins.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Admin Profile Card -->
                <div class="lg:col-span-2">
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 border border-indigo-200 rounded-xl p-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="h-20 w-20 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                                    <span class="text-2xl font-bold text-white">
                                        {{ substr($institutionalAdmin->first_name, 0, 1) }}{{ substr($institutionalAdmin->last_name, 0, 1) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-gray-900">
                                    {{ $institutionalAdmin->first_name }} {{ $institutionalAdmin->last_name }}
                                </h2>
                                <p class="text-lg text-gray-600">{{ $institutionalAdmin->email }}</p>
                                <div class="mt-2">
                                    @if($institutionalAdmin->must_change_password)
                                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Must Change Password
                                        </span>
                                    @else
                                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Details Section -->
                    <div class="mt-6 bg-white border border-gray-200 rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Admin Information</h3>
                        </div>
                        <div class="px-6 py-4">
                            <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">First Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $institutionalAdmin->first_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Last Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $institutionalAdmin->last_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $institutionalAdmin->email }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Role</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Institutional Admin
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Institution</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $institutionalAdmin->institution->name ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Account Created</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $institutionalAdmin->created_at->format('M d, Y \a\t g:i A') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                        </div>
                        <div class="px-6 py-4 space-y-4">
                            <!-- Edit Admin -->
                            <a href="{{ route('institutional-admins.edit', $institutionalAdmin) }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Edit Details
                            </a>

                            <!-- Reset Password -->
                            <form action="{{ route('institutional-admins.reset-password', $institutionalAdmin) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        onclick="return confirm('Are you sure you want to reset this admin\'s password? They will need to change it on their next login.')">
                                    Reset Password
                                </button>
                            </form>

                            <!-- Delete Admin -->
                            <form action="{{ route('institutional-admins.destroy', $institutionalAdmin) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        onclick="return confirm('Are you sure you want to delete this admin? This action cannot be undone.')">
                                    Delete Admin
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Institution Card -->
                    @if($institutionalAdmin->institution)
                    <div class="mt-6 bg-white border border-gray-200 rounded-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Institution</h3>
                        </div>
                        <div class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                @if($institutionalAdmin->institution->logo)
                                    <img src="{{ asset('storage/' . $institutionalAdmin->institution->logo) }}" 
                                         alt="{{ $institutionalAdmin->institution->name }}" 
                                         class="h-12 w-12 rounded-lg object-cover">
                                @else
                                    <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                        <svg class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $institutionalAdmin->institution->name }}</p>
                                    <a href="{{ route('institutions.show', $institutionalAdmin->institution) }}" 
                                       class="text-sm text-indigo-600 hover:text-indigo-900">View Institution →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
