<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Verify credential - {{ $credential->credential_name }}">
    
    <title>Verify Credential - {{ $credential->credential_name }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .verification-gradient {
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 25%, #16213e 50%, #0f3460 75%, #533483 100%);
        }
        .verified-badge {
            animation: verifiedPulse 2s ease-in-out infinite;
        }
        @keyframes verifiedPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .credential-card {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="antialiased font-sans" style="font-family: 'Inter', sans-serif;">
    <!-- Header -->
    <nav class="bg-white/95 backdrop-blur-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">CredVerify</h1>
                </div>
                <div class="text-sm text-gray-600">
                    Credential Verification
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen verification-gradient py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Verification Status -->
            <div class="text-center mb-8">
                <div class="verified-badge inline-flex items-center justify-center w-20 h-20 bg-green-500 rounded-full mb-4">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">Credential Verified</h1>
                <p class="text-xl text-gray-300">This credential is authentic and verified</p>
            </div>

            <!-- Credential Details Card -->
            <div class="credential-card rounded-2xl p-8 mb-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Left Column - Credential Info -->
                    <div>
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    @if($credential->type === 'Degree') bg-blue-100 text-blue-800
                                    @elseif($credential->type === 'Certificate') bg-green-100 text-green-800
                                    @else bg-purple-100 text-purple-800 @endif">
                                    {{ $credential->type }}
                                </span>
                            </div>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $credential->credential_name }}</h2>
                        
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Student Name</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ $credential->student_first_name }} {{ $credential->student_last_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Student ID</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ $credential->student_school_id }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Issue Date</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ $credential->created_at->format('F d, Y') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Right Column - Institution Info -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Issuing Institution</h3>
                        
                        <div class="bg-gray-50 rounded-xl p-6 mb-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900">{{ $credential->institution->name }}</h4>
                            </div>
                            
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Issued By</dt>
                                    <dd class="text-sm text-gray-900">{{ $credential->issuedBy->first_name }} {{ $credential->issuedBy->last_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Verification Code</dt>
                                    <dd class="text-sm font-mono font-semibold text-gray-900 bg-white px-3 py-2 rounded border">{{ $credential->verification_code }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Verification Badge -->
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-green-800">Verified Credential</p>
                                    <p class="text-sm text-green-700">This credential is authentic and has been verified by CredVerify</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Features -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="credential-card rounded-xl p-6 text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Cryptographically Secured</h3>
                    <p class="text-sm text-gray-600">Protected by advanced encryption and digital signatures</p>
                </div>
                
                <div class="credential-card rounded-xl p-6 text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">W3C Compliant</h3>
                    <p class="text-sm text-gray-600">Follows international verifiable credentials standards</p>
                </div>
                
                <div class="credential-card rounded-xl p-6 text-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Blockchain Anchored</h3>
                    <p class="text-sm text-gray-600">Immutably recorded on distributed ledger</p>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-gray-300 mb-4">Verified on {{ now()->format('F d, Y \a\t g:i A') }}</p>
                <div class="flex justify-center items-center space-x-2 text-gray-400">
                    <span>Powered by</span>
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-md flex items-center justify-center mr-2">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="font-semibold">CredVerify</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
