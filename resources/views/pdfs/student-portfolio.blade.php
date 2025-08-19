<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $student->first_name }} {{ $student->last_name }} - Credentials Portfolio</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 30px;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 25px;
            margin-bottom: 35px;
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            padding: 30px;
            border-radius: 10px;
        }
        .header h1 {
            color: #2563eb;
            font-size: 28px;
            margin: 0 0 10px 0;
            font-weight: bold;
        }
        .header .subtitle {
            color: #6b7280;
            font-size: 16px;
            margin: 0;
            font-style: italic;
        }
        .student-info {
            background: #f9fafb;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            border-left: 5px solid #2563eb;
        }
        .student-name {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .student-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
        }
        .detail-item {
            display: flex;
            justify-content: space-between;
        }
        .detail-label {
            font-weight: bold;
            color: #374151;
        }
        .detail-value {
            color: #1f2937;
        }
        .stats-section {
            margin-bottom: 30px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }
        .stat-card {
            background: #ffffff;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }
        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #2563eb;
            display: block;
            margin-bottom: 5px;
        }
        .stat-label {
            color: #6b7280;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .credentials-section {
            margin-bottom: 30px;
        }
        .section-title {
            color: #1f2937;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .credential-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .credential-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .credential-name {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
        }
        .credential-type {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .type-degree { background: #dbeafe; color: #1e40af; }
        .type-certificate { background: #dcfce7; color: #166534; }
        .type-diploma { background: #fef3c7; color: #92400e; }
        .credential-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
        }
        .credential-meta {
            font-size: 11px;
            color: #6b7280;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }
        .verification-code {
            font-family: 'Courier New', monospace;
            background: #f3f4f6;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
        }
        .summary-section {
            background: #f8fafc;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            margin-bottom: 30px;
        }
        .summary-title {
            font-size: 18px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 15px;
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .summary-item {
            background: #ffffff;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }
        .summary-item h4 {
            margin: 0 0 10px 0;
            color: #374151;
            font-size: 14px;
        }
        .summary-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .summary-list li {
            padding: 3px 0;
            font-size: 11px;
            color: #6b7280;
        }
        .footer {
            border-top: 2px solid #e5e7eb;
            padding-top: 20px;
            margin-top: 40px;
            text-align: center;
            color: #6b7280;
            font-size: 10px;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>CREDENTIALS PORTFOLIO</h1>
        <div class="subtitle">Official Academic Achievement Record</div>
    </div>

    <div class="student-info">
        <div class="student-name">{{ $student->first_name }} {{ $student->last_name }}</div>
        <div class="student-details">
            <div class="detail-item">
                <span class="detail-label">Student ID:</span>
                <span class="detail-value">{{ $student->school_id ?? 'N/A' }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Email:</span>
                <span class="detail-value">{{ $student->email }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Institution:</span>
                <span class="detail-value">{{ $student->institution->name ?? 'N/A' }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Portfolio Generated:</span>
                <span class="detail-value">{{ $generated_at->format('F j, Y') }}</span>
            </div>
        </div>
    </div>

    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number">{{ $total_credentials }}</span>
                <div class="stat-label">Total Credentials</div>
            </div>
            @foreach($credentials_by_type as $type => $count)
            <div class="stat-card">
                <span class="stat-number">{{ $count }}</span>
                <div class="stat-label">{{ $type }}{{ $count > 1 ? 's' : '' }}</div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="summary-section">
        <div class="summary-title">Portfolio Summary</div>
        <div class="summary-grid">
            <div class="summary-item">
                <h4>Credentials by Type</h4>
                <ul class="summary-list">
                    @foreach($credentials_by_type as $type => $count)
                    <li>{{ $type }}: {{ $count }} credential{{ $count > 1 ? 's' : '' }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="summary-item">
                <h4>Recent Activity</h4>
                <ul class="summary-list">
                    <li>Latest credential: {{ $credentials->first()->issued_at->format('M j, Y') }}</li>
                    <li>First credential: {{ $credentials->last()->issued_at->format('M j, Y') }}</li>
                    <li>Active period: {{ $credentials->last()->issued_at->diffInMonths($credentials->first()->issued_at) }} months</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="credentials-section">
        <h2 class="section-title">Detailed Credentials</h2>
        
        @foreach($credentials as $index => $credential)
            @if($index > 0 && $index % 3 == 0)
                <div class="page-break"></div>
            @endif
            
            <div class="credential-card">
                <div class="credential-header">
                    <div class="credential-name">{{ $credential->credential_name }}</div>
                    <span class="credential-type type-{{ strtolower($credential->type) }}">
                        {{ $credential->type }}
                    </span>
                </div>
                
                <div class="credential-details">
                    <div class="detail-item">
                        <span class="detail-label">Institution:</span>
                        <span class="detail-value">{{ $credential->institution->name ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Date Issued:</span>
                        <span class="detail-value">{{ $credential->issued_at->format('F j, Y') }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Issued By:</span>
                        <span class="detail-value">{{ $credential->issuedBy->first_name ?? 'N/A' }} {{ $credential->issuedBy->last_name ?? '' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Verification Code:</span>
                        <span class="detail-value">
                            <span class="verification-code">{{ $credential->verification_code }}</span>
                        </span>
                    </div>
                </div>
                
                <div class="credential-meta">
                    <strong>Verification:</strong> This credential can be verified at {{ url("/verify/{$credential->id}") }}<br>
                    <strong>Digital Signature:</strong> {{ substr($credential->credential_hash, 0, 16) }}...
                </div>
            </div>
        @endforeach
    </div>

    <div class="footer">
        <p><strong>This portfolio contains officially verified digital credentials.</strong></p>
        <p>Generated on {{ $generated_at->format('F j, Y \a\t g:i A') }} by Credify System</p>
        <p>All credentials in this portfolio are cryptographically secured and can be independently verified.</p>
        <p><em>This document serves as an official record of academic achievements.</em></p>
    </div>
</body>
</html>
