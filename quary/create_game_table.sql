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
