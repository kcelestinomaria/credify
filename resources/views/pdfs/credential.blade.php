<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $credential->credential_name }} - Official Credential</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 40px;
            background: #ffffff;
        }
        .credential-container {
            border: 3px solid #2563eb;
            border-radius: 15px;
            padding: 40px;
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            position: relative;
            min-height: 600px;
        }
        .credential-header {
            text-align: center;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 30px;
            margin-bottom: 40px;
        }
        .credential-title {
            font-size: 32px;
            font-weight: bold;
            color: #2563eb;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .credential-subtitle {
            font-size: 18px;
            color: #6b7280;
            margin: 0;
            font-style: italic;
        }
        .institution-info {
            text-align: center;
            margin-bottom: 40px;
        }
        .institution-name {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
        }
        .institution-subtitle {
            font-size: 14px;
            color: #6b7280;
        }
        .student-info {
            text-align: center;
            margin: 40px 0;
            padding: 30px;
            background: rgba(37, 99, 235, 0.05);
            border-radius: 10px;
            border-left: 5px solid #2563eb;
        }
        .student-name {
            font-size: 28px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .student-id {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 5px;
        }
        .credential-details {
            margin: 40px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .detail-label {
            font-weight: bold;
            color: #374151;
            width: 40%;
        }
        .detail-value {
            color: #1f2937;
            width: 55%;
            text-align: right;
        }
        .verification-section {
            margin-top: 50px;
            padding: 25px;
            background: #f9fafb;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }
        .verification-title {
            font-size: 18px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 15px;
            text-align: center;
        }
        .verification-code {
            font-family: 'Courier New', monospace;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            background: #ffffff;
            padding: 15px;
            border: 2px dashed #2563eb;
            border-radius: 8px;
            color: #2563eb;
            letter-spacing: 3px;
            margin-bottom: 15px;
        }
        .verification-url {
            font-size: 12px;
            text-align: center;
            color: #6b7280;
            word-break: break-all;
        }
        .signatures {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }
        .signature-block {
            text-align: center;
            width: 45%;
        }
        .signature-line {
            border-top: 2px solid #374151;
            margin-bottom: 10px;
            height: 40px;
        }
        .signature-label {
            font-size: 12px;
            color: #6b7280;
            font-weight: bold;
        }
        .signature-name {
            font-size: 14px;
            color: #1f2937;
            margin-top: 5px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 11px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(37, 99, 235, 0.03);
            font-weight: bold;
            z-index: 0;
            pointer-events: none;
        }
        .content {
            position: relative;
            z-index: 1;
        }
        .type-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .type-degree { background: #dbeafe; color: #1e40af; }
        .type-certificate { background: #dcfce7; color: #166534; }
        .type-diploma { background: #fef3c7; color: #92400e; }
    </style>
</head>
<body>
    <div class="credential-container">
        <div class="watermark">CREDIFY</div>
        
        <div class="content">
            <div class="credential-header">
                <h1 class="credential-title">Official Credential</h1>
                <p class="credential-subtitle">Digitally Verified Educational Achievement</p>
            </div>

            <div class="institution-info">
                <div class="institution-name">{{ $credential->institution->name ?? 'Institution Name' }}</div>
                <div class="institution-subtitle">Authorized Educational Institution</div>
            </div>

            <div class="student-info">
                <div class="student-name">{{ $credential->student_first_name }} {{ $credential->student_last_name }}</div>
                <div class="student-id">Student ID: {{ $credential->student_school_id }}</div>
                <div style="margin-top: 15px;">
                    <span class="type-badge type-{{ strtolower($credential->type) }}">
                        {{ $credential->type }}
                    </span>
                </div>
            </div>

            <div style="text-align: center; margin: 30px 0; font-size: 18px; color: #1f2937;">
                <strong>{{ $credential->credential_name }}</strong>
            </div>

            <div class="credential-details">
                <div class="detail-row">
                    <span class="detail-label">Credential Type:</span>
                    <span class="detail-value">{{ $credential->type }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Date Issued:</span>
                    <span class="detail-value">{{ $credential->issued_at->format('F j, Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Issued By:</span>
                    <span class="detail-value">{{ $credential->issuedBy->first_name ?? 'N/A' }} {{ $credential->issuedBy->last_name ?? '' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Institution:</span>
                    <span class="detail-value">{{ $credential->institution->name ?? 'N/A' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Credential Hash:</span>
                    <span class="detail-value" style="font-family: 'Courier New', monospace; font-size: 10px; word-break: break-all;">{{ substr($credential->credential_hash, 0, 32) }}...</span>
                </div>
            </div>

            <div class="verification-section">
                <div class="verification-title">Verification Information</div>
                <div class="verification-code">{{ $credential->verification_code }}</div>
                <div class="verification-url">
                    Verify this credential at: {{ $verification_url }}
                </div>
            </div>

            <div class="signatures">
                <div class="signature-block">
                    <div class="signature-line"></div>
                    <div class="signature-label">INSTITUTIONAL AUTHORITY</div>
                    <div class="signature-name">{{ $credential->issuedBy->first_name ?? 'Authorized' }} {{ $credential->issuedBy->last_name ?? 'Signatory' }}</div>
                </div>
                <div class="signature-block">
                    <div class="signature-line"></div>
                    <div class="signature-label">DIGITAL SIGNATURE</div>
                    <div class="signature-name">Cryptographically Secured</div>
                </div>
            </div>

            <div class="footer">
                <p><strong>This is an official digital credential issued by {{ $credential->institution->name ?? 'the institution' }}.</strong></p>
                <p>Generated on {{ $generated_at->format('F j, Y \a\t g:i A') }} | Document ID: {{ $credential->id }}</p>
                <p>This credential is secured with blockchain-compatible cryptographic verification.</p>
                <p><em>Any alterations to this document will invalidate its authenticity.</em></p>
            </div>
        </div>
    </div>
</body>
</html>
