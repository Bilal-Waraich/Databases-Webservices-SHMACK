CREATE TABLE CostCenter (
    CostCenter_ID INT PRIMARY KEY AUTO_INCREMENT,
    CostCenter_Name VARCHAR(255),
    Budget DECIMAL(15, 2)
);

CREATE TABLE Subsidiaries (
    Subsidiary_ID INT PRIMARY KEY AUTO_INCREMENT,
    Subsidiary_Name VARCHAR(255),
    Location VARCHAR(255),  
    Workforce_Size INT
);

CREATE TABLE Leases (
    Lease_ID INT PRIMARY KEY AUTO_INCREMENT,
    Lease_start_date DATE,
    Lease_termination_date DATE,
    Yearly_Cost DECIMAL(15, 2),
    Monthly_Cost DECIMAL(15, 2),
    Terminated_Lease BOOLEAN,
    CostCenter_ID INT, 
    Subsidiary_ID INT,  
    FOREIGN KEY (CostCenter_ID) REFERENCES CostCenter(CostCenter_ID),
    FOREIGN KEY (Subsidiary_ID) REFERENCES Subsidiaries(Subsidiary_ID)
);

CREATE TABLE Users (
    AD_ID INT PRIMARY KEY AUTO_INCREMENT,
    Email VARCHAR(255),
    Name VARCHAR(255),
    Address VARCHAR(255),
    Role VARCHAR(50),
    PermissionsRights VARCHAR(255),
    CostCenter_ID INT, 
    Subsidiary_ID INT,  
    FOREIGN KEY (CostCenter_ID) REFERENCES CostCenter(CostCenter_ID),
    FOREIGN KEY (Subsidiary_ID) REFERENCES Subsidiaries(Subsidiary_ID)
);

CREATE TABLE Vehicle (
    Vehicle_ID INT PRIMARY KEY AUTO_INCREMENT,
    Vehicle_model VARCHAR(255),
    Vehicle_name VARCHAR(255),
    Lease_ID INT NOT NULL UNIQUE, 
    FOREIGN KEY (Lease_ID) REFERENCES Leases(Lease_ID)
);

CREATE TABLE Apartment (
    Apartment_ID INT PRIMARY KEY AUTO_INCREMENT,
    Apartment_name VARCHAR(255),
    Apartment_location VARCHAR(255),
    Lease_ID INT NOT NULL UNIQUE, 
    FOREIGN KEY (Lease_ID) REFERENCES Leases(Lease_ID)
);

CREATE TABLE Office (
    Office_ID INT PRIMARY KEY AUTO_INCREMENT,
    Office_name VARCHAR(255),
    Office_location VARCHAR(255),
    Lease_ID INT NOT NULL UNIQUE, 
    FOREIGN KEY (Lease_ID) REFERENCES Leases(Lease_ID)
);

CREATE TABLE Land (
    Land_ID INT PRIMARY KEY AUTO_INCREMENT,
    Land_name VARCHAR(255),
    Land_Size DECIMAL(10, 2),
    Lease_ID INT NOT NULL UNIQUE, 
    FOREIGN KEY (Lease_ID) REFERENCES Leases(Lease_ID)
);


-- TEST DATA:

INSERT INTO Leases (Lease_ID, Lease_start_date, Lease_termination_date, Yearly_Cost, Monthly_Cost, Terminated_Lease, CostCenter_ID, Subsidiary_ID) VALUES
(5001, '2022-01-31', '2023-01-31', 12000, 1000, FALSE, 8001, 3001),
(5002, '2022-02-28', '2023-02-28', 15000, 1250, TRUE, 8002, 3003),
(5003, '2022-03-31', '2023-03-31', 20000, 1666.67, FALSE, 8003, 3010),
(5004, '2022-04-30', '2023-04-30', 18000, 1500, TRUE, 8004, 3005),
(5005, '2022-05-31', '2023-05-31', 17000, 1416.67, FALSE, 8005, 3004),
(5006, '2022-06-30', '2023-06-30', 19000, 1583.33, FALSE, 8006, 3007),
(5007, '2022-07-31', '2023-07-31', 22000, 1833.33, TRUE, 8001, 3002),
(5008, '2022-08-31', '2023-08-31', 16000, 1333.33, FALSE, 8002, 3003),
(5009, '2022-09-30', '2023-09-30', 21000, 1750, TRUE, 8003, 3011),
(5010, '2022-10-31', '2023-10-31', 23000, 1916.67, FALSE, 8004, 3006),
(5011, '2022-11-30', '2023-11-30', 25000, 2083.33, FALSE, 8005, 3009),
(5012, '2022-12-31', '2023-12-31', 24000, 2000, FALSE, 8006, 3008),
(5013, '2023-01-31', '2024-01-31', 13000, 1083.33, TRUE, 8001, 3001),
(5014, '2023-02-28', '2024-02-28', 26000, 2166.67, FALSE, 8002, 3015),
(5015, '2023-03-31', '2024-03-31', 18000, 1500, FALSE, 8003, 3012),
(5016, '2023-04-30', '2024-04-30', 24000, 2000, TRUE, 8004, 3005),
(5017, '2023-05-31', '2024-05-31', 15000, 1250, FALSE, 8005, 3009),
(5018, '2023-06-30', '2024-06-30', 17500, 1458.33, FALSE, 8006, 3007),
(5019, '2023-07-31', '2024-07-31', 20000, 1666.67, TRUE, 8001, 3014),
(5020, '2023-08-31', '2024-08-31', 22000, 1833.33, FALSE, 8002, 3015),
(5021, '2023-09-30', '2024-09-30', 24000, 2000, TRUE, 8003, 3013);


INSERT INTO CostCenter (CostCenter_ID, CostCenter_Name, Budget) VALUES
(8001, 'Europe', 50000),
(8002, 'Latin America', 60000),
(8003, 'APAC', 45000),
(8004, 'UK & Ireland', 70000),
(8005, 'North America', 65000),
(8006, 'Africa', 55000);


INSERT INTO Subsidiaries (Subsidiary_ID, Subsidiary_Name, Location, Workforce_Size) VALUES
(3001, 'CrispBlitz', 'Hamburg', 100),
(3002, 'ChocoLuxe', 'Barcelona', 200),
(3003, 'ZingPops', 'Quito', 150),
(3004, 'TwistMunch', 'Kingston', 300),
(3005, 'BiteBurst', 'London', 250),
(3006, 'NuttyCrave', 'Dublin', 220),
(3007, 'SugarWhirl', 'Capetown', 180),
(3008, 'CheeseCrisp', 'Casablanca', 260),
(3009, 'DipDunkers', 'New York', 230),
(3010, 'CrunchRolls', 'Tokyo', 270),
(3011, 'CinnamonBalls', 'Delhi', 120),
(3012, 'ChickWrap', 'Dhaka', 420),
(3013, 'CinnamonBalls', 'Singapore', 220),
(3014, 'KottonKandy', 'Zürich', 100),
(3015, 'MintyShake', 'Bogota', 269);

INSERT INTO Users (AD_ID, Email, Name, Address, Role, PermissionsRights, CostCenter_ID, Subsidiary_ID) VALUES
(1001, 'ajohnson@shnackspark.com', 'Alice Johnson', 'Schönebecker Straße 8', 'Manager', 'Read, Write', NULL, 3001),
(1002, 'palvarez@shnackspark.com', 'Paula Alvarez', 'Campus Ring 2', 'Analyst', 'Read', 8002, 3002),
(1003, 'naltuntas@shnackspark.com', 'Nehir Altuntas', 'Knoops Straße 3', 'Developer', 'Read, Write, Execute', NULL, 3003),
(1004, 'gsylvester@shnackspark.com', 'Giovanni Sylvester', 'Hamburger Straße 4', 'HR', 'Read', 8004, 3004),
(1005, 'bwaraich@shnackspark.com', 'Bilal Waraich', 'Gerhard-Rohlfs Straße 44', 'Admin', 'Read, Write', 8005, 3001),
(1006, 'tstark@shnackspark.com', 'Tony Stark', 'Oslebshausen 4', 'Sales', 'Read', NULL, 3002),
(1007, 'srogers@shnackspark.com', 'Steve Rogers', 'Taunusstraße 7', 'Support', 'Read, Write', NULL, 3003),
(1008, 'sjobs@shnackspark.com', 'Steve Jobs', 'Birkenhof 77', 'Engineer', 'Read', 8003, 3005),
(1009, 'gtoledo@shnackspark.com', 'Gabriel Toledo', 'College Ring 4', 'Consultant', 'Write', 8004, 3001),
(1010, 'aschwarzenegger@shnackspark.com', 'Arnold Schwarzenegger', 'Vegesacker Straße 1', 'Accountant', 'Read, Execute', 8005, 3002);


INSERT INTO Vehicle (Vehicle_ID, Vehicle_model, Vehicle_name, Lease_ID) VALUES
(6001, 'B 1234', 'Toyota Corolla', 5001),
(6002, 'M 5678', 'Range Rover Sport', 5002),
(6003, 'HH 2345', 'Ferrari Laferrari', 5003),
(6004, 'D 7890', 'Nissan Skyline', 5004),
(6005, 'F 3456', 'Ford F150', 5005),
(6006, 'S 8901', 'Nissan GTR', 5006),
(6007, 'K 4567', 'Lamborghini SVJ', 5013),
(6008, 'B 5678', 'Mitsubishi Pajero', 5014);

INSERT INTO Apartment (Apartment_ID, Apartment_name, Apartment_location, Lease_ID) VALUES
(7001, 'Greenfield Apartment', 'Park Lane 1', 5007),
(7002, 'Sunrise Apartment', 'Ocean View 2', 5008),
(7003, 'Maple Apartment', 'Elm Street 3', 5009),
(7004, 'Cedar Apartment', 'Pine Avenue 4', 5010),
(7005, 'Oakwood Apartment', 'Lakeside Drive 5', 5011),
(7006, 'Magnolia Apartment', 'Hillcrest Road 6', 5015);

INSERT INTO Office (Office_ID, Office_name, Office_location, Lease_ID) VALUES
(9001, 'Downtown Office', 'Broadway 10', 5016),
(9002, 'Harbor Office', 'Pier Street 11', 5017),
(9003, 'Uptown Office', 'Main Street 12', 5018),
(9004, 'Midtown Office', 'Center Plaza 13', 5020),
(9005, 'Business Hub Office', 'Financial Street 14', 5012);

INSERT INTO Land (Land_ID, Land_name, Land_Size, Lease_ID) VALUES
(10001, 'Sunnyfield Estate', 500.75, 5019),
(10002, 'Green Acre Park', 1500.50, 5021);


-- Queries

--Query 1: Find the Total Yearly Cost of Leases Managed by Each Cost Center

SELECT 
    c.CostCenter_Name, 
    SUM(l.Yearly_Cost) AS Total_Yearly_Cost
FROM 
    Leases l
JOIN 
    CostCenter c ON l.CostCenter_ID = c.CostCenter_ID
WHERE 
    l.Terminated_Lease = FALSE
GROUP BY 
    c.CostCenter_Name;


--Query 2: List All Users Along with Their Associated Subsidiary and Cost Center Information

SELECT 
    u.Name AS User_Name, 
    u.Email, 
    s.Subsidiary_Name, 
    c.CostCenter_Name
FROM 
    Users u
JOIN 
    Subsidiaries s ON u.Subsidiary_ID = s.Subsidiary_ID
JOIN 
    CostCenter c ON u.CostCenter_ID = c.CostCenter_ID;


--Query 3: Identify Subsidiaries with More Than 200 Employees and Their Associated Leases

SELECT 
    s.Subsidiary_Name,
    l.Lease_ID, 
    s.Workforce_Size, 
    l.Lease_start_date, 
    l.Lease_termination_date, 
    l.Yearly_Cost
FROM 
    Subsidiaries s
JOIN 
    Leases l ON s.Subsidiary_ID = l.Subsidiary_ID
WHERE 
    s.Workforce_Size > 200;

--Query 4: Calculate the Average Monthly Cost of All Active Leases

SELECT 
    cc.CostCenter_Name,
    COUNT(l.Lease_ID) AS Lease_Count,
    SUM(l.Yearly_Cost) AS Total_Yearly_Cost
FROM 
    Leases l
JOIN 
    Subsidiaries s ON l.Subsidiary_ID = s.Subsidiary_ID
JOIN 
    CostCenter cc ON l.CostCenter_ID = cc.CostCenter_ID
WHERE 
    l.Terminated_Lease = FALSE
GROUP BY 
    cc.CostCenter_Name;



--Query 5: Find All Offices Located in a Specific Cost Center

SELECT 
    o.Office_Name, 
    o.Office_Location, 
    cc.CostCenter_Name
FROM 
    Office o
JOIN 
    Leases l ON o.Lease_ID = l.Lease_ID
JOIN 
    CostCenter cc ON l.CostCenter_ID = cc.CostCenter_ID
WHERE 
    cc.CostCenter_Name = 'Africa'; 


--Query 6: List All Leases Associated with Vehicles and Their Monthly Costs

SELECT
v.Vehicle_model,
v.Vehicle_ID,
v.Vehicle_name,
l.Lease_ID,
l.Monthly_Cost
FROM
Vehicle v
JOIN
Leases l ON v.Lease_ID = l.Lease_ID;


--Query 7: Find Users with 'Manager' Role and Their Permissions Grouped by Subsidiary

SELECT 
    s.Subsidiary_Name, 
    u.Name AS Manager_Name, 
    u.PermissionsRights
FROM 
    Users u
JOIN 
    Subsidiaries s ON u.Subsidiary_ID = s.Subsidiary_ID
WHERE 
    u.Role = 'Manager'
GROUP BY 
    s.Subsidiary_Name, u.Name, u.PermissionsRights;


--Query 8: Find the Maximum Budget Allocated to Any Cost Center

SELECT 
    CostCenter_Name, 
    Budget
FROM 
    CostCenter;


--Query 9: Identify the terminated leases and their termination date.

SELECT 
    l.Lease_ID, 
    l.Lease_termination_date
FROM 
    Leases l
WHERE
    l.Terminated_Lease = TRUE

GROUP BY
    l.Lease_ID, l.Lease_termination_date;


--Query 10: Find Leases with a Monthly Cost Higher Than the Average

SELECT 
    Lease_ID, 
    Monthly_Cost
FROM 
    Leases
WHERE 
    Monthly_Cost > (SELECT AVG(Monthly_Cost) FROM Leases);


--Query 11: Find Leases for Apartments and Group by the cost of their leases, from higher to lower.

SELECT 
    a.Apartment_name,
    a.Apartment_location,
    l.Lease_ID, 
    l.Yearly_Cost
FROM 
    Apartment a
JOIN 
    Leases l ON a.Lease_ID = l.Lease_ID
GROUP BY 
    a.Apartment_name,a.Apartment_location, l.Lease_ID, l.Yearly_Cost
ORDER BY 
    l.Yearly_Cost DESC;


--Query 12: Find Total Workforce Size by Subsidiary, Grouped by their Location and ID

SELECT 
    s.Location, 
    s.Subsidiary_ID,
    SUM(s.Workforce_Size) AS Total_Workforce
FROM 
    Subsidiaries s
GROUP BY 
    s.Location
HAVING 
    SUM(s.Workforce_Size) > 0;  
