--
-- MySQL 5.5.37
-- Sat, 12 Jul 2014 09:03:07 +0000
--

CREATE TABLE `categories` (
   `id` int(11) not null auto_increment,
   `name` varchar(255),
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=13;

INSERT INTO `categories` (`id`, `name`) VALUES 
('1', 'Fast food'),
('2', 'Groceries'),
('3', 'Petrol'),
('4', 'Bills'),
('5', 'Rent'),
('6', 'Entertainment'),
('7', 'Clothes'),
('8', 'Gym'),
('9', 'Alcohol'),
('10', 'Dinner out'),
('11', 'Catch up'),
('12', 'Other');

CREATE TABLE `items` (
   `id` int(11) not null auto_increment,
   `description` text,
   `date` datetime not null,
   `price` float,
   `deleted` tinyint(4) default '0',
   `category_id` int(11) default '0',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=40;