# Dental Management System

## Overview

The **Dental Management System** is a comprehensive web application designed to help dental clinics manage patient information, appointments, treatments, and other clinic operations. The system allows staff to easily track patient details, manage appointments, and maintain treatment histories.
![image](https://github.com/user-attachments/assets/222f3fc6-1fca-479e-86fa-fc9ed94a4465)

## Features

- **Patient Management**: Add, update, and view patient information including personal details, medical history, and contact information.
- **Appointment Scheduling**: Schedule and manage patient appointments, including viewing available time slots.
- **Treatment Records**: Record and track treatments, including diagnosis, procedures, and prescriptions.
- **Billing System**: Generate bills for treatments, manage payments, and track outstanding invoices.
- **User Management**: Admin and staff roles with specific permissions, including creating and managing accounts, and viewing restricted data.
- **Responsive Interface**: Fully responsive design to ensure the system works well on both desktops and mobile devices.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript (for the user interface)
- **Backend**: PHP (for server-side operations)
- **Database**: MySQL (for storing patient, appointment, and treatment data)
- **Authentication**: Secure login system for both admin and staff users

## Installation
![image](https://github.com/user-attachments/assets/16e3e0b3-2128-4ccd-8270-b12b194bf352)

### Prerequisites

- **XAMPP** or a similar local server setup
- **MySQL database**

### Steps to Set Up

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-username/dental-management-system.git
Place the Project in the XAMPP Directory: Move the cloned project folder to the htdocs directory of your XAMPP installation.

Create the Database:

Open phpMyAdmin or MySQL Workbench and create a new database:
sql
Copy code
CREATE DATABASE dental_db;
Import the Database:

Import the database structure and sample data into the dental_db database.
Configure Database Connection:
![image](https://github.com/user-attachments/assets/2d50178e-90ec-48ba-9f61-de746327c691)

Edit the config.php file in the root directory to include your database connection details:
php
Copy code
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'dental_db');
Start the XAMPP Server:
![image](https://github.com/user-attachments/assets/e3d8e81d-68c4-4cc9-a52c-f68ca401e6f2)

Start Apache and MySQL from the XAMPP control panel.
Access the Application:

Open your browser and go to http://localhost/dental-management-system/ to access the application.
Usage
Admin Login:
Username: admin
Password: adminpassword
As the admin, you can manage patients, appointments, and other clinic operations.
Staff Login:
Username: staff
![image](https://github.com/user-attachments/assets/d5726688-2a13-4187-9fb8-4defbfc0a157)

Password: staffpassword
Staff members can view and update patient appointments and treatment records.
Contributing
Fork the repository.
Create a new branch for your feature or bug fix.
Make your changes and commit them with descriptive messages.
Push your changes and submit a pull request.
License
This project is licensed under the MIT License - see the LICENSE file for details.
![image](https://github.com/user-attachments/assets/a641ee1f-20d9-4852-bd90-6f3634e9ab07)

markdown
Copy code

### Key Markdown Elements:

1. **Headers**: Use `#` for large headers and more `#` for smaller sub-headers:
   - `# Heading 1`
   - `## Heading 2`
   - `### Heading 3`
   
2. **Bold Text**: Wrap text with `**` to make it bold:
   - `**Bold text**`
   
3. **Italic Text**: Wrap text with `*` for italics:
   - `*Italic text*`
   
4. **Code Blocks**: Wrap code snippets with backticks (`` ` ``) for inline code, or triple backticks (```` ``` ````) for multi-line code blocks:
   - Inline: `` `code` ``
   - Block: 
     ```bash
     command
     ```

5. **Lists**: Use `-` or `*` for unordered lists, and numbers for ordered lists:
   - `- Item 1`
   - `1. First item`

This will ensure your text is properly formatted with different styles. GitHub automatically applies its own styles to the Markdown syntax, but it doesn’t support custom CSS or font size changes directly.




Connect with Me
Facebook
Instagram
- [Facebook](https://www.facebook.com/eita.rohan)
- [Instagram](https://www.instagram.com/rohan.rusho)




