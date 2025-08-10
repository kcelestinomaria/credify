<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Credify - Trusted Credentials, Anywhere in the World. Issue and verify tamper-proof credentials powered by W3C Verifiable Credentials.">
        <meta name="keywords" content="verifiable credentials, digital credentials, W3C, tamper-proof, verification, DID">

        <title>Credify - Trusted Credentials, Anywhere in the World</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #1e40af 0%, #3730a3 50%, #581c87 100%);
            }
            .card-shadow {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                transition: all 0.3s ease;
            }
            .card-shadow:hover {
                transform: translateY(-5px);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            }
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            .animate-pulse-slow {
                animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
            .icon-bounce {
                animation: bounce 2s infinite;
            }
            @keyframes bounce {
                0%, 20%, 53%, 80%, 100% { transform: translate3d(0,0,0); }
                40%, 43% { transform: translate3d(0,-15px,0); }
                70% { transform: translate3d(0,-7px,0); }
                90% { transform: translate3d(0,-2px,0); }
            }
            .credential-card {
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
        </style>
    </head>
    <body class="antialiased font-sans" style="font-family: 'Inter', sans-serif;">
        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <h1 class="text-2xl font-bold text-gray-900">Credify</h1>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-semibold transition-colors">Are You an Admin?</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="pt-20 pb-16 gradient-bg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="text-center lg:text-left">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">
                            Trusted Credentials, <span class="text-yellow-400">Anywhere in the World</span>
                        </h1>
                        <p class="mt-6 text-xl text-indigo-100 leading-relaxed">
                            Issue and verify tamper-proof credentials that are instantly recognized by institutions, employers, and governments. Powered by W3C Verifiable Credentials.
                        </p>
                        <div class="mt-8">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-8 py-4 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-gray-50 transition-colors shadow-lg">
                                        Go to Dashboard
                                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-gray-50 transition-colors shadow-lg">
                                        Are You an Admin?
                                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @endauth
                            @endif
                        </div>
                    </div>
                    <div class="relative">
                        <div class="animate-float">
                            <!-- Digital Wallet Illustration -->
                            <div class="relative mx-auto w-80 h-80 bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/20 credential-card">
                                <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent rounded-3xl"></div>
                                <div class="relative z-10">
                                    <!-- Wallet Icon -->
                                    <div class="w-16 h-16 mx-auto mb-6 bg-yellow-400 rounded-2xl flex items-center justify-center icon-bounce">
                                        <svg class="w-8 h-8 text-yellow-800" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M21 7H3a1 1 0 000 2h18a1 1 0 000-2zM3 11h18a1 1 0 000-2H3a1 1 0 000 2zM21 13H3a1 1 0 000 2h18a1 1 0 000-2zM3 17h10a1 1 0 000-2H3a1 1 0 000 2z"/>
                                        </svg>
                                    </div>
                                    
                                    <!-- Credentials Stack -->
                                    <div class="space-y-3">
                                        <div class="bg-white/95 rounded-lg p-3 flex items-center space-x-3 animate-pulse-slow shadow-sm">
                                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-sm font-semibold text-gray-900">University Degree</div>
                                                <div class="text-xs text-green-600 font-medium">✓ Verified</div>
                                            </div>
                                        </div>
                                        
                                        <div class="bg-white/95 rounded-lg p-3 flex items-center space-x-3 shadow-sm">
                                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-sm font-semibold text-gray-900">Professional License</div>
                                                <div class="text-xs text-blue-600 font-medium">✓ Verified</div>
                                            </div>
                                        </div>
                                        
                                        <div class="bg-white/95 rounded-lg p-3 flex items-center space-x-3 shadow-sm">
                                            <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-sm font-semibold text-gray-900">Certification</div>
                                                <div class="text-xs text-purple-600 font-medium">✓ Verified</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Motion Line -->
                        <div class="flex items-center justify-center space-x-6 mt-8 text-white/90">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-2">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium">Institution</div>
                            </div>
                            <div class="flex-1 h-0.5 bg-gradient-to-r from-white/40 to-white/60 relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent animate-pulse"></div>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-2">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium">Credential</div>
                            </div>
                            <div class="flex-1 h-0.5 bg-gradient-to-r from-white/60 to-white/40 relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent animate-pulse"></div>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-2">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium">Employer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Value Proposition Tiles -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Why Credify?</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Built on open standards, designed for trust, engineered for the future of digital credentials.</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl p-8 card-shadow">
                        <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
                                <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Interoperable by Design</h3>
                        <p class="text-gray-600">Credentials follow open W3C standards — trusted by any compliant verifier globally.</p>
                    </div>
                    
                    <div class="bg-white rounded-xl p-8 card-shadow">
                        <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Tamper-Proof & Private</h3>
                        <p class="text-gray-600">Cryptographically signed, verifiable without revealing unnecessary personal data.</p>
                    </div>
                    
                    <div class="bg-white rounded-xl p-8 card-shadow">
                        <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Fast & Seamless Verification</h3>
                        <p class="text-gray-600">One click to confirm authenticity. No phone calls, no paperwork.</p>
                    </div>
                </div>
            </div>
        </section>
        @include('partials.credify-sections')
    </body>
</html>
