<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="CredVerify - Verify Anything. Anywhere. Instantly. W3C Verifiable Credentials powered by blockchain interoperability.">
        <meta name="keywords" content="verifiable credentials, blockchain, W3C, verification, interoperability, digital credentials">

        <title>CredVerify - Verify Anything. Anywhere. Instantly.</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .hero-gradient {
                background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 25%, #16213e 50%, #0f3460 75%, #533483 100%);
                position: relative;
                overflow: hidden;
            }
            .hero-gradient::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: radial-gradient(circle at 30% 20%, rgba(99, 102, 241, 0.3) 0%, transparent 50%),
                           radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.3) 0%, transparent 50%),
                           radial-gradient(circle at 40% 40%, rgba(59, 130, 246, 0.2) 0%, transparent 50%);
                animation: gradientShift 8s ease-in-out infinite;
            }
            @keyframes gradientShift {
                0%, 100% { opacity: 0.3; }
                50% { opacity: 0.6; }
            }
            .card-hover {
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            }
            .card-hover::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
                transition: left 0.5s;
            }
            .card-hover:hover::before {
                left: 100%;
            }
            .card-hover:hover {
                transform: translateY(-12px) scale(1.03);
                box-shadow: 0 40px 80px -12px rgba(0, 0, 0, 0.3);
            }
            .credential-flow {
                animation: credentialFlow 4s ease-in-out infinite;
            }
            @keyframes credentialFlow {
                0%, 100% { transform: translateX(0) scale(1); opacity: 1; }
                25% { transform: translateX(10px) scale(1.02); opacity: 0.9; }
                50% { transform: translateX(20px) scale(1.05); opacity: 0.8; }
                75% { transform: translateX(10px) scale(1.02); opacity: 0.9; }
            }
            .blockchain-pulse {
                animation: blockchainPulse 3s ease-in-out infinite;
                position: relative;
            }
            .blockchain-pulse::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                border-radius: inherit;
                background: inherit;
                opacity: 0.3;
                animation: ripple 3s ease-in-out infinite;
            }
            @keyframes blockchainPulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.08); }
            }
            @keyframes ripple {
                0% { transform: scale(1); opacity: 0.3; }
                50% { transform: scale(1.2); opacity: 0; }
                100% { transform: scale(1); opacity: 0.3; }
            }
            .logo-glow {
                text-shadow: 0 0 30px rgba(99, 102, 241, 0.6);
                animation: logoGlow 3s ease-in-out infinite;
            }
            @keyframes logoGlow {
                0%, 100% { text-shadow: 0 0 30px rgba(99, 102, 241, 0.6); }
                50% { text-shadow: 0 0 40px rgba(99, 102, 241, 0.8), 0 0 60px rgba(139, 92, 246, 0.4); }
            }
            .gradient-text {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
                background-size: 200% 200%;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                animation: gradientMove 4s ease-in-out infinite;
            }
            @keyframes gradientMove {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }
            .glass-card {
                backdrop-filter: blur(20px);
                background: rgba(255, 255, 255, 0.12);
                border: 1px solid rgba(255, 255, 255, 0.25);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            }
            .step-connector {
                background: linear-gradient(90deg, transparent 0%, #667eea 20%, #764ba2 50%, #f093fb 80%, transparent 100%);
                background-size: 200% 100%;
                height: 3px;
                animation: flowLine 4s ease-in-out infinite;
                border-radius: 2px;
            }
            @keyframes flowLine {
                0%, 100% { 
                    opacity: 0.4; 
                    background-position: 0% 50%;
                }
                50% { 
                    opacity: 1; 
                    background-position: 100% 50%;
                }
            }
            .floating-element {
                animation: float 6s ease-in-out infinite;
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            .scale-on-hover {
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .scale-on-hover:hover {
                transform: scale(1.05);
            }
            .text-shimmer {
                background: linear-gradient(45deg, #667eea, #764ba2, #f093fb, #667eea);
                background-size: 400% 400%;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                animation: shimmer 3s ease-in-out infinite;
            }
            @keyframes shimmer {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }
            .nav-blur {
                backdrop-filter: blur(20px);
                background: rgba(255, 255, 255, 0.95);
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            }
            .button-glow {
                position: relative;
                overflow: hidden;
            }
            .button-glow::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: left 0.6s;
            }
            .button-glow:hover::before {
                left: 100%;
            }
            .pricing-glow {
                position: relative;
            }
            .pricing-glow::before {
                content: '';
                position: absolute;
                top: -2px;
                left: -2px;
                right: -2px;
                bottom: -2px;
                background: linear-gradient(45deg, #fbbf24, #f59e0b, #d97706, #fbbf24);
                background-size: 400% 400%;
                border-radius: inherit;
                z-index: -1;
                animation: borderGlow 3s ease-in-out infinite;
            }
            @keyframes borderGlow {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }
        </style>
    </head>
    <body class="antialiased font-sans" style="font-family: 'Inter', sans-serif;">
        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 nav-blur">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h1 class="text-2xl font-bold text-gray-900 logo-glow">CredVerify</h1>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 py-2 rounded-lg text-sm font-semibold transition-all duration-300 shadow-lg hover:shadow-xl button-glow">Get Verified</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="min-h-screen hero-gradient relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, #667eea 2px, transparent 2px), radial-gradient(circle at 75% 75%, #764ba2 2px, transparent 2px); background-size: 50px 50px;"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-16">
                <div class="text-center">
                    <!-- Main Headline -->
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white leading-tight mb-8">
                        <span class="block">Verify Anything.</span>
                        <span class="block">Anywhere.</span>
                        <span class="block gradient-text">Instantly.</span>
                    </h1>
                    
                    <!-- Subtext -->
                    <p class="text-xl md:text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed mb-12">
                        W3C Verifiable Credentials, powered by blockchain interoperability.
                    </p>
                    
                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-8 py-4 bg-white text-gray-900 font-bold rounded-xl hover:bg-gray-100 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105 button-glow">
                                    Go to Dashboard
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 bg-white text-gray-900 font-bold rounded-xl hover:bg-gray-100 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105 button-glow">
                                    Get Verified
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-xl hover:bg-white hover:text-gray-900 transition-all duration-300 button-glow">
                                    Issue Credentials
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </a>
                            @endauth
                        @endif
                    </div>
                    <!-- Credential Flow Animation -->
                    <div class="relative max-w-5xl mx-auto">
                        <div class="glass-card rounded-3xl p-8 credential-flow floating-element">
                            <div class="flex items-center justify-center space-x-8">
                                <!-- Issue -->
                                <div class="text-center">
                                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mb-4 blockchain-pulse">
                                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-white font-bold text-lg">Issue</h3>
                                    <p class="text-gray-300 text-sm">Create credential</p>
                                </div>
                                
                                <!-- Arrow -->
                                <div class="step-connector w-16"></div>
                                
                                <!-- Verify -->
                                <div class="text-center">
                                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-700 rounded-2xl flex items-center justify-center mb-4 blockchain-pulse" style="animation-delay: 0.5s">
                                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-white font-bold text-lg">Verify</h3>
                                    <p class="text-gray-300 text-sm">Instant validation</p>
                                </div>
                                
                                <!-- Arrow -->
                                <div class="step-connector w-16" style="animation-delay: 1s"></div>
                                
                                <!-- Anchor -->
                                <div class="text-center">
                                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center mb-4 blockchain-pulse" style="animation-delay: 1s">
                                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-white font-bold text-lg">Anchor</h3>
                                    <p class="text-gray-300 text-sm">Blockchain secured</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Social Proof -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-8">Trusted by leading institutions worldwide</p>
                    <div class="flex flex-wrap justify-center items-center gap-8 opacity-60">
                        <!-- W3C Logo -->
                        <div class="flex items-center space-x-2">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </div>
                            <span class="font-semibold text-gray-700">W3C Compliant</span>
                        </div>
                        
                        <!-- ISO27001 -->
                        <div class="flex items-center space-x-2">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z"/>
                                </svg>
                            </div>
                            <span class="font-semibold text-gray-700">ISO27001</span>
                        </div>
                        
                        <!-- GDPR -->
                        <div class="flex items-center space-x-2">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M11,7H13V9H11V7M11,11H13V17H11V11Z"/>
                                </svg>
                            </div>
                            <span class="font-semibold text-gray-700">GDPR Ready</span>
                        </div>
                        
                        <!-- Blockchain -->
                        <div class="flex items-center space-x-2">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M3,3H9V9H3V3M5,5V7H7V5H5M11,3H17V9H11V3M13,5V7H15V5H13M19,3H21V9H19V3M3,11H9V17H3V11M5,13V15H7V13H5M11,11H17V17H11V11M13,13V15H15V13H13M19,11H21V17H19V11M3,19H9V21H3V19M11,19H17V21H11V19M19,19H21V21H19V19Z"/>
                                </svg>
                            </div>
                            <span class="font-semibold text-gray-700">Multi-Chain</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section class="py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">How It Works</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Three simple steps to revolutionize credential verification</p>
                </div>
                
                <div class="relative">
                    <div class="grid lg:grid-cols-3 gap-12 relative">
                        <!-- Step 1: Issue -->
                        <div class="text-center relative">
                            <div class="relative inline-flex items-center justify-center w-32 h-32 bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl mb-8 shadow-2xl card-hover">
                                <div class="absolute inset-0 bg-blue-600 rounded-3xl animate-ping opacity-20"></div>
                                <div class="relative w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-inner">
                                    <span class="text-blue-600 font-black text-2xl">1</span>
                                </div>
                            </div>
                            <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 card-hover">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">Issue</h3>
                                <p class="text-gray-600 leading-relaxed">Create tamper-proof credentials with cryptographic signatures and blockchain anchoring.</p>
                            </div>
                        </div>
                        
                        <!-- Step 2: Verify -->
                        <div class="text-center relative">
                            <div class="relative inline-flex items-center justify-center w-32 h-32 bg-gradient-to-br from-green-500 to-green-700 rounded-3xl mb-8 shadow-2xl card-hover">
                                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-inner">
                                    <span class="text-green-600 font-black text-2xl">2</span>
                                </div>
                            </div>
                            <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 card-hover">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">Verify</h3>
                                <p class="text-gray-600 leading-relaxed">Instant validation across any platform with W3C standard compliance and global interoperability.</p>
                            </div>
                        </div>
                        
                        <!-- Step 3: Anchor -->
                        <div class="text-center relative">
                            <div class="relative inline-flex items-center justify-center w-32 h-32 bg-gradient-to-br from-purple-500 to-purple-700 rounded-3xl mb-8 shadow-2xl card-hover">
                                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-inner">
                                    <span class="text-purple-600 font-black text-2xl">3</span>
                                </div>
                            </div>
                            <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 card-hover">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">Anchor</h3>
                                <p class="text-gray-600 leading-relaxed">Secure credentials on multiple blockchain networks for ultimate trust and permanence.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Security & Interoperability -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">Security & Interoperability</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Multi-chain compatibility with enterprise-grade security</p>
                </div>
                
                <!-- Multi-chain Animation -->
                <div class="relative mb-16">
                    <div class="flex justify-center items-center space-x-8 mb-12">
                        <!-- Ethereum -->
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center shadow-xl blockchain-pulse">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.944,17.97L4.58,13.62L11.943,24L19.31,13.62L11.944,17.97ZM12.056,0L4.69,12.22L12.056,16.57L19.42,12.22L12.056,0Z"/>
                            </svg>
                        </div>
                        
                        <!-- Connecting Lines -->
                        <div class="step-connector w-24"></div>
                        
                        <!-- Polygon -->
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center shadow-xl blockchain-pulse" style="animation-delay: 0.5s">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12,2L13.09,8.26L20,9L13.09,9.74L12,16L10.91,9.74L4,9L10.91,8.26L12,2Z"/>
                            </svg>
                        </div>
                        
                        <div class="step-connector w-24" style="animation-delay: 0.5s"></div>
                        
                        <!-- Solana -->
                        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-700 rounded-2xl flex items-center justify-center shadow-xl blockchain-pulse" style="animation-delay: 1s">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3,12L12,3L21,12L12,21L3,12Z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <p class="text-lg text-gray-600 font-medium">Credentials move seamlessly across blockchain networks</p>
                    </div>
                </div>
                
                <!-- Security Features Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center bg-gray-50 rounded-2xl p-8 card-hover">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3">W3C Standards</h3>
                        <p class="text-gray-600 text-sm">Built on open verifiable credentials specification</p>
                    </div>
                    
                    <div class="text-center bg-gray-50 rounded-2xl p-8 card-hover">
                        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Zero-Knowledge</h3>
                        <p class="text-gray-600 text-sm">Prove credentials without revealing sensitive data</p>
                    </div>
                    
                    <div class="text-center bg-gray-50 rounded-2xl p-8 card-hover">
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Cryptographic</h3>
                        <p class="text-gray-600 text-sm">Military-grade encryption and digital signatures</p>
                    </div>
                    
                    <div class="text-center bg-gray-50 rounded-2xl p-8 card-hover">
                        <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Multi-Chain</h3>
                        <p class="text-gray-600 text-sm">Cross-chain compatibility and portability</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-24 bg-gradient-to-br from-gray-50 to-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">Enterprise-Grade Features</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Built for scale, security, and seamless integration</p>
                </div>
                
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- API-First -->
                    <div class="group bg-white rounded-3xl p-8 shadow-xl border border-gray-100 card-hover relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">API-First Architecture</h3>
                            <p class="text-gray-600 leading-relaxed mb-6">RESTful APIs with comprehensive documentation. Integrate credential verification into any system in minutes.</p>
                            <div class="flex items-center text-blue-600 font-semibold">
                                <span>Explore API</span>
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Real-time Verification -->
                    <div class="group bg-white rounded-3xl p-8 shadow-xl border border-gray-100 card-hover relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-emerald-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-700 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Real-time Verification</h3>
                            <p class="text-gray-600 leading-relaxed mb-6">Sub-second verification with global CDN. 99.9% uptime SLA with enterprise support.</p>
                            <div class="flex items-center text-green-600 font-semibold">
                                <span>View Performance</span>
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Analytics Dashboard -->
                    <div class="group bg-white rounded-3xl p-8 shadow-xl border border-gray-100 card-hover relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-violet-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Analytics Dashboard</h3>
                            <p class="text-gray-600 leading-relaxed mb-6">Real-time insights, verification metrics, and compliance reporting with exportable data.</p>
                            <div class="flex items-center text-purple-600 font-semibold">
                                <span>View Dashboard</span>
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials/Case Studies -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">Trusted by Industry Leaders</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Organizations worldwide rely on CredVerify for mission-critical verification</p>
                </div>
                
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- University Case Study -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-8 border border-blue-100 card-hover">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Global University</h4>
                                <p class="text-sm text-gray-600">Higher Education</p>
                            </div>
                        </div>
                        <blockquote class="text-gray-700 leading-relaxed mb-6">
                            "CredVerify reduced our diploma verification time from 2 weeks to 2 seconds. Our graduates now have instant, globally-recognized proof of their achievements."
                        </blockquote>
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                <span class="font-semibold text-blue-600">98% faster</span> verification
                            </div>
                            <div class="text-sm text-gray-600">
                                <span class="font-semibold text-blue-600">50K+</span> credentials issued
                            </div>
                        </div>
                    </div>
                    
                    <!-- Healthcare Case Study -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl p-8 border border-green-100 card-hover">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h4a1 1 0 010 2H6.414l2.293 2.293a1 1 0 01-1.414 1.414L5 6.414V8a1 1 0 01-2 0V4zm9 1a1 1 0 010-2h4a1 1 0 011 1v4a1 1 0 01-2 0V6.414l-2.293 2.293a1 1 0 11-1.414-1.414L13.586 5H12zm-9 7a1 1 0 012 0v1.586l2.293-2.293a1 1 0 111.414 1.414L6.414 15H8a1 1 0 010 2H4a1 1 0 01-1-1v-4zm13-1a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 010-2h1.586l-2.293-2.293a1 1 0 111.414-1.414L15 13.586V12a1 1 0 011-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Healthcare Network</h4>
                                <p class="text-sm text-gray-600">Medical Licensing</p>
                            </div>
                        </div>
                        <blockquote class="text-gray-700 leading-relaxed mb-6">
                            "Patient safety depends on verified credentials. CredVerify's real-time verification ensures only qualified professionals provide care."
                        </blockquote>
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                <span class="font-semibold text-green-600">100%</span> compliance rate
                            </div>
                            <div class="text-sm text-gray-600">
                                <span class="font-semibold text-green-600">25K+</span> professionals verified
                            </div>
                        </div>
                    </div>
                    
                    <!-- Government Case Study -->
                    <div class="bg-gradient-to-br from-purple-50 to-violet-50 rounded-3xl p-8 border border-purple-100 card-hover">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Government Agency</h4>
                                <p class="text-sm text-gray-600">Professional Licensing</p>
                            </div>
                        </div>
                        <blockquote class="text-gray-700 leading-relaxed mb-6">
                            "CredVerify's blockchain-anchored credentials eliminated fraud and reduced administrative overhead by 80% across all departments."
                        </blockquote>
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                <span class="font-semibold text-purple-600">Zero</span> fraud incidents
                            </div>
                            <div class="text-sm text-gray-600">
                                <span class="font-semibold text-purple-600">80%</span> cost reduction
                            </div>
                        </div>
                </div>
            </div>
        </section>

        @include('partials.credify-sections')
    </body>
</html>
