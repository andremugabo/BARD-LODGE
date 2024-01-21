CREATE DATABASE BARD&RODGE;

-- Employees Table
CREATE TABLE EMPLOYEES (
    E_ID INT PRIMARY KEY AUTO_INCREMENT,
    E_REGNUMBER VARCHAR(255) UNIQUE NOT NULL,
    FIRSTNAME VARCHAR(150),
    LASTNAME VARCHAR(150),
    E_ROLE VARCHAR(50),
    E_PHONE VARCHAR(20) UNIQUE,
    E_IDNUMBER VARCHAR(20) UNIQUE,
    E_STATUS ENUM('1', '0') DEFAULT '1'
 -- Add other relevant columns
);

-- salary Table
CREATE TABLE SALARY(
    SALARY_ID INT PRIMARY KEY AUTO_INCREMENT,
    E_ID INT NOT NULL,
    BASIC_SALARY FLOAT NOT NULL,
    ALLOWANCE FLOAT NOT NULL,
    SALARY_STATUS ENUM('1', '0') DEFAULT '1',
    FOREIGN KEY (E_ID) REFERENCES EMPLOYEES(E_ID)
);

-- Users Table
CREATE TABLE USERS (
    U_ID INT PRIMARY KEY AUTO_INCREMENT,
    E_ID INT,
    U_NAME VARCHAR(50) UNIQUE,
    U_PASSWORD VARCHAR(255),
    U_STATUS ENUM('1', '0') DEFAULT '1',
    FOREIGN KEY (E_ID) REFERENCES EMPLOYEES(E_ID)
 -- Add other relevant columns
);

CREATE TABLE SESSIONS (
    S_ID INT PRIMARY KEY AUTO_INCREMENT,
    S_REF VARCHAR(255) NOT NULL UNIQUE,
    DATEOCCURRED DATETIME DEFAULT CURRENT_TIMESTAMP(),
    S_STATUS ENUM('OPEN', 'CLOSE') DEFAULT 'OPEN'
);

-- Metric Table
CREATE TABLE METRIC (
    M_ID INT PRIMARY KEY AUTO_INCREMENT,
    E_ID INT NOT NULL,
    S_ID INT NULL,
    M_DESC VARCHAR(255),
    DATE_OCCURRED DATETIME DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (E_ID) REFERENCES EMPLOYEES(E_ID),
    FOREIGN KEY (S_ID) REFERENCES SESSIONS(S_ID)
 -- Add other relevant columns
);

-- Product_Type Table
CREATE TABLE PRODUCT_TYPE (
    PT_ID INT PRIMARY KEY AUTO_INCREMENT,
    PT_NAME VARCHAR(50) UNIQUE
 -- Add other relevant columns
);

-- Product_Category Table
CREATE TABLE PRODUCT_CATEGORY (
    PC_ID INT PRIMARY KEY AUTO_INCREMENT,
    PT_ID INT,
    PC_NAME VARCHAR(50) UNIQUE,
    FOREIGN KEY (PT_ID) REFERENCES PRODUCT_TYPE(PT_ID)
 -- Add other relevant columns
);

CREATE TABLE UNITY(
    UNITY_ID INT PRIMARY KEY AUTO_INCREMENT,
    UNITY_NAME VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE PRODUCTS (
    P_ID INT PRIMARY KEY AUTO_INCREMENT,
    P_CODE VARCHAR(255) NOT NULL,
    PC_ID INT,
    P_NAME VARCHAR(100) UNIQUE,
    PI_NAME VARCHAR(255) NULL UNIQUE,
    P_SIDEP ENUM('1', '0') DEFAULT '0',
    UNITY_ID INT NOT NULL,
    P_STATUS ENUM('1', '0') DEFAULT '1',
 -- Add other relevant columns
    FOREIGN KEY (PC_ID) REFERENCES PRODUCT_CATEGORY(PC_ID),
    FOREIGN KEY (UNITY_ID) REFERENCES UNITY(UNITY_ID)
);

-- Prices Table
CREATE TABLE PRICES (
    PRICE_ID INT PRIMARY KEY AUTO_INCREMENT,
    P_ID INT,
    SPRICE DECIMAL(10, 2),
    EPRICE DECIMAL(10, 2),
    PPRICE DECIMAL(10, 2),
    UNITY_ID INT NOT NULL,
    STARTDATE DATE DEFAULT CURRENT_TIMESTAMP(),
    ENDDATE DATE,
    PRICE_STATUS ENUM('1', '0') DEFAULT '1',
 -- Add other relevant columns
    FOREIGN KEY (P_ID) REFERENCES PRODUCTS(P_ID),
    FOREIGN KEY (UNITY_ID) REFERENCES UNITY(UNITY_ID)
);

CREATE TABLE PRODUCT_IMAGE(
    PI_ID INT PRIMARY KEY AUTO_INCREMENT,
    P_ID INT,
    PI_NAME VARCHAR(255) UNIQUE,
    FOREIGN KEY (P_ID) REFERENCES PRODUCTS(P_ID)
);

CREATE TABLE G_STOCK (
    GS_ID INT PRIMARY KEY AUTO_INCREMENT,
    S_ID INT NOT NULL,
    P_ID INT NOT NULL,
    P_QTY INT DEFAULT 0,
    GS_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
 -- Add other relevant columns
    FOREIGN KEY (P_ID) REFERENCES PRODUCTS(P_ID),
    FOREIGN KEY (S_ID) REFERENCES SESSIONS(S_ID)
);

CREATE TABLE PURCHASE (
    PURCHASE_ID INT PRIMARY KEY AUTO_INCREMENT,
    S_ID INT,
    P_ID INT,
    QTY_PUR INT,
 -- Add other relevant columns
    FOREIGN KEY (P_ID) REFERENCES PRODUCTS(P_ID),
    FOREIGN KEY (S_ID) REFERENCES SESSIONS(S_ID)
);

CREATE TABLE S_STOCK (
    SS_ID INT PRIMARY KEY AUTO_INCREMENT,
    S_ID INT NOT NULL,
    P_ID INT NOT NULL,
    P_QTY INT DEFAULT 0,
    SS_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
 -- Add other relevant columns
    FOREIGN KEY (P_ID) REFERENCES PRODUCTS(P_ID),
    FOREIGN KEY (S_ID) REFERENCES SESSIONS(S_ID)
);

CREATE TABLE RECEIVED (
    RECEIVED_ID INT PRIMARY KEY AUTO_INCREMENT,
    S_ID INT,
    P_ID INT,
    QTY_REC INT,
 -- Add other relevant columns
    FOREIGN KEY (P_ID) REFERENCES PRODUCTS(P_ID),
    FOREIGN KEY (S_ID) REFERENCES SESSIONS(S_ID)
);

CREATE TABLE ORDERS (
    O_ID INT PRIMARY KEY AUTO_INCREMENT,
    E_ID INT,
    S_ID INT,
    O_DATE DATETIME DEFAULT CURRENT_TIMESTAMP(),
    O_TABLE INT DEFAULT 0,
    O_AMOUNT INT DEFAULT 0,
    O_PAYMENT ENUM('NOT PAID', 'PAID') DEFAULT 'NOT PAID',
    O_STATUS ENUM('1', '0') DEFAULT '1',
 -- Add other relevant columns
    FOREIGN KEY (E_ID) REFERENCES EMPLOYEES(E_ID),
    FOREIGN KEY (S_ID) REFERENCES SESSIONS(S_ID)
);

CREATE TABLE ORDER_DETAILS (
    OD_ID INT PRIMARY KEY,
    O_ID INT,
    O_REF VARCHAR(255) NOT NULL UNIQUE,
    P_ID INT,
    PT_ID INT,
    P_QTY INT,
    UNITY_ID INT,
    P_PRICE INT,
    S_PRICE INT,
    OD_TIME TIME DEFAULT CURRENT_TIMESTAMP(),
 -- Add other relevant columns
    FOREIGN KEY (O_ID) REFERENCES ORDERS(O_ID),
    FOREIGN KEY (P_ID) REFERENCES PRODUCTS(P_ID),
    FOREIGN KEY (PT_ID) REFERENCES PRODUCT_TYPE(PT_ID),
    FOREIGN KEY (UNITY_ID) REFERENCES UNITY(UNITY_ID)
);

CREATE TABLE VOIDED_ORDER (
    V_ID INT PRIMARY KEY,
    O_ID INT,
    E_ID INT,
    P_ID INT,
    O_QTY INT,
    UNITY_ID INT,
    V_REASON VARCHAR(255),
 -- Add other relevant columns
    FOREIGN KEY (O_ID) REFERENCES ORDERS(O_ID),
    FOREIGN KEY (E_ID) REFERENCES EMPLOYEES(E_ID),
    FOREIGN KEY (P_ID) REFERENCES PRODUCTS(P_ID),
    FOREIGN KEY (UNITY_ID) REFERENCES UNITY(UNITY_ID)
);

# -----------------------------------------------------------------------------

INSERT INTO `PRODUCT_CATEGORY`(
    `PT_ID`,
    `PC_NAME`
) VALUES (
    1,
    'SOFT & ENERGY DRINKS'
);

INSERT INTO `PRODUCT_CATEGORY`(
    `PT_ID`,
    `PC_NAME`
) VALUES (
    1,
    'HOT DRINKS'
);

INSERT INTO `PRODUCT_CATEGORY`(
    `PT_ID`,
    `PC_NAME`
) VALUES (
    1,
    'WINES & MIXED DRINKS'
);

INSERT INTO `PRODUCT_CATEGORY`(
    `PT_ID`,
    `PC_NAME`
) VALUES (
    1,
    'LIQUORS'
);

INSERT INTO `PRODUCT_CATEGORY`(
    `PT_ID`,
    `PC_NAME`
) VALUES (
    1,
    'BEERS'
);

#--------------------------------------------------

INSERT INTO `PRODUCT_CATEGORY`(
    `PT_ID`,
    `PC_NAME`
) VALUES (
    2,
    'SOUPS - POTAGES'
);

INSERT INTO `PRODUCT_CATEGORY`(
    `PT_ID`,
    `PC_NAME`
) VALUES (
    2,
    'OMOLETTES'
);

INSERT INTO `PRODUCT_CATEGORY`(
    `PT_ID`,
    `PC_NAME`
) VALUES (
    2,
    'SALADS - SALADES'
);

INSERT INTO `PRODUCT_CATEGORY`(
    `PT_ID`,
    `PC_NAME`
) VALUES (
    2,
    'SIDE DISHES - ACCOMPAGNEMENTS'
);

INSERT INTO `PRODUCT_CATEGORY`(
    `PT_ID`,
    `PC_NAME`
) VALUES (
    2,
    'SNACKS – AMUSE-BOUCHE'
);

INSERT INTO `PRODUCT_CATEGORY`(
    `PT_ID`,
    `PC_NAME`
) VALUES (
    2,
    'HOT DISHES'
);

INSERT INTO `PRODUCT_CATEGORY`(
    `PT_ID`,
    `PC_NAME`
) VALUES (
    2,
    'FRESH FROM THE GRILL - GRILLADES'
);

# --------------------------------------------------------------------------------------
INSERT INTO `UNITY`(
`UNITY_NAME`
) VALUES (
'NONE'
);

INSERT INTO `UNITY`(
    `UNITY_NAME`
) VALUES (
    'Btl'
);

INSERT INTO `UNITY`(
    `UNITY_NAME`
) VALUES (
    'Glss'
);

INSERT INTO `UNITY`(
    `UNITY_NAME`
) VALUES (
    'Can'
);

INSERT INTO `UNITY`(
    `UNITY_NAME`
) VALUES (
    'Carton'
);

INSERT INTO `UNITY`(
    `UNITY_NAME`
) VALUES (
    '200ml'
);

INSERT INTO `UNITY`(
    `UNITY_NAME`
) VALUES (
    'Shot'
);

INSERT INTO `UNITY`(
    `UNITY_NAME`
) VALUES (
    '1L Btl'
);

INSERT INTO `UNITY`(
    `UNITY_NAME`
) VALUES (
    '200ml/Btl'
);

INSERT INTO `UNITY`(
    `UNITY_NAME`
) VALUES (
    'Shot/200ml/Btl'
);

INSERT INTO `UNITY`(
    `UNITY_NAME`
) VALUES (
    'Shot/Btl'
);

INSERT INTO `UNITY`(
    `UNITY_NAME`
) VALUES (
    '200ml/Btl/Carton'
);