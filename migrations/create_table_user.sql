CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255),
    surname VARCHAR(255),
    password VARCHAR(255),

    PRIMARY KEY (id)
);