CREATE TABLE news (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255),
    text VARCHAR(255),
    fk_userId INT NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (fk_userId) REFERENCES user(id)
);