CREATE TABLE Guests
( guestID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  firstName CHAR(25) NOT NULL,
  lastName CHAR(25) NOT NULL,
  stateID CHAR(13),
  phone INT UNSIGNED,
  email CHAR(75),
  address CHAR(100),
  licensePlate CHAR(25),
);


CREATE TABLE Reservations
(guestID INT UNSIGNED NOT NULL,
  roomNumber CHAR(13) NOT NULL,  
  checkinDate DATETIME NOT NULL,
  checkoutDate DATETIME NOT NULL,
  reservationDate DATETIME,
  paymentMade DECIMAL(10,2)

  PRIMARY KEY (guestID, roomNumber),
  FOREIGN KEY (guestID) REFERENCES Guests(guestID),
  FOREIGN KEY (roomNumber) REFERENCES Rooms(roomNumber)
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

