# Password Hashing System

## Software Security — Chapter 03: User Authentication

**Student Name:** Raghad A I Haniya  
**Student ID:** 220221528  
**Course:** Software Security (SDEV 4303)  
**Instructor:** Dr. Abdelkareem Alashqar  
**University:** Islamic University of Gaza  
**Academic Year:** First Semester 2026/2027

## Project Description

This project is a simple password authentication system implemented in PHP. It allows users to register, log in, and display stored authentication data.

The main purpose of this project is to demonstrate how password hashing and salting can help protect user passwords.

## Features

- User registration with a username and password.
- Random salt generation for each registered user.
- SHA-256 password hashing.
- Login verification using the stored salt and hash.
- Displaying stored authentication data.
- Saving user data in a text file named `users.txt`.

## Technologies Used

- PHP
- SHA-256
- Visual Studio Code
- Text file storage

## How It Works

### Registration

When a user registers, the program generates a random salt and calculates a hash using the password and salt. The username, salt, and hash are stored in `users.txt`.

### Login

When a user logs in, the program uses the entered password and the stored salt to calculate a new hash. It compares the new hash with the stored hash to determine whether the password is correct.

### Stored Data

The program stores the username, salt, and password hash instead of storing the original password.

## How to Run

1. Install PHP on your computer.
2. Open the project folder in Visual Studio Code.
3. Open the terminal in the project folder.
4. Run the following command:

```bash
php auth.php
```

5. Follow the menu displayed in the terminal.

## Testing

The program was tested with the following cases:

- Successful user registration.
- Successful login using the correct password.
- Failed login using an incorrect password.
- Displaying the stored username, salt, and hash.

## Security Note

This project is for educational purposes. For real-world applications, a password-specific hashing function such as Argon2id or bcrypt is recommended instead of plain SHA-256.

## Conclusion

This project demonstrates the basic concepts of password authentication, hashing, and salting using PHP.

