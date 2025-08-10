@extends('layouts.super-admin-layout')

@section('title', 'Edit Institution')

@section('content')
    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Institution: {{ $institution->name }}</h2>
            
            <form action="{{ route('institutions.update', $institution) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Institution Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $institution->name) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Current Logo</label>
                    @if($institution->logo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $institution->logo) }}" alt="{{ $institution->name }} logo" class="h-20 w-20 object-cover rounded">
                        </div>
                    @else
                        <p class="mt-1 text-sm text-gray-500">No logo uploaded</p>
                    @endif
                </div>
                
                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700">New Logo (Leave blank to keep current)</label>
                    <input type="file" name="logo" id="logo" accept="image/*"
                           class="mt-1 block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-indigo-50 file:text-indigo-700
                                  hover:file:bg-indigo-100">
                    @error('logo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('institutions.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update Institution
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
