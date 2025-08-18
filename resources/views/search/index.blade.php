<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Search and verify credentials - CredVerify">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Credential Search - CredVerify</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .search-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .search-card {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
    </style>
</head>
<body class="antialiased font-sans" style="font-family: 'Inter', sans-serif;">
    <!-- Header -->
    <nav class="bg-white/95 backdrop-blur-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center hover:opacity-80 transition-opacity">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900">CredVerify</h1>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-sm text-gray-600">
                        Credential Search & Verification
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="/" class="text-sm text-gray-600 hover:text-indigo-600 transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Home
                        </a>
                        <a href="/login" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen search-gradient py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-full mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-white mb-4">Search Credentials</h1>
                <p class="text-xl text-gray-200 max-w-2xl mx-auto">Enter a verification code to search for and verify any credential in our system</p>
            </div>

            <!-- Search Form -->
            <div class="search-card rounded-2xl p-8 mb-8">
                <form id="searchForm" class="space-y-6">
                    <div>
                        <label for="verification_code" class="block text-sm font-medium text-gray-700 mb-2">
                            Verification Code
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="verification_code" 
                                name="verification_code" 
                                placeholder="Enter verification code (e.g., CRED-2024-ABC123)"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg"
                                required
                            >
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Enter the exact verification code as it appears on the credential</p>
                    </div>

                    <button 
                        type="submit" 
                        id="searchButton"
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        <span id="searchButtonText">Search Credential</span>
                        <span id="searchButtonLoading" class="hidden">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Searching...
                        </span>
                    </button>
                </form>
            </div>

            <!-- Search Results -->
            <div id="searchResults" class="hidden">
                <!-- Results will be populated here -->
            </div>

            <!-- How it Works -->
            <div class="search-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">How It Works</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">1. Enter Code</h3>
                        <p class="text-sm text-gray-600">Input the verification code from any credential document</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">2. Search Database</h3>
                        <p class="text-sm text-gray-600">Our system searches through all registered credentials</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">3. View Results</h3>
                        <p class="text-sm text-gray-600">Get instant verification and credential details</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const verificationCode = document.getElementById('verification_code').value.trim();
            const searchButton = document.getElementById('searchButton');
            const searchButtonText = document.getElementById('searchButtonText');
            const searchButtonLoading = document.getElementById('searchButtonLoading');
            const resultsContainer = document.getElementById('searchResults');
            
            if (!verificationCode) {
                alert('Please enter a verification code');
                return;
            }
            
            // Show loading state
            searchButton.disabled = true;
            searchButtonText.classList.add('hidden');
            searchButtonLoading.classList.remove('hidden');
            resultsContainer.classList.add('hidden');
            
            try {
                const response = await fetch('/search', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        verification_code: verificationCode
                    })
                });
                
                const data = await response.json();
                
                if (data.found) {
                    displayCredentialFound(data.credential);
                } else {
                    displayCredentialNotFound(data.message);
                }
                
            } catch (error) {
                console.error('Search error:', error);
                displayError('An error occurred while searching. Please try again.');
            } finally {
                // Reset button state
                searchButton.disabled = false;
                searchButtonText.classList.remove('hidden');
                searchButtonLoading.classList.add('hidden');
            }
        });
        
        function displayCredentialFound(credential) {
            const resultsContainer = document.getElementById('searchResults');
            resultsContainer.innerHTML = `
                <div class="search-card rounded-2xl p-8 border-l-4 border-green-500">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-xl font-bold text-green-800 mb-2">✓ Credential Found & Verified</h3>
                            <p class="text-green-700 mb-6">This credential exists in our system and is authentic.</p>
                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-3">Credential Details</h4>
                                    <dl class="space-y-2">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Name</dt>
                                            <dd class="text-sm text-gray-900">${credential.credential_name}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Type</dt>
                                            <dd class="text-sm text-gray-900">${credential.type}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Issue Date</dt>
                                            <dd class="text-sm text-gray-900">${credential.issue_date}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Verification Code</dt>
                                            <dd class="text-sm font-mono font-semibold text-gray-900">${credential.verification_code}</dd>
                                        </div>
                                    </dl>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-3">Student & Institution</h4>
                                    <dl class="space-y-2">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Student Name</dt>
                                            <dd class="text-sm text-gray-900">${credential.student.name}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Student ID</dt>
                                            <dd class="text-sm text-gray-900">${credential.student.student_id}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Institution</dt>
                                            <dd class="text-sm text-gray-900">${credential.institution.name}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Issued By</dt>
                                            <dd class="text-sm text-gray-900">${credential.issued_by.name}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-700">Credential Hash:</span>
                                    <button onclick="copyCredentialHash('${credential.credential_hash || 'N/A'}')" class="text-xs text-blue-600 hover:text-blue-800">Copy</button>
                                </div>
                                <code class="text-xs text-gray-600 break-all">${credential.credential_hash || 'Not available'}</code>
                            </div>
                            
                            <div class="mt-6 space-y-3">
                                <div class="flex space-x-3">
                                    <a href="${credential.verify_url}" target="_blank" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors text-center">
                                        View Full Verification
                                    </a>
                                    <button onclick="searchAnother()" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                        Search Another
                                    </button>
                                </div>
                                <a href="/credential/${credential.id}/download" class="block w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors text-center">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-4-4m4 4l4-4m-6 4H6a2 2 0 01-2-2V6a2 2 0 012-2h6"></path>
                                    </svg>
                                    Download W3C Credential JSON-LD
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            resultsContainer.classList.remove('hidden');
        }
        
        function displayCredentialNotFound(message) {
            const resultsContainer = document.getElementById('searchResults');
            resultsContainer.innerHTML = `
                <div class="search-card rounded-2xl p-8 border-l-4 border-red-500">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-xl font-bold text-red-800 mb-2">Credential Not Found</h3>
                            <p class="text-red-700 mb-4">${message}</p>
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                                <h4 class="font-medium text-red-800 mb-2">Possible reasons:</h4>
                                <ul class="text-sm text-red-700 space-y-1">
                                    <li>• The verification code was entered incorrectly</li>
                                    <li>• The credential is not registered in our system</li>
                                    <li>• The credential may have been revoked or expired</li>
                                </ul>
                            </div>
                            <button onclick="searchAnother()" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Try Another Code
                            </button>
                        </div>
                    </div>
                </div>
            `;
            resultsContainer.classList.remove('hidden');
        }
        
        function displayError(message) {
            const resultsContainer = document.getElementById('searchResults');
            resultsContainer.innerHTML = `
                <div class="search-card rounded-2xl p-8 border-l-4 border-yellow-500">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-xl font-bold text-yellow-800 mb-2">Search Error</h3>
                            <p class="text-yellow-700 mb-4">${message}</p>
                            <button onclick="searchAnother()" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Try Again
                            </button>
                        </div>
                    </div>
                </div>
            `;
            resultsContainer.classList.remove('hidden');
        }
        
        function searchAnother() {
            document.getElementById('verification_code').value = '';
            document.getElementById('searchResults').classList.add('hidden');
            document.getElementById('verification_code').focus();
        }

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
</body>
</html>
