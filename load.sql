LOAD DATA LOCAL INFILE 'restaurant_data.csv'
INTO TABLE Restaurant
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(Name, Address)
SET RestaurantID = NULL;

LOAD DATA LOCAL INFILE 'customers_data.csv'
INTO TABLE Customer
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(Fname, Lname)
SET CustomerID = NULL;

LOAD DATA LOCAL INFILE 'chef_data.csv'
INTO TABLE Chef
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(RestaurantID, WorkStartDate, Firstname, LastName)
SET ChefID = NULL;

LOAD DATA LOCAL INFILE 'orders_data.csv'
INTO TABLE Orders
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(OrderDate, CustomerID)
SET OrderNo = NULL;

LOAD DATA LOCAL INFILE 'foodinfo_data.csv'
INTO TABLE FoodInfo
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(ItemName, Description, Price);

LOAD DATA LOCAL INFILE 'fooditem_data.csv'
INTO TABLE FoodItem
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(ItemName, OrderNo, Price);

LOAD DATA LOCAL INFILE 'bill_data.csv'
INTO TABLE Bill
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(RestaurantID, CustomerID, OrderNo)
SET BillNo = NULL;

LOAD DATA LOCAL INFILE 'prepares_data.csv'
INTO TABLE Prepares
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(ChefID, OrderNo);

LOAD DATA LOCAL INFILE 'customer_email_data.csv'
INTO TABLE CustomerEmail
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(CustomerID, Email);

LOAD DATA LOCAL INFILE 'customer_phonenum_data.csv'
INTO TABLE Customer_PhoneNum
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(CustomerID, PhoneNum);


INSERT INTO Contain (OrderNo, ItemName, Quantity) VALUES
(1, 'Steamed Chicken', 1),
(2, 'Fried Chicken', 2),
(3, 'Kothe Chicken', 3),
(1, 'Jhol Chicken', 1),
(2, 'Steamed Vegetable', 2),
(3, 'Fried Vegetable', 4),
(7, 'Kothe Vegetable', 5),
(8, 'Jhol Vegetable', 2),
(9, 'Steamed Paneer', 1),
(10, 'Fried Paneer', 1),
(7, 'Kothe Paneer', 24),
(7, 'Jhol Paneer', 25);

INSERT INTO TotalAmount 
SELECT fi.OrderNo, SUM(fi.Price * c.Quantity) AS TOTAL 
FROM FoodItem fi JOIN
     Contain c
     ON fi.OrderNo = c.OrderNo AND
        fi.ItemName = c.ItemName
GROUP BY c.OrderNo;

