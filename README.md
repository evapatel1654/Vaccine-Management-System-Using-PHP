# Vaccination Management System

## Table of Contents
- [Project Description](#project-description)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [Screenshots](#screenshots)
- [Contact](#contact)

## Project Description
The Vaccination Management System is a web application designed to manage and track vaccination requests. It provides functionalities for user registration, vaccine request submissions, book appiontment, and user authentication, ensuring a streamlined process for managing vaccinations.

## Features
- User Registration and Authentication
- Vaccine Request Submission
- Book Appiontment
- User Profile Management
- Secure Login/Logout Functionality
- Responsive UI Design

## Technologies Used
- Frontend: HTML, CSS, JavaScript, jQuery, bootstrap
- Backend: PHP
- Database: MySQL

## Installation
To run this project locally, follow these steps:

1. Clone the repository:
    ```bash
    [gh repo clone evapatel1654/Vaccine-Management-System-Using-PHP](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP.git)
    ```

2. Navigate to the project directory:
    ```bash
    cd vaccination-management-system-using-php
    ```

3. Set up the database:
    - Create a MySQL database.
    - Where you need to create database name as 'userdb'
    - Then create 'user' and 'vaccinations' table in it.
      
Create 'user' table
   ```bash
    CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```
Alter the table to store some token 
  ```bash
      ALTER TABLE user
      ADD COLUMN failed_attempts INT DEFAULT 0,
      ADD COLUMN last_failed_attempt DATETIME DEFAULT NULL,
      ADD COLUMN remember_me_token VARCHAR(255) DEFAULT NULL;
  ```
  Create 'vaccinations' table
  ```bash
        CREATE TABLE IF NOT EXISTS vaccinations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(255) NOT NULL,
        lastname VARCHAR(255) NOT NULL,
        securityno VARCHAR(255) NOT NULL,
        dob DATE NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        phnumber VARCHAR(20) NOT NULL,
        gender VARCHAR(10) NOT NULL,
        address1 VARCHAR(255) NOT NULL,
        address2 VARCHAR(255),
        city VARCHAR(100) NOT NULL,
        state VARCHAR(100) NOT NULL,
        country VARCHAR(100) NOT NULL,
        insuranceco VARCHAR(255) NOT NULL,
        insuranceid VARCHAR(255) NOT NULL,
        diseases TEXT,
        declaration BOOLEAN NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
  ```
Alter vaccination table to add foregin key
```bash
  ALTER TABLE vaccination
  ADD COLUMN user_id INT;
```
```bash
  ALTER TABLE vaccination
  ADD CONSTRAINT fk_user_id
  FOREIGN KEY (user_id) REFERENCES user(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
```

4. Configure the database connection:
    - Open the `config.php` file.
    - Update the database configuration with your MySQL credentials.

5. Start a local development server:
    - You can use tools like XAMPP or WAMP to set up a local server.
    - Place the project directory in the `htdocs` folder (for XAMPP) or the `www` folder (for WAMP).

6. Access the application:
    - Open your web browser and go to `http://localhost/vaccination-management-system`.

## Usage
1. Register a new user account or log in with an existing account.
2. Navigate through the dashboard to manage your vaccination requests.
3. Users can access the dashboard to manage users, see registration and requests.

## Screenshots
Include screenshots of your application here to give users a visual overview.
Main Web page is save with file name 'index.html'.
![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/7a2f20ce-bfa0-47c7-92d9-a1a189075075)

Firstly SignIn, if you don't have account click on register else enter your email and password.
![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/23c44ad1-991b-477c-83ad-3918305e2438)

If you enter username instead of email it will not allow you to login.
![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/29dcf72a-81c0-4624-b9aa-27e58b44a8e2)

If password doesn't match then it will throw error.
![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/eab5d8b4-3a2e-4f52-9894-7fb7ad1db043)

The enter password is wrong for more then three times then your account will get locked for 15 mintues.
![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/3c30220d-3b15-4a8e-80ad-1ea898ee468f)

On successfull login you will be directed to index page.
![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/25155f02-a5aa-4983-a96a-c2529dbb984f)

Clicking on register you will be directed to registration page where you need to add correct details.
![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/eb594923-963b-4f05-938e-abb3b4ac9252)

![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/af453c2d-d847-4477-a416-5adc47c4ca70)

User already exists.
![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/14028c32-0660-4b16-860c-21fa93e76581)

![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/7753c52a-9f58-462a-a9c8-c5bb9228eda4)


On successfull registration your login page will be open where you need to enter the register email and password on success you will be directed to main page where you can request vaccination by clicking 'request vaccination' button.
Clicking that button will open a form like this where you need to add details according to functionality added.

![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/90f46fca-7217-46bd-a4c9-9ddce814bc92)

Submit button will store the enter in database and store button will store values in form temporary for that login user.

Clicking on 'About US' page will scroll down where the content is present.
![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/0327c5de-0705-4a26-b83c-6d8942e6db7f)

Same for all other.
![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/6fdf75c5-1c41-4f4d-a128-6cecb0baf556)

![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/2c0db15d-6744-4d89-8bcb-71eb274badde)


![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/e0256ba9-61f5-4b48-9406-002b4441d9b7)
On clicking Book appointment button, form will be open to book appointment.


![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/e692dfac-918a-4ead-b424-9d7e0fbf1ca2)


![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/da789f44-6b16-478d-988b-7824cb04692a)


![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/d857edd6-0583-46cc-a33a-d22a64e1d325)

On Clicking 'View Profile'.

![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/d20e4089-e665-4e68-9def-0ef72e9291e8)

On Clicking 'Your Registration'.

![image](https://github.com/evapatel1654/Vaccine-Management-System-Using-PHP/assets/133888581/2a9ff6de-c5d3-46ce-860f-f7ba2ede1d02)


## Contact
For any inquiries or feedback, feel free to contact:

- Name: Patel Eva Chirag
- Email: evachiragpatel@gmail.com
