DROP TABLE Vitals;
DROP TABLE Queue;
DROP TABLE Patient;
DROP TABLE Emergency_Room;
DROP TABLE Team;
DROP TABLE Medical_issue;
DROP TABLE Procedures;
DROP TABLE Drug;

CREATE TABLE Drug(
	Name varchar(255),
	Cost int,
	PRIMARY KEY (Name)
);

CREATE TABLE Procedures(
	procedure_id varchar(255),
	Cost int,
	PRIMARY KEY (procedure_id)
);

CREATE TABLE Medical_issue(
	Number varchar(255) NOT NULL UNIQUE CHECK (Number between 0 and 11),
	medical_issue_name varchar(255),
	PRIMARY KEY (medical_issue_name)
);

CREATE TABLE Team(
	team_id varchar(255),
	Leader varchar(255),
	Fixes1 varchar(255),
	Fixes2 varchar(255),
	Fixes3 varchar(255),
	PRIMARY KEY (team_id),
	FOREIGN KEY (Fixes1) REFERENCES Medical_issue(medical_issue_name) ON DELETE CASCADE,
	FOREIGN KEY (Fixes2) REFERENCES Medical_issue(medical_issue_name) ON DELETE CASCADE, 
	FOREIGN KEY (Fixes3) REFERENCES Medical_issue(medical_issue_name) ON DELETE CASCADE 
);

CREATE TABLE Patient(
	Prio int NOT NULL,
	PID varchar(255),
	Name varchar(255),
	Age Integer,
	Gender varchar(255),
	Arrival varchar(255),
	Assigned_Team varchar(255),
	Issue varchar(255),
	PRIMARY KEY (PID),
	KEY (Prio),
	FOREIGN KEY (Assigned_Team) REFERENCES Team(team_id) ON DELETE CASCADE
);

CREATE TABLE Vitals(
	PID varchar(255),
	Heart_Rate int,
	Blood_pressure varchar(255),
	FOREIGN KEY (PID) REFERENCES Patient(PID) ON DELETE CASCADE
);

CREATE TABLE Emergency_Room(
	Room_id varchar(255),
	Team1 varchar(255),
	Team2 varchar(255),
	Team3 varchar(255),
	Team4 varchar(255),
	Team5 varchar(255),
	FOREIGN KEY (Team1) REFERENCES Team(team_id) ON DELETE CASCADE,
	FOREIGN KEY (Team2) REFERENCES Team(team_id) ON DELETE CASCADE,
	FOREIGN KEY (Team3) REFERENCES Team(team_id) ON DELETE CASCADE,
	FOREIGN KEY (Team4) REFERENCES Team(team_id) ON DELETE CASCADE,
	FOREIGN KEY (Team5) REFERENCES Team(team_id) ON DELETE CASCADE,
	PRIMARY KEY (Room_id)
);

CREATE TABLE Queue(
	Prio int,
	PID varchar(255),
	TeamID varchar(255),
	Entered DATETIME DEFAULT now(),
	FOREIGN KEY (Prio) REFERENCES Patient(Prio) ON DELETE CASCADE,
	FOREIGN KEY (PID) REFERENCES Patient(PID) ON DELETE CASCADE,
	FOREIGN KEY (TeamID) REFERENCES Patient(Assigned_Team) ON DELETE CASCADE
);



INSERT INTO drug VALUES("Morphine", 590);
INSERT INTO drug VALUES("Aspirin", 200);
INSERT INTO drug VALUES("Penicillin", 75);
INSERT INTO drug VALUES("Anti-Biotics", 170);
INSERT INTO drug VALUES("Cortizone", 340);
INSERT INTO drug VALUES("Inhaler", 300);
INSERT INTO drug VALUES("Cough Medicine", 140);
INSERT INTO drug VALUES("Sleeping medicine", 40);
INSERT INTO drug VALUES("Allergy Medicine", 65);
INSERT INTO drug VALUES("Eye Drops", 55);
INSERT INTO drug VALUES("IV", 170);
INSERT INTO drug VALUES("Vitamins", 35);
INSERT INTO drug VALUES("Nasal Spray", 58);

INSERT INTO procedures VALUES("Xray", 1300);
INSERT INTO procedures VALUES("Plaster", 800);
INSERT INTO procedures VALUES("Surgery", 2200);
INSERT INTO procedures VALUES("Check Up", 100);
INSERT INTO procedures VALUES("Diagnose", 200);
INSERT INTO procedures VALUES("Sleep", 60);
INSERT INTO procedures VALUES("Heavy Medication", 590);
INSERT INTO procedures VALUES("Allergic Medication", 150);
INSERT INTO procedures VALUES("Hydrate", 200);
INSERT INTO procedures VALUES("Calming", 200);

INSERT INTO medical_issue VALUES(1, "Fever");
INSERT INTO medical_issue VALUES(2, "Pneumonia");
INSERT INTO medical_issue VALUES(3, "Broken Bone");
INSERT INTO medical_issue VALUES(4, "Stroke");
INSERT INTO medical_issue VALUES(5, "Hay Fever");
INSERT INTO medical_issue VALUES(6, "Nausia");
INSERT INTO medical_issue VALUES(7, "Dehydration");
INSERT INTO medical_issue VALUES(8, "Flesh Wound");
INSERT INTO medical_issue VALUES(9, "Chock");
INSERT INTO medical_issue VALUES(10, "Common Cold");

INSERT INTO Team VALUES(1, "Dr McGee", "Fever", "Pneumonia", "Stroke");
INSERT INTO Team VALUES(2, "Dr Upa", "Broken Bone", "Fever", "Common Cold");
INSERT INTO Team VALUES(3, "Dr Sven", "Common Cold", "Dehydration", "Hay Fever");
INSERT INTO Team VALUES(4, "Dr Engelbrekt", "Flesh Wound", "Broken Bone", "Stroke");
INSERT INTO Team VALUES(5, "Dr Sauerkraut", "Chock", "Pneumonia", "Nausia");

INSERT INTO Patient VALUES(5, "9603185498", "Andreas Gylling", 21, "Male", "Ambulance", 1, "Fever");
INSERT INTO Patient VALUES(3, "9608253234", "Emil Elmarsson", 20, "Male", "Came Alone", 3, "Common Cold");
INSERT INTO Patient VALUES(5, "8601206879", "John Doe", 30, "Male", "Ambulance", 1, "Nausia");
INSERT INTO Patient VALUES(4, "6210226720", "Zara Doe", 55, "Female", "Ambulance", 2, "Broken Bone");
INSERT INTO Patient VALUES(1, "8804051980", "Ingrid Doe", 29, "Female", "Came Alone", 2, "Pneumonia");
INSERT INTO Patient VALUES(4, "6210226730", "Henrik Doe", 55, "Male", "Ambulance", 1, "Dehydration");
INSERT INTO Patient VALUES(2, "7706068899", "Carl Doe", 40, "Male", "Came Alone", 3, "Fever");
INSERT INTO Patient VALUES(5, "0712241122", "Maria Doe", 10, "Female", "Ambulance", 1, "Stroke");
INSERT INTO Patient VALUES(4, "0109299911", "Lars Doe", 16, "Male", "Ambulance", 1, "Flesh Wound");
INSERT INTO Patient VALUES(2, "0202021111", "Alice Doe", 15, "Female", "Ambulance", 1, "Hay Fever");
INSERT INTO Patient VALUES(4, "0005302222", "Engelbrecht von Doe", 17, "Male", "Came Alone", 1,"Stroke");

INSERT INTO Vitals VALUES("9603185498", 220, 120);
INSERT INTO Vitals VALUES("9608253234", 213, 9000);
INSERT INTO Vitals VALUES("8601206879", 160, 100);
INSERT INTO Vitals VALUES("6210226720", 123, 159);
INSERT INTO Vitals VALUES("8804051980", 89, 98);
INSERT INTO Vitals VALUES("6210226730", 140, 104);
INSERT INTO Vitals VALUES("7706068899", 200, 153);
INSERT INTO Vitals VALUES("0712241122", 230, 121);
INSERT INTO Vitals VALUES("0109299911", 155, 111);
INSERT INTO Vitals VALUES("0202021111", 120, 100);
INSERT INTO Vitals VALUES("0005302222", 200, 211);

INSERT INTO emergency_room VALUES("ER", 1,2,3,4,5);

INSERT INTO Queue VALUES( 5, "9603185498", 1, now());
INSERT INTO Queue VALUES( 3, "9608253234", 3, now());
INSERT INTO Queue VALUES( 2, "0202021111", 1, now());
INSERT INTO Queue VALUES( 4, "0005302222", 1, now());
INSERT INTO Queue VALUES( 4, "0109299911", 1, now());
INSERT INTO Queue VALUES( 2, "7706068899", 3, now());
INSERT INTO Queue VALUES( 4, "6210226720", 2, now());
INSERT INTO Queue VALUES( 4, "8804051980", 2, now());
INSERT INTO Queue VALUES( 5, "8601206879", 1, now());
INSERT INTO Queue VALUES( 4, "6210226730", 2, now());
INSERT INTO Queue VALUES( 5, "0712241122", 1, now());














