# RADIUS DALO PPPOE — PHP + MySQL

## Requirements
- PHP 8.0+ with PDO MySQL enabled
- MySQL 5.7+ or MariaDB 10.3+
- Apache (XAMPP is suitable)

## Install on XAMPP
1. Extract `RADIUSDB_PHP_MySQL.zip` into `C:\xampp\htdocs\RADIUSDB_PHP_MySQL`.
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin: `http://localhost/phpmyadmin`.
4. Import `database.sql`.
5. Edit `config.php` and set your MySQL host, database, username and password.
   Default XAMPP values are `localhost`, `radius_db`, `root`, and blank password.
6. Open `http://localhost/RADIUSDB_PHP_MySQL/setup.php`.
7. Create your first admin. Use a strong password (12+ characters).
8. DELETE `setup.php` from the project after the admin is created.
9. Open `http://localhost/RADIUSDB_PHP_MySQL/`.

## Features
- Admin login backed by a password hash in MySQL
- Add, edit and delete RADIUS user records
- CSI/MAC bound, wildcard (`*`) and no-CSI classifications
- Search, filters, dashboard counters and notes viewer
- SQL INSERT import for `radcheck` and `userinfo`, merged by username
- CSV export

## Important security notes
- This application is a user database manager; it does not itself configure FreeRADIUS or provision live PPPoE sessions.
- Password values are stored as entered because the supplied dashboard displays/imports RADIUS Cleartext-Password values. Restrict database and server access and use HTTPS if accessed over a network.
- Never expose phpMyAdmin publicly. Back up the database regularly.
- The `setup.php` installer must be removed after the first admin account is created.


IMPORT NOTE (updated): Firstname, lastname and notes are read by userinfo column names. The displayed MAC address is extracted from the MAC pattern inside userinfo.notes. Calling-Station-Id from radcheck is deliberately NOT treated as a MAC address. After updating, re-import the same SQL dump so existing records are corrected.
