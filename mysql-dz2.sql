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

#----------Задание 7-----------------------
SELECT of.officeCode,  count(of.officeCode) as count_of_orders 
FROM offices AS of
	JOIN employees AS e ON of.officeCode = e.officeCode 
		JOIN customers AS c ON e.employeeNumber = c.salesRepEmployeeNumber
			JOIN orders AS ord ON c.customerNumber = ord.customerNumber
				WHERE YEAR(ord.orderDate) = 2005
					GROUP BY of.officeCode
						HAVING count_of_orders > 5;
                        
#----------Задание 8-----------------------                        
SELECT t1.productLine, count(t1.productLine) AS count_of_orders
FROM (	SELECT pl.productLine, od.orderNumber
		FROM productlines AS pl
			JOIN products AS p ON pl.productLine = p.productLine 
				JOIN orderdetails AS od ON p.productCode = od.productCode
					GROUP BY od.orderNumber, pl.productLine) AS t1
GROUP BY t1.productLine;