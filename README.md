# Circle
## Social Network System

Circle is a web-based social networking platform developed during an internship experiment organized by Taiyuan University of Technology at the university campus in July 2023. This project showcases proficiency in full-stack web development and database integration, implemented using HTML, CSS, JavaScript, PHP and MySQL. 

## Features

- **User Registration and Login**: Users can create accounts and log in securely using their credentials.
  
- **Profile Management**: Users can upload profile pictures and update their personal information.

- **Friend Management**: Users can search for other users, send friend requests, accept or reject friend requests, block/unblock users, and delete existing friends.

- **Messaging**: Users can send private messages to their friends.

- **Post and Comment**: Users can create posts and share them with their friends or publicly. Other users can comment on these posts.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP 7.0
- **Database**: MySQL 5.7
- **phpMyAdmin**: 4.6
- **Server**: Wamp or Xampp server compatible with above php and MySQL versions.

## Installation

### Method 1: 

1. Create a database called "agajan_circle".
2. Import the database schema from `uploads/agajan_circle.sql`.

### Method 2:

1. Run the `admin/install.php` script provided in the repository. Ensure that you have configured the database connection options in `include/functions/database_class.php` before running the script.

install.php
```php
<?php 
	require "../include/functions/database_class.php";
	// Rest of the installation script
?>
```

## Usage

1. Register a new account or log in if you already have one.
2. Update your profile information and upload a profile picture.
3. Search for other users and add them as friends.
4. Send private messages to your friends.
5. Create posts and comment on posts from your friends.

## Contributing

Contributions are welcome! If you'd like to contribute to this project, please fork the repository and submit a pull request with your changes.
