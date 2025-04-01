# E-Commerce Website

A full-featured e-commerce platform with separate user and admin interfaces. This project provides a complete solution for online shopping with secure user authentication, product management, shopping cart functionality, and order processing.

## 🚀 Technologies Used

- **PHP** - Server-side scripting language
- **MySQL** - Database management
- **HTML5/CSS3** - Frontend structure and styling
- **JavaScript** - Interactive elements and UI enhancements
- **Bootstrap Icons** - Icon library for UI elements
- **Session Management** - For user authentication and cart management

## ✨ Features

### User Interface
- User registration and login system
- Product browsing and searching
- Shopping cart functionality
- Order placement and tracking
- User profile management
- Responsive design for all devices

### Admin Dashboard
- Secure admin login
- Product management (add, edit, delete)
- Order management and processing
- User account management
- Message center for customer communication
- Sales analytics and reporting

## 🔒 Security Features

- Password hashing for secure authentication
- SQL injection prevention with prepared statements
- Session management and validation
- Input sanitization and validation
- Secure file upload handling

## 📂 Project Structure

```
e-commerce/
├── admin_header.php       # Admin header template
├── admin_message.php      # Admin message management
├── admin_order.php        # Admin order management
├── admin_pannel.php       # Admin dashboard
├── admin_product.php      # Admin product management
├── admin_user.php         # Admin user management
├── connection.php         # Database connection
├── index.php              # Main user homepage
├── login.php              # User/Admin login page
├── register.php           # User registration
├── script.js              # JavaScript functionality
├── style.css              # Main stylesheet
└── img/                   # Image directory
```

## 🚦 Getting Started

1. Install XAMPP or any PHP development environment
2. Clone this repository to your htdocs folder
3. Import the database schema (provided in SQL file)
4. Configure database connection in `connection.php`
5. Access the website through localhost in your browser

## 👥 User Types

- **Admin**: Full access to admin dashboard and management features
- **User**: Can browse products, manage cart, place orders, and track order status

## 🖥️ Installation

1. Make sure you have XAMPP/WAMP/MAMP installed
2. Place project files in htdocs directory
3. Start Apache and MySQL services
4. Import the database schema
5. Visit http://localhost/e-commerce to access the application

## 🔐 Default Login Credentials

### Admin
- Email: admin@example.com
- Password: admin123

### Test User
- Email: user@example.com
- Password: user123

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details. 