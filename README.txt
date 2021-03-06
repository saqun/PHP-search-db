# �or create a new repository on the command line

echo "# PHP-search-db" >> README.md
git init
git add README.md
git commit -m "first commit"
git remote add origin https://github.com/saqun/PHP-search-db.git
git push -u origin master

# �or push an existing repository from the command line

git remote add origin https://github.com/saqun/PHP-search-db.git
git push -u origin master

==============================================================
This project is built using
- Wampserver / Windows
- Notepad++
- Php-5.17
- MySQL to create database and a table (see command below).
- No PHP frame used for this small project.

The project is divided into 3 files:
- php/db_functions.php: this defines a class to search for events in database
- php/view.php: displays events to the user
- result: interaction with the user

The file .htaccess has been added to recognize "result" as a php file.
Content of .htaccess:
<FilesMatch "^[^.]+$">
    ForceType application/x-httpd-php
</FilesMatch>

To test the project, you have to:
- execute all SQL command below
- open entry-point/unchanged.php
- and with a bit of chance, everything should work fine :-)

########################### SQL COMMAND #####################
# Connect and create database/table

mysql -u root -p

CREATE DATABASE arlo_db;
USE arlo_db;

GRANT ALL PRIVILEGES ON arlo_db.* TO 'arlo'@'locahost' IDENTIFIED BY 'password';

DROP TABLE IF EXISTS `custom_events`;
CREATE TABLE IF NOT EXISTS `custom_events` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start` datetime NOT NULL,
  `finish` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT FALSE,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `custom_events` (`name`, `description`, `start`, `finish`, `location`, `category`, `private`) VALUES
('Learning how to bike', 'A first attempt to be comfortable on a bike', '2018-09-01 10:00:00', '2018-09-01 12:00:00', 'Chicago', 'Sport', FALSE),
('How to make cocktail', 'Some secret recipes on how to make astonishing cocktails', '2018-09-15 15:00:00', '2018-09-15 18:00:00', 'Los Angeles', 'Hospitality', FALSE),
('Kayaking', 'First trip in kayak', '2020-12-01 09:00:00', '2020-12-01 12:00:00', 'Los Angeles', 'Sport', TRUE),
('A perfect serving', 'Learn all the ins and outs of serving in a fancy bar or restaurant', '2021-03-20 18:00:00', '2021-03-20 20:00:00', 'New York', 'Hospitality', FALSE),
('Improve your swimming experience', 'Swimming can be energy consuming if not done properly, you will learn how to swim for hours without any effort', '2022-07-08 11:00:00', '2022-07-08 12:00:00', 'New York', 'Sport', FALSE),
('L.A. music festival', 'The most underground music festival in California', '2022-08-15 16:00:00', '2022-08-16 01:00:00', 'Los Angeles', 'Music', FALSE),
('Horse riding', 'A horse excursion in a beautiful western-like area', '2022-10-25 14:00:00', '2022-10-25 17:00:00', 'Houston', 'Sport', TRUE);
