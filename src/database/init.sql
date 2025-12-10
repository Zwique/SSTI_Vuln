USE vulnlab;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50)
);

CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    content TEXT
);

INSERT INTO users (username, password)
VALUES ('admin', 'Super3cret!Passw0rD');

INSERT INTO notes (title, content)
VALUES ('welcome', 'Hello user');
