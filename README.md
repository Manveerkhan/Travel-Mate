# Travel Mate - Travel Planning and Booking Platform

A complete responsive website project for travel planning and booking with a user interface and admin panel.

## Features

### Frontend (User Side)
- **Home Page** with banner and navigation bar
- **Destinations** page displaying popular travel locations with images, descriptions, and "Book Now" buttons
- **Packages** page showing tour packages with price, duration, and booking link
- **About Us** and **Contact Us** pages
- **User Registration and Login** system (using PHP and MySQL)
- **Booking System** - Users can book packages after login
- **User Profile** with booking history
- **Search functionality** for destinations
- **Weather Widget** using OpenWeatherMap API
- Responsive layout using HTML, CSS, Bootstrap 5, and JavaScript

### Backend (Admin Panel)
- **Admin login** page
- **Admin dashboard** with summary cards (total users, total bookings, total destinations)
- **Add/Edit/Delete destinations** with image upload
- **Add/Edit/Delete tour packages** with image upload
- **Manage user accounts** (view or delete)
- **View all bookings** with details (user name, destination, date, status)
- **Update booking status** (Pending/Approved)
- **Dashboard chart** using Chart.js
- Logout option

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) or PHP built-in server
- OpenWeatherMap API key (optional, for weather widget)

### Setup Steps

1. **Clone or download this project** to your web server directory

2. **Import the database:**
   - Open phpMyAdmin or MySQL command line
   - Import `database.sql` file to create the database and tables
   - Default admin credentials: `admin` / `admin123` (change immediately after first login)

3. **Configure database connection:**
   - Edit `includes/db.php` and update database credentials:
     ```php
     $host = 'localhost';
     $db   = 'travel_mate';
     $user = 'root';
     $pass = '';
     ```

4. **Create uploads directory:**
   - Create `uploads/` folder in the project root
   - Set write permissions (chmod 755 or 777)

5. **Configure Weather Widget (Optional):**
   - Get free API key from [OpenWeatherMap](https://openweathermap.org/api)
   - Edit `assets/js/app.js`
   - Replace `YOUR_OPENWEATHERMAP_API_KEY` with your actual API key

6. **Start the server:**
   ```bash
   # Using PHP built-in server
   php -S localhost:8000
   ```
   Or configure your web server (Apache/Nginx) to point to the project directory

7. **Access the website:**
   - User side: `http://localhost:8000/index.php`
   - Admin panel: `http://localhost:8000/admin/login.php`

## Project Structure

```
travel-mate/
├── admin/
│   ├── login.php
│   ├── logout.php
│   ├── dashboard.php
│   ├── destinations.php
│   ├── packages.php
│   ├── users.php
│   └── bookings.php
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── app.js
│   └── images/
├── includes/
│   ├── db.php
│   ├── header.php
│   ├── footer.php
│   └── auth.php
├── uploads/
├── index.php
├── destinations.php
├── packages.php
├── about.php
├── contact.php
├── register.php
├── login.php
├── logout.php
├── book.php
├── profile.php
├── database.sql
└── README.md
```

## Database Schema

- **users**: User accounts (id, name, email, password, created_at)
- **destinations**: Travel destinations (id, name, description, image)
- **packages**: Tour packages (id, destination_id, title, price, duration, image)
- **bookings**: User bookings (id, user_id, package_id, booking_date, status, created_at)
- **admin**: Admin accounts (id, username, password)

## Security Notes

- Change default admin password immediately
- Store sensitive credentials in environment variables
- Use prepared statements (already implemented)
- Validate and sanitize all user inputs
- Implement CSRF protection for production
- Use HTTPS in production
- Regularly update dependencies

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5.3.3
- **Backend**: PHP (with MySQLi)
- **Database**: MySQL
- **Libraries**: Chart.js 4.4.1, OpenWeatherMap API

## License

This project is open source and available for educational purposes.

## Support

For issues or questions, please check the code comments or create an issue in the repository.

