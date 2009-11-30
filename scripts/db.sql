CREATE DATABASE doctrine;

CREATE USER 'doctrine'@'localhost' IDENTIFIED BY 'doctrine';

GRANT ALL ON doctrine.* TO 'doctrine'@'localhost';

FLUSH PRIVILEGES;

