DROP DATABASE IF EXISTS elaborato;
CREATE DATABASE elaborato CHARACTER SET utf8mb4;  
USE elaborato;
CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(50) NOT NULL,
    password varchar(255) NOT NULL,
    ruolo ENUM('admin', 'insegnante', 'studente') NOT NULL,
    img varchar(255) NOT NULL,
    description varchar(255),
    PRIMARY KEY (id),
    UNIQUE (username)
);
CREATE TABLE post (
    id int NOT NULL AUTO_INCREMENT,
    id_utente int NOT NULL,
    name varchar(50) NOT NULL,
    img varchar(255) NOT NULL,
    price decimal(10,2) NOT NULL,
    description varchar(255),
    PRIMARY KEY (id),
    FOREIGN KEY (id_utente) REFERENCES users(id) ON DELETE CASCADE
);
CREATE TABLE spot (
    id int NOT NULL AUTO_INCREMENT,
    id_post int NOT NULL,
    name varchar(50) NOT NULL,
    price decimal(10,2) NOT NULL,
    img varchar(255) NOT NULL,
    description varchar(255),
    PRIMARY KEY (id),
    FOREIGN KEY (id_post) REFERENCES post(id) ON DELETE CASCADE
);
CREATE TABLE comment (
    id_post int NOT NULL,
    id int NOT NULL AUTO_INCREMENT, 
    id_utente int NOT NULL,
    comment varchar(255) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_post) REFERENCES post(id) ON DELETE CASCADE,
    FOREIGN KEY (id_utente) REFERENCES users(id) ON DELETE CASCADE
);
INSERT INTO `users`(`username`, `password`, `ruolo`, `img`) VALUES ('admin','21232f297a57a5a743894a0e4a801fc3','admin','img/guest.png');
INSERT INTO `users`(`username`, `password`, `ruolo`, `img`) VALUES ('insegnante','b52967cc88dc9ce2824dd87dcf7575d2','insegnante','img/guest.png');
INSERT INTO post (id_utente,name,img,price,description) VALUES (2,"gallipoli","img/guest.png",200,"citta molto bella");
INSERT INTO spot (id_post,name,img,price,description) VALUES (1,"Basilica Concattedrale di Sant'Agata","img/guest.png",0,"costruzione barocca del xviii secolo");
INSERT INTO comment (id_post,id_utente,comment) VALUES (1,1,"Che bel posto");