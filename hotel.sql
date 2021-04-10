
/*ecs.fullerton.edu/~cs431s24/phpMyAdmin  */
/* child table must be dropped first   */
DROP TABLE IF EXISTS DirtyRooms;
DROP TABLE IF EXISTS Guests;
DROP TABLE IF EXISTS Reservations;
DROP TABLE IF EXISTS Rooms;


CREATE TABLE Guests
( guestID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  firstName CHAR(25) NOT NULL,
  lastName CHAR(25) NOT NULL,
  stateID CHAR(13),
  phone CHAR(12),
  email CHAR(75),
  address CHAR(100),
  licensePlate CHAR(25)
);


CREATE TABLE Rooms
(  roomNumber CHAR(13) NOT NULL PRIMARY KEY,
   roomType CHAR(50) NOT NULL,
   available CHAR(3) NOT NULL,
   status CHAR(50),
   ratePerDay DECIMAL(10,2) NOT NULL
);


CREATE TABLE DirtyRooms
(
  roomNumber CHAR(13) NOT NULL PRIMARY KEY,
  housekeeper CHAR(50) NOT NULL,
  vacuum CHAR(3),
  bedSheet CHAR(3),
  towel CHAR(3), 
  bathroom CHAR(3),
  dusting CHAR(3),
  electronics CHAR(3),
 
  FOREIGN KEY (roomNumber) REFERENCES Rooms(roomNumber)
);


CREATE TABLE Reservations
(guestID INT UNSIGNED NOT NULL,
  roomNumber CHAR(13) NOT NULL,  
  checkinDate DATE NOT NULL,
  checkoutDate DATE NOT NULL,
  reservationDate DATE,
  paymentMade DECIMAL(10,2),

  PRIMARY KEY (guestID, roomNumber),
  FOREIGN KEY (guestID) REFERENCES Guests(guestID),
  FOREIGN KEY (roomNumber) REFERENCES Rooms(roomNumber)
);

INSERT INTO Guests VALUES
  (1, 'Julie','Smith', 'CA1234','714-999-9999','email@gmail.com','1122 Dale St, Garden Grove, CA','SH32314'),
  (2, 'Bradley','Vo', 'ZA343','714-555-5555','bradleyvo@gmail.com','1122 Dale St, Garden Grove, ZA','BD2394'),
  (3, 'Van','Le', 'AZ543','714-333-3333','vananhle@gmail.com','1122 Dale St, Garden Grove, AZA','CF5334'),
  (4, 'David','Dang', 'TX765','714-222-2222','daviddang@gmail.com','1122 Dale St, Garden Grove, TX','TY3334');
 

INSERT INTO Rooms VALUES
  ('B342', 'King','Yes',NULL,99.99 ),
  ('C22', 'Queen','Yes',NULL,99.99 ),
   ('B300', 'Suite','Yes',NULL,99.99 ),
  ('C21', 'Double Queen','Yes',NULL,99.99 );

/* NULL so it can auto generate and increase the id   */
INSERT INTO Reservations VALUES
  (1, 'B342','2021-04-09', '2021-04-12','2021-03-01',88.56),
  (2, 'C22','2021-04-12', '2021-04-30','2021-03-06',77.56),
  (3, 'B300','2021-04-10', '2021-04-15','2021-03-07',76.56),
  (4, 'C21','2021-04-13', '2021-04-30','2021-03-23',77.56);
