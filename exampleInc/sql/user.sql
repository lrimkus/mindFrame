CREATE TABLE user (
  user_id int(11) NOT NULL AUTO_INCREMENT,
  first_name text NOT NULL,
  last_name text NOT NULL,
  username text NOT NULL,
  email text NOT NULL,
  password text NOT NULL,
  PRIMARY KEY (user_id)
) ENGINE=InnoDB;

