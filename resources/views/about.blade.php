<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About - CredVerify</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="ml-3 text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">CredVerify</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/search" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Verify Credentials</a>
                    <a href="/dashboard" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">Dashboard</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-indigo-50 via-white to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-6">
                    About CredVerify
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    The next-generation credential management and verification platform built on W3C standards for secure, interoperable, and verifiable digital credentials.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
                <p class="text-lg text-gray-600 mb-6">
                    CredVerify revolutionizes how educational institutions issue, manage, and verify digital credentials. We provide a secure, standards-compliant platform that ensures credential authenticity while maintaining privacy and interoperability.
                </p>
                <p class="text-lg text-gray-600">
                    Built on W3C Verifiable Credentials Data Model 2.0, our platform enables seamless credential verification across institutions, employers, and verification services worldwide.
                </p>
            </div>
            <div class="bg-gradient-to-br from-indigo-100 to-purple-100 rounded-2xl p-8">
                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-600 mb-2">100%</div>
                        <div class="text-sm text-gray-600">W3C Compliant</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-purple-600 mb-2">256-bit</div>
                        <div class="text-sm text-gray-600">Encryption</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-600 mb-2">24/7</div>
                        <div class="text-sm text-gray-600">Verification</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-purple-600 mb-2">Global</div>
                        <div class="text-sm text-gray-600">Standards</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="mb-20">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Platform Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Secure Verification</h3>
                    <p class="text-gray-600">Cryptographic hash verification ensures credential authenticity and prevents tampering.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Global Standards</h3>
                    <p class="text-gray-600">Built on W3C Verifiable Credentials Data Model 2.0 for worldwide interoperability.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-4-4m4 4l4-4m-6 4H6a2 2 0 01-2-2V6a2 2 0 012-2h6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Easy Downloads</h3>
                    <p class="text-gray-600">Download W3C-compliant JSON-LD credentials for use across verification platforms.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">QR Code Sharing</h3>
                    <p class="text-gray-600">Generate QR codes for instant credential sharing and verification.</p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Public Verification</h3>
                    <p class="text-gray-600">Anyone can verify credentials using verification codes without requiring accounts.</p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Role Management</h3>
                    <p class="text-gray-600">Comprehensive role-based access control for institutions, admins, and students.</p>
                </div>
            </div>
        </div>

        <!-- Technology Stack -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-20">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-8">Built with Modern Technology</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-red-600 font-bold text-lg">Laravel</span>
                    </div>
                    <div class="text-sm text-gray-600">PHP Framework</div>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-purple-600 font-bold text-lg">Livewire</span>
                    </div>
                    <div class="text-sm text-gray-600">Dynamic Components</div>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-blue-600 font-bold text-lg">Tailwind</span>
                    </div>
                    <div class="text-sm text-gray-600">CSS Framework</div>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-600 font-bold text-lg">W3C</span>
                    </div>
                    <div class="text-sm text-gray-600">Standards Compliant</div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Get Started Today</h2>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Ready to modernize your credential management? Contact us to learn how CredVerify can transform your institution's digital credential ecosystem.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/search" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Verify a Credential
                </a>
                <a href="/dashboard" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Access Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.credify-sections')
</body>
</html>
