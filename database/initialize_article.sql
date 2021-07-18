USE article_db;

CREATE TABLE users (
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username varchar(50) NOT NULL,
    password text NOT NULL,
    time_log json
);

CREATE TABLE tag (
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL
);

CREATE TABLE category (
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL
);

CREATE TABLE article (
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title text NOT NULL,
    content text NOT NULL,
    tag_id json,
    category_id json,
    thumbnail text NOT NULL,
    time_log json,
    is_active tinyint(1) DEFAULT 1 NOT NULL,
    updated_by int(11) NOT NULL
);

CREATE INDEX article_id_idx ON article (id);

