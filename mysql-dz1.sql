/* создаем таблицы*/
      CREATE TABLE sklad (
		  sklad_id  INT AUTO_INCREMENT NOT NULL,
          sklad_address  varchar(100),
          PRIMARY KEY(sklad_id)
        ) 
        ENGINE=InnoDB 
        CHARACTER SET=UTF8;
        
		CREATE TABLE category (
		  category_id  INT AUTO_INCREMENT NOT NULL,
          category_name  varchar(50),
          PRIMARY KEY(category_id)
        ) 
        ENGINE=InnoDB 
        CHARACTER SET=UTF8;

      CREATE TABLE product (
        product_id  INT AUTO_INCREMENT NOT NULL,
        category_id  INT,
        product_name  varchar(50),
        product_about  longtext,
        FOREIGN KEY (category_id) REFERENCES category(category_id),
		PRIMARY KEY(product_id)
         ) 	  
         ENGINE=InnoDB 
         CHARACTER SET=UTF8;  

        CREATE TABLE product_on_sklad (
			ps_id  INT AUTO_INCREMENT NOT NULL,
			product_id  INT,
			sklad_id  int,
            count int,
			FOREIGN KEY (product_id) REFERENCES product(product_id),
            FOREIGN KEY (sklad_id) REFERENCES sklad(sklad_id),
			PRIMARY KEY(ps_id)
        ) 	  
         ENGINE=InnoDB 
         CHARACTER SET=UTF8;  

/*заполняем таблицу sklad*/
INSERT INTO `test1`.`sklad` (`sklad_address`) VALUES ('г. Город 1, ул. Улица 1, дом 5 ');
INSERT INTO `test1`.`sklad` (`sklad_address`) VALUES ('г. Город 1, ул. Улица 121, дом 25 ');
INSERT INTO `test1`.`sklad` (`sklad_address`) VALUES ('г. Город 2, ул. Улица 51, дом 35 ');
INSERT INTO `test1`.`sklad` (`sklad_address`) VALUES ('г. Город 1, ул. Улица 132, дом 251 ');
INSERT INTO `test1`.`sklad` (`sklad_address`) VALUES ('г. Город 4, ул. Улица 41, дом 54 ');

/*заполняем таблицу category*/
INSERT INTO `test1`.`category` (`category_name`) VALUES ('Бытовая техника');
INSERT INTO `test1`.`category` (`category_name`) VALUES ('Товары для дома');
INSERT INTO `test1`.`category` (`category_name`) VALUES ('Инструменты и автотовары');
INSERT INTO `test1`.`category` (`category_name`) VALUES ('Дача, сад и огород');
INSERT INTO `test1`.`category` (`category_name`) VALUES ('Спорт и увлечения');
INSERT INTO `test1`.`category` (`category_name`) VALUES ('Одежда, обувь и украшения');
INSERT INTO `test1`.`category` (`category_name`) VALUES ('Красота и здоровье');
INSERT INTO `test1`.`category` (`category_name`) VALUES ('Смартфоны, ТВ и электроника');
INSERT INTO `test1`.`category` (`category_name`) VALUES ('Сантехника и ремонт');
INSERT INTO `test1`.`category` (`category_name`) VALUES ('Ноутбуки и компьютеры');

/*заполняем таблицу product*/
INSERT INTO `test1`.`product` (`category_id`, `product_name`, `product_about`) 
	VALUES ('1', 'Пылесос PHILIPS PowerPro Active FC8670/01', 'Мотор 2000 Вт пылесоса FC8670/01 серии PowerPro Active от компании Philips обеспечивает высокую мощность всасывания и гарантирует отличные результаты уборки. Технология PowerCyclone 4 усиливает воздушный поток и повышает эффективность, мгновенно отделяя пыль от воздуха.');
INSERT INTO `test1`.`product` (`category_id`, `product_name`, `product_about`) 
	VALUES ('1', 'Стиральная машина узкая ZANUSSI ZWSO 680','Эта стиральная машина дарит лучшее из двух миров: мощность и производительность больших машин, удобство компактных');
INSERT INTO `test1`.`product` (`category_id`, `product_name`, `product_about`) 
	VALUES ('2', 'Кресло Примтекс Плюс Tunis P D-5','Примтекс Плюс Tunis P D-5 комплектуется пластиковыми подлокотниками, пластиковой полиамидной пятилучевой базой, пневмопатроном для регулировки высоты сидения и механизмом качания, что обеспечит Вам необходимый комфорт во время работы.');
INSERT INTO `test1`.`product` (`category_id`, `product_name`, `product_about`) 
	VALUES ('2', 'Кресло Примтекс Плюс 7','Примтекс комплектуется пластиковыми подлокотниками, пластиковой полиамидной пятилучевой базой, пневмопатроном для регулировки высоты сидения и механизмом качания, что обеспечит Вам необходимый комфорт во время работы.');
INSERT INTO `test1`.`product` (`category_id`, `product_name`, `product_about`) 
	VALUES ('3', 'Набор инструментов Alloid 0007','Инструмент Alloid – высокое качество материалов, эргономичный, яркий дизайн инструментов и упаковки. Инструмент Alloid выполнен с соблюдением самых высоких стандартов, что гарантирует высокую надежность. Отличный вариант в соотношении цена — качество. Alloid — качественный инструмент в средней ценовой политике.');
INSERT INTO `test1`.`product` (`category_id`, `product_name`, `product_about`) 
	VALUES ('3', 'Набор инструментов Alloid 00012','Инструмент Alloid 00012 – высокое качество материалов, эргономичный, яркий дизайн инструментов и упаковки. Инструмент Alloid выполнен с соблюдением самых высоких стандартов, что гарантирует высокую надежность. Отличный вариант в соотношении цена — качество. Alloid — качественный инструмент в средней ценовой политике.');
   
/*заполняем таблицу product_on_sklad*/
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('1', '3','50');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('1', '4','110');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('2', '3','110');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('2', '1','101');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('2', '2','211');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('3', '1','311');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('4', '3','611');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('5', '1','141');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('5', '3','131');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('5', '2','211');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('5', '5','141');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('6', '1','151');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('6', '3','116');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('6', '4','117');
INSERT INTO `test1`.`product_on_sklad` (`product_id`, `sklad_id`,`count`) VALUES ('6', '5','141');

