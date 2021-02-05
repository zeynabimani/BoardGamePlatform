CREATE TABLE room(
    roomID int  primary key NOT NULL AUTO_INCREMENT,
    managerID int,
    status ENUM('Accepting', 'Playing', 'Empty')
);

CREATE TABLE game(
    roomID int,
    userID int
);

CREATE TABLE game_request(
    roomID int,
    userID int,
    status ENUM('Accepted', 'Denied', 'Waiting')
);

CREATE TABLE sadaf.chat (
    idchat INT NOT NULL AUTO_INCREMENT,
    userID VARCHAR(45) NULL,
    msg VARCHAR(45) NULL,
    dt VARCHAR(45) NULL,
    PRIMARY KEY (idchat)
);