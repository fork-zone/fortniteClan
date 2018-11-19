/* Create users table */
CREATE TABLE users (
  id INT NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
);
/* Create clans table */
CREATE TABLE clans (
  id INT NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
  userid INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL,
  picture VARCHAR(255) NOT NULL,
  discord VARCHAR(255),
  website VARCHAR(255),
);

/* Create link between the users and clans table */
ALTER TABLE clans 
ADD CONSTRAINT user-clan 
FOREIGN KEY (userid) 
REFERENCES users(id) 
ON DELETE CASCADE 
ON UPDATE CASCADE;
