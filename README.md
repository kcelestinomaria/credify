# CredVerify: Academic Credential Verification System

![CredVerify Logo](https://via.placeholder.com/400x100?text=CredVerify+Logo)

## Overview

CredVerify is a secure, scalable platform for managing and verifying academic credentials. Built with Laravel and Livewire, it provides institutions with a robust solution for issuing, managing, and verifying academic credentials with cryptographic integrity.

## Features

- **Role-Based Access Control**
  - Super Admin: System-wide management
  - Institutional Admin: Institution-specific management
  - Student: View and share credentials

- **Credential Management**
  - Issue digital academic credentials
  - Generate unique verification codes
  - Cryptographic hashing for tamper-proofing
  - W3C Verifiable Credentials standard compliance

- **Verification System**
  - Public verification portal
  - QR code verification
  - API endpoints for programmatic verification

- **Security**
  - Secure file storage
  - Password policies and 2FA support
  - Audit logging

## System Requirements

- PHP 8.2+
- Composer 2.0+
- Node.js 16+
- MySQL 8.0+ or SQLite 3.35+
- Web server (Nginx/Apache)
- File storage with write permissions

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-organization/credverify.git
cd credverify
```

### 2. Install Dependencies

```bash
composer install
npm install
npm run build
```

### 3. Configure Environment

Copy the example environment file and generate an application key:

```bash
cp .env.example .env
php artisan key:generate
```

Update the `.env` file with your database credentials and other settings.

### 4. Database Setup

Run migrations and seed the database with initial data:

```bash
php artisan migrate --seed
```

### 5. Storage Link

Create a symbolic link for file storage:

```bash
php artisan storage:link
```

### 6. Start the Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## User Roles and Permissions

### Super Admin
- Full system access
- Manage institutions
- Manage institutional admins
- System configuration

### Institutional Admin
- Manage students within their institution
- Issue and revoke credentials
- Generate verification reports
- Manage institutional settings

### Student
- View issued credentials
- Share credentials via secure links
- Generate verification QR codes

## API Documentation

### Public Verification Endpoint

```
GET /api/verify/{verification_code}
```

**Response**
```json
{
    "status": "success",
    "credential": {
        "id": 1,
        "verification_code": "CRED-ABC12345",
        "credential_name": "Bachelor of Science in Computer Science",
        "student_name": "John Doe",
        "student_id": "STU2023001",
        "issued_by": "Example University",
        "issued_at": "2025-08-15T00:00:00.000000Z",
        "credential_hash": "a1b2c3d4..."
    }
}
```

## Security Considerations

- All credentials are cryptographically hashed using SHA-256
- File uploads are validated and scanned for malware
- API endpoints are rate-limited
- Sensitive operations require re-authentication
- Regular security audits are recommended

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For support, please contact [support@credverify.example.com](mailto:support@credverify.example.com)

## Acknowledgments

- Built with [Laravel](https://laravel.com)
- Frontend powered by [Livewire](https://laravel-livewire.com)
- QR Code generation by [Simple QrCode](https://www.simplesoftware.io/docs/simple-qrcode)
- UI components from [Tailwind CSS](https://tailwindcss.com/)
