BEGIN;

CREATE DATABASE doctrine;

CREATE USER 'doctrine'@'localhost' IDENTIFIED BY 'doctrine';

GRANT ALL ON doctrine.* TO 'doctrine'@'localhost';

FLUSH PRIVILEGES;

USE doctrine;

CREATE TABLE users (
       idUser int(11) NOT NULL auto_increment,
       login varchar(100) NOT NULL,
       password varchar(255) NOT NULL,
       email varchar(255) NOT NULL,
       openId int(2) NULL,
       ban int(2) NULL,
       groupMember int(11) NOT NULL, 
       PRIMARY KEY (idUser)
) 
ENGINE = InnoDb
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

INSERT INTO users (idUser, login, password, email, groupMember) VALUES
    (1, 'admin', sha1('admin'), 'webmaster@doctrine.com', 1);
INSERT INTO users (idUser, login, password, email, groupMember) VALUES
    (2, 'testovac', sha1('test'), 'webmaster@doctrine.com', 1);
INSERT INTO users (idUser, login, password, email, groupMember, ban) VALUES
    (3, 'testovac4ban', sha1('test'), 'webmaster@doctrine.com', 1, 1);

CREATE TABLE groups (
      idGroup int(11) NOT NULL auto_increment,
      name varchar(100) NOT NULL,
      PRIMARY KEY (idGroup) 
)
ENGINE = InnoDb
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

INSERT INTO groups(idGroup, name) VALUES
    (1, 'Admins');

COMMIT;    
