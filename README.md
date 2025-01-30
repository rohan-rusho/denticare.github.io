# 🏥 Dental Management System

## 📌 Overview

The **Dental Management System** is a comprehensive web application designed to help dental clinics efficiently manage patient records, appointments, treatments, and overall clinic operations. It provides a user-friendly interface for clinic staff to streamline workflows and enhance patient care.

---

## 🎯 Key Features

✅ **Patient Management**: Add, update, and view patient details, including medical history and contact information.  
✅ **Appointment Scheduling**: Schedule, track, and manage appointments with real-time availability.  
✅ **Treatment Records**: Maintain a history of treatments, including diagnoses, procedures, and prescriptions.  
✅ **Billing System**: Generate invoices, process payments, and manage outstanding balances.  
✅ **User Management**: Role-based access control for admins and staff to ensure security.  
✅ **Responsive Design**: Fully optimized for desktops, tablets, and mobile devices.

---

## 🛠️ Technologies Used

**Frontend:** HTML, CSS, JavaScript  
**Backend:** PHP (server-side logic)  
**Database:** MySQL (data storage)  
**Authentication:** Secure login system with role-based access  

---

## 🚀 Installation Guide

### 📋 Prerequisites
- **XAMPP** (or any local server environment)  
- **MySQL Database**

### 📥 Steps to Set Up

1️⃣ **Clone the Repository:**  
```bash
 git clone https://github.com/your-username/dental-management-system.git
```

2️⃣ **Move to XAMPP Directory:**  
Place the cloned project inside the `htdocs` directory of your XAMPP installation.

3️⃣ **Create the Database:**  
Open **phpMyAdmin** or **MySQL Workbench** and execute:
```sql
CREATE DATABASE dental_db;
```

4️⃣ **Import Database:**  
Import the provided SQL file into `dental_db` to load structure and sample data.

5️⃣ **Configure Database Connection:**  
Edit the `config.php` file in the root directory:
```php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'dental_db'); 
```

6️⃣ **Start XAMPP Server:**  
Open XAMPP Control Panel and start **Apache** & **MySQL**.

7️⃣ **Access the Application:**  
Open your browser and go to:  
🌍 `http://localhost/dental-management-system/`

---

## 🔑 User Credentials

👨‍⚕️ **Admin Login:**  
- **Username:** `admin`  
- **Password:** `adminpassword`

🧑‍⚕️ **Staff Login:**  
- **Username:** `staff`  
- **Password:** `staffpassword`

---

## 🤝 Contributing

🚀 Want to improve this project? Follow these steps:
1. **Fork the repository** 📌
2. **Create a new branch** (`feature-xyz`) 🌱
3. **Make changes & commit** (`git commit -m "Added new feature"`) 🛠️
4. **Push your changes** (`git push origin feature-xyz`) 🚀
5. **Submit a pull request** 🔄

---

## 📜 License

This project is licensed under the **MIT License** 📄. See the `LICENSE` file for details.

---

## 🌎 Connect with Me

📘 **[Facebook](https://www.facebook.com/eita.rohan)**  
📸 **[Instagram](https://www.instagram.com/rohan.rusho)**

