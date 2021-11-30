`USE guestbookdb;

CREATE TABLE users (
                       id INT NOT NULL AUTO_INCREMENT,
                       username VARCHAR(256) NOT NULL UNIQUE,
                       password VARCHAR(256) NOT NULL,
                       PRIMARY KEY (id)
);

CREATE TABLE messages (
                          id INT NOT NULL AUTO_INCREMENT,
                          user_id INT NOT NULL,
                          message_text VARCHAR(256) NOT NULL,
                          send_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          PRIMARY KEY (id)
);

ALTER TABLE messages
    ADD CONSTRAINT messages_users_id_fk
        FOREIGN KEY (user_id) REFERENCES users (id);`