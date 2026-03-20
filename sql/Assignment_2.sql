
CREATE TABLE Leases (
    Lease_ID INT PRIMARY KEY,
    Lease_start_date DATE,
    Lease_termination_date DATE,
    Yearly_Cost DECIMAL(15, 2),
    Monthly_Cost DECIMAL(15, 2),
    Terminated_Lease BOOLEAN
);


CREATE TABLE CostCenter (
    CostCenter_ID INT PRIMARY KEY,
    CostCenter_Name VARCHAR(255),
    Budget DECIMAL(15, 2),
    Lease_ID INT, 
    FOREIGN KEY (Lease_ID) REFERENCES Leases(Lease_ID)
);


CREATE TABLE Subsidiaries (
    Subsidiary_ID INT PRIMARY KEY,
    Subsidiary_Name VARCHAR(255),
    Location VARCHAR(255),  
    Workforce_Size INT,
    Lease_ID INT, 
    FOREIGN KEY (Lease_ID) REFERENCES Leases(Lease_ID)
);



CREATE TABLE Users (
    AD_ID INT PRIMARY KEY,
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
    Vehicle_ID INT PRIMARY KEY,
    Vehicle_model VARCHAR(255),
    Vehicle_name VARCHAR(255),
    Lease_ID INT, 
    FOREIGN KEY (Lease_ID) REFERENCES Leases(Lease_ID)
);

CREATE TABLE Apartment (
    Apartment_ID INT PRIMARY KEY,
    Apartment_name VARCHAR(255),
    Apartment_location VARCHAR(255),
    Lease_ID INT, 
    FOREIGN KEY (Lease_ID) REFERENCES Leases(Lease_ID)
);

CREATE TABLE Office (
    Office_ID INT PRIMARY KEY,
    Office_name VARCHAR(255),
    Office_location VARCHAR(255),
    Lease_ID INT, 
    FOREIGN KEY (Lease_ID) REFERENCES Leases(Lease_ID)
);

CREATE TABLE Land (
    Land_ID INT PRIMARY KEY,
    Land_name VARCHAR(255),
    Land_Size DECIMAL(10, 2),
    Lease_ID INT, 
    FOREIGN KEY (Lease_ID) REFERENCES Leases(Lease_ID)
);
