
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

CREATE TABLE PriorGuests
( firstName CHAR(25) NOT NULL PRIMARY KEY,
  lastName CHAR(25) NOT NULL,
  roomNumber CHAR(13),
  phone CHAR(12),
  address CHAR(100),
  checkinDate DATE NOT NULL,
  checkoutDate DATE NOT NULL
);

INSERT INTO Guests VALUES
  (1, 'Julie','Smith', 'CA1234','714-999-9999','email@gmail.com','1122 Dale St, Garden Grove, CA','SH32314'),
  (2, 'Bradley','Vo', 'ZA343','714-555-5555','bradleyvo@gmail.com','1122 Dale St, Garden Grove, ZA','BD2394'),
  (3, 'Van','Le', 'AZ543','714-333-3333','vananhle@gmail.com','1122 Dale St, Garden Grove, AZA','CF5334'),
  (4, 'David','Dang', 'TX765','714-222-2222','daviddang@gmail.com','1122 Dale St, Garden Grove, TX','TY3334'),
  (5, 'Julie','Davis', 'XY1234','714-950-9309','juliedavis@gmail.com','1842 Dale St, Garden Grove, CA','GH32314'),
  (6, 'Noah','Von', 'TG343','714-501-5785','noahvon@gmail.com','1635 Dale St, Garden Grove, ZA','BDJK94'),
  (7, 'Mack','Davis', 'HJ543','714-368-3843','mackdavis@gmail.com','1720 Dale St, Garden Grove, AZA','CF53QA'),
  (8, 'Noah','Tav', 'QA765','714-248-2152','noahtav@gmail.com','1917 Dale St, Garden Grove, TX','TY33FD');

insert into PriorGuests VALUES
('Julie','Smith','B12','714-999-9999','1122 Dale St, Garden Grove, CA',
 '2021-02-09', '2021-02-12'),
 ('Mack','Davis','B2','714-368-3843','1720 Dale St, Garden Grove, AZA',
 '2021-03-11', '2021-03-21');

INSERT INTO Rooms VALUES
  ('B342', 'King','Yes','Occupied',99.99 ),
  ('C22', 'Queen','Yes','Occupied',99.99 ),
  ('B300', 'Suite','Yes','Occupied',99.99 ),
  ('C21', 'Double Queen','Yes','Occupied',99.99 ),
  ('B42', 'King','Yes','Occupied',99.99 ),
  ('C20', 'Queen','Yes','Reserved',99.99 ),
  ('B30', 'Suite','Yes','Reserved',99.99 ),
  ('C19', 'Double Queen','Yes','Occupied',99.99 ),
  ('B2', 'King','Yes','Available',99.99 ),
  ('C2', 'Queen','Yes','Available',99.99 ),
  ('B3', 'Suite','Yes','Available',99.99 ),
  ('C1', 'Double Queen','Yes','Available',99.99 ),
  ('B13', 'Suite','Yes','Dirty',99.99 ),
  ('C12', 'Double Queen','Yes','Dirty',99.99 );

/* NULL so it can auto generate and increase the id   */
INSERT INTO Reservations VALUES
  (1, 'B342','2021-04-09', '2021-04-12','2021-03-01',88.56),
  (2, 'C22','2021-04-12', '2021-04-30','2021-03-06',77.56),
  (3, 'B300','2021-04-10', '2021-04-15','2021-03-07',76.56),
  (4, 'C21','2021-04-13', '2021-04-30','2021-03-23',77.56),
  (5, 'B42','2021-04-20', '2021-04-21','2021-04-01',99.56),
  (6, 'C20','2021-05-16', '2021-05-25','2021-04-06',57.56),
  (7, 'B30','2021-05-25', '2021-05-27','2021-04-07',60.56),
  (8, 'C19','2021-04-23', '2021-04-30','2021-04-22',70.56);
