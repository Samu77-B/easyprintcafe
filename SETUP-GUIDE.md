# EasyPrintCafe Database Setup Guide

This guide will help you set up the MySQL database connection and user authentication system for your EasyPrintCafe website hosted on Hostinger.

## Prerequisites

- Hostinger hosting account with MySQL database access
- PHP 7.4 or higher
- MySQL 5.7 or higher

## Step 1: Database Configuration

### 1.1 Create MySQL Database

1. Log into your Hostinger control panel
2. Go to **Databases** → **MySQL Databases**
3. Create a new database (e.g., `easyprintcafe_db`)
4. Create a new MySQL user with a strong password
5. Grant all privileges to the user for the database

### 1.2 Update Database Configuration

Edit the file `config/database.php` and update the following constants:

```php
define('DB_HOST', 'localhost'); // Usually 'localhost' for Hostinger
define('DB_NAME', 'your_database_name'); // Your database name
define('DB_USER', 'your_database_username'); // Your database username
define('DB_PASS', 'your_database_password'); // Your database password
```

### 1.3 Update JWT Secret

Change the JWT secret key in `config/database.php`:

```php
define('JWT_SECRET', 'your_very_long_random_secret_key_here'); // Generate a secure random string
```

## Step 2: File Permissions

Set up proper file permissions for the uploads directory:

```bash
chmod 755 uploads/
chmod 755 config/
chmod 644 config/*.php
```

## Step 3: SSL Certificate (Recommended)

1. Enable SSL certificate in your Hostinger control panel
2. Force HTTPS redirects in your `.htaccess` file:

```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

## Step 4: Database Initialization

The database tables will be automatically created when you first access the application. The system will create the following tables:

- `users` - User accounts and authentication
- `user_addresses` - Billing and delivery addresses
- `orders` - Customer orders
- `order_items` - Individual items in orders
- `invoices` - Invoice records
- `user_files` - Uploaded artwork files
- `user_sessions` - User session management
- `rate_limits` - API rate limiting
- `security_logs` - Security event logging

## Step 5: Testing the System

### 5.1 Test Database Connection

Visit: `https://yourdomain.com/api/auth/check.php`

You should see a JSON response (will show "Not authenticated" which is normal).

### 5.2 Create Your First User

Since the system is invitation-only, you'll need to send an invitation first. You can do this by:

1. Accessing the admin panel (you'll need to create this)
2. Or manually inserting a user record in the database

To manually create a user:

```sql
INSERT INTO users (email, invitation_token, invitation_expires, company_name, created_at)
VALUES ('your-email@example.com', 'unique-token-here', DATE_ADD(NOW(), INTERVAL 7 DAY), 'Your Company', NOW());
```

Then visit: `https://yourdomain.com/pages/signup.html?token=unique-token-here`

## Step 6: Cron Job Setup

Set up a daily cron job to clean up expired files:

1. In your Hostinger control panel, go to **Advanced** → **Cron Jobs**
2. Add a new cron job:
   - **Command**: `php /home/u123456789/domains/yourdomain.com/public_html/scripts/cleanup-expired-files.php`
   - **Schedule**: `0 2 * * *` (runs daily at 2 AM)

## Step 7: Security Features

The system includes the following security features:

### 7.1 Authentication
- Secure password hashing using Argon2ID
- Session management with secure cookies
- Account lockout after failed login attempts
- Invitation-only registration

### 7.2 File Upload Security
- File type validation
- File size limits (50MB max)
- Malicious file detection
- Secure file storage with 3-month auto-deletion

### 7.3 API Security
- Rate limiting to prevent abuse
- CSRF protection
- Input validation and sanitization
- Security headers
- SQL injection prevention with prepared statements

## Step 8: User Management

### 8.1 Sending Invitations

To invite new users, you can create a simple admin interface or use the database directly:

```sql
INSERT INTO users (email, invitation_token, invitation_expires, company_name, created_at)
VALUES ('newuser@example.com', 'random-token-123', DATE_ADD(NOW(), INTERVAL 7 DAY), 'Company Name', NOW());
```

Then send the user this link:
`https://yourdomain.com/pages/signup.html?token=random-token-123`

### 8.2 Managing Users

You can view and manage users through the database or create an admin interface. Key user fields:

- `email` - User's email address
- `is_active` - Whether the account is active
- `is_verified` - Whether the account is verified
- `last_login` - Last login timestamp
- `login_attempts` - Number of failed login attempts

## Step 9: Monitoring and Maintenance

### 9.1 Log Files

Monitor these log files for issues:
- PHP error logs
- Security logs (stored in `security_logs` table)
- Failed login attempts

### 9.2 Regular Maintenance

1. **Daily**: Check security logs for suspicious activity
2. **Weekly**: Review failed login attempts
3. **Monthly**: Clean up old security logs
4. **Quarterly**: Review and update security settings

## Step 10: Backup Strategy

1. **Database Backup**: Set up automated daily database backups in Hostinger
2. **File Backup**: Backup the `uploads/` directory regularly
3. **Code Backup**: Keep your code in version control (Git)

## Troubleshooting

### Common Issues

1. **Database Connection Failed**
   - Check database credentials in `config/database.php`
   - Verify database exists and user has proper permissions

2. **File Upload Issues**
   - Check file permissions on `uploads/` directory
   - Verify PHP upload limits in `php.ini`

3. **Session Issues**
   - Ensure SSL certificate is properly configured
   - Check cookie settings and domain configuration

4. **Email Issues**
   - Configure SMTP settings for invitation emails
   - Test email delivery

### Support

For technical support, contact:
- Hostinger support for hosting-related issues
- Check PHP error logs for application errors
- Review security logs for authentication issues

## Security Best Practices

1. **Regular Updates**: Keep PHP and MySQL updated
2. **Strong Passwords**: Use strong passwords for database users
3. **SSL Certificate**: Always use HTTPS in production
4. **Regular Backups**: Implement automated backup strategy
5. **Monitor Logs**: Regularly check security and error logs
6. **Access Control**: Limit admin access and use strong authentication

## Next Steps

1. Test all functionality thoroughly
2. Set up monitoring and alerting
3. Create user documentation
4. Implement additional features as needed
5. Set up automated testing

---

**Important**: This system is designed for production use but requires proper configuration and security measures. Always test thoroughly before deploying to production and keep regular backups.
