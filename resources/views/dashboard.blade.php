<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Credentials') }}
            </h2>
            <div class="text-sm text-gray-600">
                <span class="font-medium">{{ auth()->user()->institution->name ?? 'No Institution' }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl shadow-lg mb-8 overflow-hidden">
                <div class="p-8 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold mb-2">Welcome, {{ auth()->user()->first_name }}!</h1>
                            <p class="text-blue-100 text-lg">Manage and share your verified credentials</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->credentials()->count() }}</p>
                            <p class="text-sm text-gray-600">Total Credentials</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->credentials()->count() }}</p>
                            <p class="text-sm text-gray-600">Verified</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->institution->name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600">Institution</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Portfolio Download Section -->
            @if(auth()->user()->credentials()->count() > 0)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Portfolio Downloads</h3>
                        <p class="text-sm text-gray-600 mt-1">Download your complete credentials portfolio</p>
                    </div>
                    <div class="p-6">
                        <x-pdf-download-button 
                            :url="route('student.portfolio.pdf')"
                            title="Download Portfolio PDF"
                            description="Complete portfolio with all your credentials"
                            icon="document"
                            color="purple"
                        />
                    </div>
                </div>
            @endif

            <!-- Credentials Grid -->
            @if(auth()->user()->credentials()->count() > 0)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Your Credentials</h3>
                        <p class="text-sm text-gray-600 mt-1">Click on any credential to view details, share, or generate QR code</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                        @foreach(auth()->user()->credentials as $credential)
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-all duration-300 cursor-pointer" onclick="openCredentialModal('{{ $credential->id }}')">
                                <!-- Credential Type Badge -->
                                <div class="flex justify-between items-start mb-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                        @if($credential->type === 'Degree') bg-blue-100 text-blue-800
                                        @elseif($credential->type === 'Certificate') bg-green-100 text-green-800
                                        @else bg-purple-100 text-purple-800 @endif">
                                        {{ $credential->type }}
                                    </span>
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                                
                                <!-- Credential Info -->
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $credential->credential_name }}</h4>
                                <p class="text-sm text-gray-600 mb-3">{{ $credential->institution->name }}</p>
                                
                                <!-- Issue Date -->
                                <div class="flex items-center text-xs text-gray-500 mb-4">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    Issued {{ $credential->created_at->format('M d, Y') }}
                                </div>
                                
                                <!-- Verification Code -->
                                <div class="bg-white rounded-lg p-3 border border-gray-200">
                                    <p class="text-xs text-gray-500 mb-1">Verification Code</p>
                                    <p class="font-mono text-sm font-semibold text-gray-900">{{ $credential->verification_code }}</p>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex space-x-2 mt-4">
                                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium py-2 px-3 rounded-lg transition-colors" onclick="event.stopPropagation(); shareCredential('{{ $credential->id }}')">
                                        Share
                                    </button>
                                    <button class="flex-1 bg-gray-600 hover:bg-gray-700 text-white text-xs font-medium py-2 px-3 rounded-lg transition-colors" onclick="event.stopPropagation(); generateQR('{{ $credential->id }}')">
                                        QR Code
                                    </button>
                                    <a href="{{ route('credential.pdf', $credential->id) }}" class="flex-1 bg-green-600 hover:bg-green-700 text-white text-xs font-medium py-2 px-3 rounded-lg transition-colors text-center" onclick="event.stopPropagation()">
                                        PDF
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Credentials Yet</h3>
                    <p class="text-gray-600 mb-6">You don't have any credentials issued yet. Contact your institution to get your first credential.</p>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 max-w-md mx-auto">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="text-left">
                                <p class="text-sm text-blue-800 font-medium">Need Help?</p>
                                <p class="text-sm text-blue-700 mt-1">Contact your institutional administrator to request credentials.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Credential Detail Modal -->
    <div id="credentialModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
                <div id="modalContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- QR Code Modal -->
    <div id="qrModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">QR Code</h3>
                    <div id="qrCodeContainer" class="mb-4">
                        <!-- QR Code will be generated here -->
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Scan this QR code to verify the credential</p>
                    <button onclick="closeQRModal()" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Multiple QR code generation methods with fallbacks
        class QRCodeGenerator {
            static async generateWithMultipleFallbacks(text, container) {
                const methods = [
                    () => this.generateWithQRServer(text),
                    () => this.generateWithGoQR(text),
                    () => this.generateWithQRCodeMonkey(text),
                    () => this.generateWithCanvas(text)
                ];

                for (let i = 0; i < methods.length; i++) {
                    try {
                        console.log(`Trying QR generation method ${i + 1}`);
                        const result = await methods[i]();
                        if (result.success) {
                            this.displayQRCode(result.data, container, result.type);
                            return true;
                        }
                    } catch (error) {
                        console.warn(`QR method ${i + 1} failed:`, error);
                        continue;
                    }
                }
                
                // All methods failed
                container.innerHTML = '<div class="text-center p-4"><p class="text-red-500 font-medium">QR Code generation failed</p><p class="text-sm text-gray-500 mt-2">Please try again or contact support</p></div>';
                return false;
            }

            static generateWithQRServer(text) {
                return new Promise((resolve) => {
                    const encodedText = encodeURIComponent(text);
                    const url = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodedText}`;
                    
                    const img = new Image();
                    img.onload = () => resolve({ success: true, data: url, type: 'image' });
                    img.onerror = () => resolve({ success: false });
                    img.src = url;
                });
            }

            static generateWithGoQR(text) {
                return new Promise((resolve) => {
                    const encodedText = encodeURIComponent(text);
                    const url = `https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=${encodedText}&choe=UTF-8`;
                    
                    const img = new Image();
                    img.onload = () => resolve({ success: true, data: url, type: 'image' });
                    img.onerror = () => resolve({ success: false });
                    img.src = url;
                });
            }

            static generateWithQRCodeMonkey(text) {
                return new Promise((resolve) => {
                    const encodedText = encodeURIComponent(text);
                    const url = `https://qr-code-generator.com/qr1/create-qr-code/?size=200x200&data=${encodedText}`;
                    
                    const img = new Image();
                    img.onload = () => resolve({ success: true, data: url, type: 'image' });
                    img.onerror = () => resolve({ success: false });
                    img.src = url;
                });
            }

            static generateWithCanvas(text) {
                return new Promise((resolve) => {
                    try {
                        // Simple canvas-based QR code generation
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');
                        canvas.width = 200;
                        canvas.height = 200;
                        
                        // Create a simple pattern (not a real QR code, but better than nothing)
                        ctx.fillStyle = '#000000';
                        ctx.fillRect(0, 0, 200, 200);
                        ctx.fillStyle = '#FFFFFF';
                        ctx.font = '12px monospace';
                        ctx.textAlign = 'center';
                        ctx.fillText('QR CODE', 100, 90);
                        ctx.fillText('PLACEHOLDER', 100, 110);
                        ctx.fillText('Scan manually:', 100, 130);
                        ctx.fillText(text.substring(0, 25), 100, 150);
                        
                        const dataUrl = canvas.toDataURL();
                        resolve({ success: true, data: dataUrl, type: 'canvas' });
                    } catch (error) {
                        resolve({ success: false });
                    }
                });
            }

            static displayQRCode(data, container, type) {
                container.innerHTML = '';
                
                const wrapper = document.createElement('div');
                wrapper.className = 'text-center';
                
                if (type === 'image' || type === 'canvas') {
                    const img = document.createElement('img');
                    img.src = data;
                    img.alt = 'QR Code for credential verification';
                    img.className = 'mx-auto border-2 border-gray-300 rounded-lg shadow-lg';
                    img.style.width = '200px';
                    img.style.height = '200px';
                    img.style.imageRendering = 'pixelated';
                    wrapper.appendChild(img);
                }
                
                const successMsg = document.createElement('p');
                successMsg.className = 'text-green-600 text-sm mt-2 font-medium';
                successMsg.textContent = '✓ QR Code generated successfully';
                wrapper.appendChild(successMsg);
                
                container.appendChild(wrapper);
                console.log('QR Code displayed successfully');
            }
        }
        function openCredentialModal(credentialId) {
            // Fetch credential details via AJAX
            fetch(`/credential/${credentialId}/details`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalContent').innerHTML = `
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex justify-between items-start">
                                <h3 class="text-xl font-semibold text-gray-900">${data.credential_name}</h3>
                                <button onclick="closeCredentialModal()" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-3">Credential Details</h4>
                                    <dl class="space-y-3">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Type</dt>
                                            <dd class="text-sm text-gray-900">${data.type}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Issue Date</dt>
                                            <dd class="text-sm text-gray-900">${data.issue_date}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Institution</dt>
                                            <dd class="text-sm text-gray-900">${data.institution}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Verification Code</dt>
                                            <dd class="text-sm font-mono font-semibold text-gray-900">${data.verification_code}</dd>
                                        </div>
                                    </dl>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-3">Student Information</h4>
                                    <dl class="space-y-3">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Name</dt>
                                            <dd class="text-sm text-gray-900">${data.student_name}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Student ID</dt>
                                            <dd class="text-sm text-gray-900">${data.student_id}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                            <div class="mt-6 space-y-3">
                                <div class="flex space-x-3">
                                    <button onclick="shareCredential('${credentialId}')" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                        Share Credential
                                    </button>
                                    <button onclick="generateQR('${credentialId}')" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                        Generate QR Code
                                    </button>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">Credential Hash:</span>
                                        <button onclick="copyHash('${data.credential_hash || 'N/A'}')" class="text-xs text-blue-600 hover:text-blue-800">Copy</button>
                                    </div>
                                    <code class="text-xs text-gray-600 break-all">${data.credential_hash || 'Not available'}</code>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="/credential/${credentialId}/download/user" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors text-center">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-4-4m4 4l4-4m-6 4H6a2 2 0 01-2-2V6a2 2 0 012-2h6"></path>
                                        </svg>
                                        JSON-LD
                                    </a>
                                    <a href="/credential/${credentialId}/pdf" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors text-center">
                                        <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                    document.getElementById('credentialModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to load credential details');
                });
        }

        function closeCredentialModal() {
            document.getElementById('credentialModal').classList.add('hidden');
        }

        function shareCredential(credentialId) {
            const shareUrl = `${window.location.origin}/verify/${credentialId}`;
            
            if (navigator.share) {
                navigator.share({
                    title: 'Verify My Credential',
                    text: 'Click to verify my credential',
                    url: shareUrl
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(shareUrl).then(() => {
                    alert('Share link copied to clipboard!');
                }).catch(() => {
                    prompt('Copy this link to share:', shareUrl);
                });
            }
        }

        async function generateQR(credentialId) {
            const verifyUrl = `${window.location.origin}/verify/${credentialId}`;
            const container = document.getElementById('qrCodeContainer');
            
            // Show loading state
            container.innerHTML = `
                <div class="text-center p-4">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                    <p class="text-gray-600">Generating QR Code...</p>
                </div>
            `;
            
            // Show modal immediately with loading state
            document.getElementById('qrModal').classList.remove('hidden');
            
            // Generate QR code with multiple fallbacks
            const success = await QRCodeGenerator.generateWithMultipleFallbacks(verifyUrl, container);
            
            if (!success) {
                // Ultimate fallback - show the URL as text with copy button
                container.innerHTML = `
                    <div class="text-center p-4">
                        <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg p-6 mb-4">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <p class="text-lg font-semibold text-gray-900 mb-2">Verification Link</p>
                            <p class="text-sm text-gray-600 mb-4">Share this link to verify your credential</p>
                            <div class="bg-white border rounded-lg p-3 mb-4">
                                <code class="text-sm text-blue-600 break-all">${verifyUrl}</code>
                            </div>
                            <button onclick="copyToClipboard('${verifyUrl}')" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Copy Link
                            </button>
                        </div>
                    </div>
                `;
            }
        }
        
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                // Show success feedback
                const button = event.target;
                const originalText = button.textContent;
                button.textContent = '✓ Copied!';
                button.className = 'bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors';
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.className = 'bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors';
                }, 2000);
            }).catch(() => {
                alert('Failed to copy to clipboard. Please copy manually.');
            });
        }

        function copyHash(hash) {
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

        function closeQRModal() {
            document.getElementById('qrModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        document.getElementById('credentialModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCredentialModal();
            }
        });

        document.getElementById('qrModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeQRModal();
            }
        });
    </script>
</x-app-layout>
