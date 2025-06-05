-- Create the User table with VARCHAR id
CREATE TABLE User (
                      id VARCHAR(50) PRIMARY KEY,
                      email VARCHAR(255) NOT NULL UNIQUE,
                      password VARCHAR(255) NOT NULL,
                      role INT NOT NULL
);

-- Create the Category table
CREATE TABLE Category (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          label VARCHAR(255) NOT NULL,
                          description TEXT
);

-- Create the Event table
CREATE TABLE Event (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       title VARCHAR(255) NOT NULL,
                       description TEXT,
                       price DECIMAL(10, 2),
                       start_date DATETIME NOT NULL,
                       end_date DATETIME,
                       time TIME,
                       category_id INT,
                       is_published BOOLEAN DEFAULT FALSE,
                       user_id VARCHAR(50),
                       FOREIGN KEY (category_id) REFERENCES Category(id),
                       FOREIGN KEY (user_id) REFERENCES User(id)
);

-- Create the Image table
CREATE TABLE Image (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       event_id INT,
                       url VARCHAR(255) NOT NULL,
                       FOREIGN KEY (event_id) REFERENCES Event(id)
);
