-- Employees Table
CREATE TABLE EMPLOYEES (
    EMPLOYEEID INT PRIMARY KEY,
    FIRSTNAME VARCHAR(50),
    LASTNAME VARCHAR(50),
    POSITION VARCHAR(50),
 -- Add other relevant columns
);

-- Users Table
CREATE TABLE USERS (
    USERID INT PRIMARY KEY,
    EMPLOYEEID INT,
    FOREIGN KEY (EMPLOYEEID) REFERENCES EMPLOYEES(EMPLOYEEID),
 -- Add other relevant columns
);

-- Metric Table
CREATE TABLE METRIC (
    METRICID INT PRIMARY KEY,
    DESCRIPTION VARCHAR(255),
    DATEOCCURRED DATE,
 -- Add other relevant columns
);

-- Product_Type Table
CREATE TABLE PRODUCT_TYPE (
    PRODUCTTYPEID INT PRIMARY KEY,
    TYPENAME VARCHAR(50),
 -- Add other relevant columns
);

-- Product_Category Table
CREATE TABLE PRODUCT_CATEGORY (
    CATEGORYID INT PRIMARY KEY,
    PRODUCTTYPEID INT,
    CATEGORYNAME VARCHAR(50),
    FOREIGN KEY (PRODUCTTYPEID) REFERENCES PRODUCT_TYPE(PRODUCTTYPEID),
 -- Add other relevant columns
);

-- Products Table
CREATE TABLE PRODUCTS (
    PRODUCTID INT PRIMARY KEY,
    PRODUCTTYPEID INT,
    CATEGORYID INT,
    PRODUCTNAME VARCHAR(100),
 -- Add other relevant columns
    FOREIGN KEY (PRODUCTTYPEID) REFERENCES PRODUCT_TYPE(PRODUCTTYPEID),
    FOREIGN KEY (CATEGORYID) REFERENCES PRODUCT_CATEGORY(CATEGORYID)
);

-- Prices Table
CREATE TABLE PRICES (
    PRICEID INT PRIMARY KEY,
    PRODUCTID INT,
    PRICE DECIMAL(10, 2),
    STARTDATE DATE,
    ENDDATE DATE,
 -- Add other relevant columns
    FOREIGN KEY (PRODUCTID) REFERENCES PRODUCTS(PRODUCTID)
);

-- Sessions Table
CREATE TABLE SESSIONS (
    SESSIONID INT PRIMARY KEY,
    ACTIONDESCRIPTION VARCHAR(255),
    DATEOCCURRED DATETIME,
    EMPLOYEEID INT,
 -- Add other relevant columns
    FOREIGN KEY (EMPLOYEEID) REFERENCES EMPLOYEES(EMPLOYEEID)
);

-- General_Stock Table
CREATE TABLE GENERAL_STOCK (
    STOCKID INT PRIMARY KEY,
    PRODUCTID INT,
    QUANTITY INT,
 -- Add other relevant columns
    FOREIGN KEY (PRODUCTID) REFERENCES PRODUCTS(PRODUCTID)
);

-- Sales_Stock Table
CREATE TABLE SALES_STOCK (
    SALESSTOCKID INT PRIMARY KEY,
    PRODUCTID INT,
    QUANTITYSOLD INT,
 -- Add other relevant columns
    FOREIGN KEY (PRODUCTID) REFERENCES PRODUCTS(PRODUCTID)
);

-- Purchase Table
CREATE TABLE PURCHASE (
    PURCHASEID INT PRIMARY KEY,
    STOCKID INT,
    QUANTITYPURCHASED INT,
    PURCHASEDATE DATE,
 -- Add other relevant columns
    FOREIGN KEY (STOCKID) REFERENCES GENERAL_STOCK(STOCKID)
);

-- Orders Table
CREATE TABLE ORDERS (
    ORDERID INT PRIMARY KEY,
    EMPLOYEEID INT,
    SESSIONID INT,
    ORDERDATE DATE,
 -- Add other relevant columns
    FOREIGN KEY (EMPLOYEEID) REFERENCES EMPLOYEES(EMPLOYEEID),
    FOREIGN KEY (SESSIONID) REFERENCES SESSIONS(SESSIONID)
);

-- Order_Details Table
CREATE TABLE ORDER_DETAILS (
    ORDERDETAILID INT PRIMARY KEY,
    ORDERID INT,
    PRODUCTID INT,
    QUANTITYORDERED INT,
 -- Add other relevant columns
    FOREIGN KEY (ORDERID) REFERENCES ORDERS(ORDERID),
    FOREIGN KEY (PRODUCTID) REFERENCES PRODUCTS(PRODUCTID)
);

-- Voided_Order Table
CREATE TABLE VOIDED_ORDER (
    VOIDEDORDERID INT PRIMARY KEY,
    ORDERDETAILID INT,
    VOIDREASON VARCHAR(255),
 -- Add other relevant columns
    FOREIGN KEY (ORDERDETAILID) REFERENCES ORDER_DETAILS(ORDERDETAILID)
);

-- Closing_Stock Table
CREATE TABLE CLOSING_STOCK (
    CLOSINGSTOCKID INT PRIMARY KEY,
    PRODUCTID INT,
    QUANTITYCLOSED INT,
    CLOSINGDATE DATE,
 -- Add other relevant columns
    FOREIGN KEY (PRODUCTID) REFERENCES PRODUCTS(PRODUCTID)
);

-- Closing_Sales_Stock Table
CREATE TABLE CLOSING_SALES_STOCK (
    CLOSINGSALESSTOCKID INT PRIMARY KEY,
    PRODUCTID INT,
    QUANTITYSOLDCLOSED INT,
    CLOSINGDATE DATE,
 -- Add other relevant columns
    FOREIGN KEY (PRODUCTID) REFERENCES PRODUCTS(PRODUCTID)
);

-- Expenses Table
CREATE TABLE EXPENSES (
    EXPENSEID INT PRIMARY KEY,
    S_ID INT DESCRIPTION VARCHAR(255),
    AMOUNT DECIMAL(10, 2),
    EXPENSEDATE DATE
 -- Add other relevant columns
);