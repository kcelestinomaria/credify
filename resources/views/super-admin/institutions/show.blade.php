@extends('layouts.super-admin-layout')

@section('title', $institution->name)

@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Institution Details
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Detailed information about {{ $institution->name }}
                </p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('institutions.edit', $institution) }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Edit
                </a>
                <form action="{{ route('institutions.destroy', $institution) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            onclick="return confirm('Are you sure you want to delete this institution?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Logo</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if($institution->logo)
                            <img src="{{ asset('storage/' . $institution->logo) }}" alt="{{ $institution->name }} logo" class="h-20 w-20 object-cover rounded">
                        @else
                            <span class="text-gray-400">No logo uploaded</span>
                        @endif
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Institution Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $institution->name }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Created</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $institution->created_at->format('F j, Y') }} ({{ $institution->created_at->diffForHumans() }})
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $institution->updated_at->format('F j, Y') }} ({{ $institution->updated_at->diffForHumans() }})
                    </dd>
                </div>
            </dl>
        </div>
        <div class="px-4 py-4 bg-gray-50 sm:px-6">
            <a href="{{ route('institutions.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                &larr; Back to Institutions
            </a>
        </div>
    </div>
@endsection
