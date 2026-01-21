# Guestbook Simple

A simple PHP guestbook application with user authentication and message posting functionality.

## Features

- User registration and login
- User profiles
- Message posting with pagination
- Session-based authentication
- Responsive design with custom CSS

## Project Structure

```
guestbook_simple/
├── index.php              # Main guestbook page
├── login.php              # Login page
├── logout.php             # Logout functionality
├── register.php           # User registration
├── profile.php            # User profile page
├── about.php              # About page
├── config.php             # Database configuration
├── functions.php          # Core functions
├── style.css              # Styling
├── sql/
    └── scheme.sql         # SQL Scheme
└── partials/
    ├── head.php           # HTML head section
    ├── nav.php            # Navigation bar
    └── footer.php         # Footer
```

## Requirements

- PHP 7.2 or higher
- MySQL/MariaDB
- XAMPP (recommended for local development)

## Installation

1. Clone this repository
2. Create a MySQL database named `guestbook_simple`
3. Create a `config.php` file in the root directory with your database credentials:

```php
<?php
    $host = '127.0.0.1';
    $db = 'guestbook_simple';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
?>
```

4. Import the database schema
5. Place the project in your web server's root directory (e.g., `htdocs` for XAMPP)
6. Access the application via `http://localhost/guestbook_simple/`

## Usage

1. Register a new user account
2. Log in with your credentials
3. Create messages in the guestbook
4. View other users' messages
5. Manage your profile

## Security Notes

- **Note:** `config.php` contains database credentials and should **not** be committed to version control
- Passwords are hashed before storage
- Input validation and sanitization are implemented
- Use prepared statements to prevent SQL injection

## Future Improvements

- Add message editing/deletion
- Implement user roles and permissions
- Add email notifications
- Improve database schema with proper indexing
- Add API endpoints
- Implement rate limiting

## License

This project is open source and available under the MIT License.

## Author

Created as a learning project for PHP web development.
