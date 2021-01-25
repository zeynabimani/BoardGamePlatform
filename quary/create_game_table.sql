CREATE TABLE room(
    roomID int  primary key NOT NULL AUTO_INCREMENT,
    managerID int,
    status ENUM('Accepting', 'playing', 'empty')
);

CREATE TABLE game(
    roomID int,
    userID int
);