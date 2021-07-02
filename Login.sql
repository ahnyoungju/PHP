-- CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin';

/* Create a database/table to hold information of authorised users */
CREATE DATABASE If Not Exists Login;
use Login;
CREATE TABLE If Not Exists tblUsers (
  username    varchar(20) NOT NULL,
  password  varchar(10),
  PRIMARY KEY( username)
) Engine=InnoDB Default Charset=utf8;

INSERT INTO tblUsers VALUES( 'admin', 'pass');

-- GRANT ALL ON dalton.* TO 'admin'@'localhost';
-- GRANT ALL ON Login.* TO 'admin'@'localhost';
