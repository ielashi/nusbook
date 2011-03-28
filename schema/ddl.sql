CREATE TABLE groups (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  info text,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE group_members (
  user_id int(11) NOT NULL,
  group_id int(11) NOT NULL,
  is_admin int(1) DEFAULT '0',
  PRIMARY KEY (user_id,group_id),
  KEY group_id (group_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE posts (
  id int(11) NOT NULL,
  group_id int(11) NOT NULL,
  poster int(11) NOT NULL,
  post text NOT NULL,
  post_date datetime NOT NULL,
  reply_to int(11) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY group_id (group_id),
  KEY poster (poster),
  KEY reply_to (reply_to)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  email varchar(150) NOT NULL,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  picture_path varchar(400) NOT NULL DEFAULT 'default/picture/path.png',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `group_members`
  ADD CONSTRAINT group_members_ibfk_1 FOREIGN KEY (user_id) REFERENCES `users` (id) ON DELETE CASCADE,
  ADD CONSTRAINT group_members_ibfk_2 FOREIGN KEY (group_id) REFERENCES `groups` (id) ON DELETE CASCADE;

ALTER TABLE `posts`
  ADD CONSTRAINT posts_ibfk_1 FOREIGN KEY (group_id) REFERENCES `groups` (id) ON DELETE CASCADE,
  ADD CONSTRAINT posts_ibfk_2 FOREIGN KEY (poster) REFERENCES `users` (id) ON DELETE CASCADE,
  ADD CONSTRAINT posts_ibfk_3 FOREIGN KEY (reply_to) REFERENCES posts (id) ON DELETE CASCADE;

