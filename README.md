# 🎱 BARD-LODGE

**BARD-LODGE** is a comprehensive PHP-based lodge management system designed to streamline operations for hospitality businesses. It provides functionalities for room booking, bar and billiard services, product inventory, employee tracking, expense management, order processing, and reporting.

---

## 📁 Project Structure

The project is organized using a modular MVC-style architecture. Below is an overview of the main directories and key components:

```
BARD-LODGE/
├── API/
│   ├── CONTROLLER/      # Handles HTTP requests and business logic
│   │   ├── EmployeesController.php
│   │   ├── OrdersController.php
│   │   ├── SessionsController.php
│   │   ├── ExpenseController.php
│   │   ├── RoomsController.php
│   │   ├── BilliardController.php
│   │   ├── ProductsController.php
│   │   ├── InventoryController.php
│   │   ├── SalesController.php
│   │   └── NotificationsController.php
│   │
│   ├── DAO/             # Data Access Objects (CRUD operations)
│   │   ├── EmployeesDao.php
│   │   ├── OrdersDao.php
│   │   ├── SessionsDao.php
│   │   ├── ExpenseDao.php
│   │   ├── RoomsDao.php
│   │   ├── BilliardDao.php
│   │   ├── ProductsDao.php
│   │   ├── InventoryDao.php
│   │   ├── SalesDao.php
│   │   ├── IncomeDetailsDao.php
│   │   ├── OrderDetailsDao.php
│   │   ├── SpecialDetailsDao.php
│   │   └── NotificationsDao.php
│   │
│   └── MODELS/          # Domain models representing business entities
│       ├── Employee.php
│       ├── Order.php
│       ├── Session.php
│       ├── Expense.php
│       ├── Room.php
│       ├── Billiard.php
│       ├── Product.php
│       ├── Inventory.php
│       ├── Sale.php
│       ├── IncomeDetail.php
│       ├── OrderDetail.php
│       ├── SpecialDetail.php
│       └── Notification.php
│
├── ASSETS/              # Frontend resources (CSS, JavaScript, images)
├── INCLUDES/            # Common PHP scripts (e.g., configuration, headers, footers)
├── PAGES/               # Main application views/pages (dashboard, orders, reports, etc.)
├── index.php            # Entry point of the application
└── README.md            # Project documentation 
```

---

## 🚀 Features

- **Room and Billiard Management:** Book and manage rooms and Bar services.
- **Employee Tracking:** Manage staff profiles and permissions.
- **Expense Management:** Record and monitor operational expenses.
- **Product & Inventory Management:** Track products, inventory levels, and supplies.
- **Order Processing:** Handle customer orders and session tracking.
- **Reporting:** Generate sales, stock, and income reports.
- **Notifications:** Automated alerts for orders, expenses, and other key events.

---

## 🔧 Components Explained

### **Controllers (Business Logic Layer)**
- **EmployeesController.php:** Manages requests related to employee data (creation, updates, deletion, and retrieval).
- **OrdersController.php:** Handles customer order processing and tracking.
- **SessionsController.php:** Manages session details for room and billiard bookings.
- **ExpenseController.php:** Oversees expense logging and management.
- **RoomsController.php:** Handles operations related to room availability and bookings.
- **BilliardController.php:** Manages billiard services and session bookings.
- **ProductsController.php:** Oversees product listings and updates.
- **InventoryController.php:** Manages stock levels and inventory adjustments.
- **SalesController.php:** Processes and reports on sales transactions.
- **NotificationsController.php:** Handles automated notifications and alerts for various system events.

### **DAOs (Data Access Layer)**
- **EmployeesDao.php:** Interfaces with the database for employee-related operations.
- **OrdersDao.php:** Provides CRUD operations for order management.
- **SessionsDao.php:** Manages data storage and retrieval for booking sessions.
- **ExpenseDao.php:** Handles database operations for expense records.
- **RoomsDao.php:** Provides access methods for room data.
- **BilliardDao.php:** Manages billiard service data interactions.
- **ProductsDao.php:** Interfaces for product-related database operations.
- **InventoryDao.php:** Handles inventory CRUD operations.
- **SalesDao.php:** Manages database interactions for sales data.
- **IncomeDetailsDao.php:** Records and retrieves income details.
- **OrderDetailsDao.php:** Manages detailed information of customer orders.
- **SpecialDetailsDao.php:** Handles custom service details and specialized orders.
- **NotificationsDao.php:** Interfaces for saving and retrieving notification data.

### **Models (Data Representation)**
- **Employee.php:** Defines the Employee object and its properties (e.g., name, role, contact).
- **Order.php:** Represents an Order with attributes such as order ID, customer details, and order items.
- **Session.php:** Models a session for room or billiard service, including timing and booking details.
- **Expense.php:** Defines expense records, including category, amount, and date.
- **Room.php:** Represents room details and availability.
- **Billiard.php:** Models details related to billiard services.
- **Product.php:** Defines product attributes for inventory management.
- **Inventory.php:** Represents inventory details such as stock levels and restocking information.
- **Sale.php:** Models a sale transaction with relevant sales data.
- **IncomeDetail.php:** Represents detailed records of income.
- **OrderDetail.php:** Provides line-item details within an order.
- **SpecialDetail.php:** Models any special or additional service details.
- **Notification.php:** Represents notification messages and statuses.

---

## 🛠 How to Run

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/andremugabo/BARD-LODGE.git
   ```

2. **Local Server Setup:**
   - Use XAMPP, WAMP, Laragon, or any PHP development environment.
   - Place the project folder in the server’s `htdocs` directory (or equivalent).

3. **Database Configuration:**
   - Import the provided SQL file  to set up your MySQL database.
   - Update your database connection details in the configuration file located in the `/INCLUDES` directory.

4. **Run the Application:**
   - Navigate to the project in your web browser:
     ```
     http://localhost/BARD-LODGE/index.php
     ```

---

## ✅ Future Improvements

- **REST API Integration:** Develop a RESTful API for mobile and third-party integration.
- **Authentication:** Implement secure login and role-based access control.
- **UI Enhancements:** Refine the frontend using frameworks like Bootstrap or Vue.js.
- **Testing:** Add unit tests and integration tests for increased reliability.
- **Documentation:** Expand inline documentation and developer guides for easier onboarding.

---

## 👤 Author

**Andre Mugabo**  
Feel free to fork and contribute to this project. Contributions and feedback are welcome!

