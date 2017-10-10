#----------Задание 1-----------------------
SELECT e.firstName, e.lastName 
FROM employees AS e 
ORDER BY e.firstName DESC;

#----------Задание 2-----------------------
SELECT p.productName, p.buyPrice 
FROM products AS p
ORDER BY p.buyPrice DESC
LIMIT 0, 3;

#----------Задание 3-----------------------
SELECT p.productName, p.quantityInStock 
FROM products AS p
ORDER BY p.quantityInStock
LIMIT 0, 3;

#----------Задание 4-----------------------
SELECT e.officeCode, count(e.officeCode) AS count_of_employees, o.country ,o.city, o.addressLine1
FROM employees AS e 
JOIN offices AS o ON e.officeCode = o.officeCode
GROUP BY e.officeCode
HAVING count_of_employees > 4;

#----------Задание 5-----------------------
SELECT od.orderNumber, count(od.orderNumber) AS count_of_goods, o.status  
FROM orderdetails AS od 
JOIN orders as o ON od.orderNumber = o.orderNumber
GROUP BY orderNumber
HAVING count_of_goods > 10;

#----------Задание 6-----------------------
SELECT e.firstName, e.lastName, c.salesRepEmployeeNumber as employeeNumber, count(c.salesRepEmployeeNumber)  AS count_of_customers
FROM customers AS c
JOIN employees as e ON c.salesRepEmployeeNumber = e.employeeNumber
GROUP BY c.salesRepEmployeeNumber;
