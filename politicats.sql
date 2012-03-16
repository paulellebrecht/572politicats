-- Set up for Database: `politicats`

-- Recreate database
DROP DATABASE IF EXISTS politicats;
CREATE DATABASE politicats;

-- Enter database
USE politicats;


-- Create user
DROP USER 'quiz'@'localhost';
GRANT ALL ON politicats.* TO 'quiz'@'localhost' IDENTIFIED BY 'password';

-- ------------------------ CREATING TABLES -------------------------

-- ------- Create Questions table
-- This table will hold all of the questions of our quiz
-- and the 'orientation' of those questions (liberal vs conservative)
CREATE TABLE questions (
    -- Question ID
	id      INTEGER         NOT NULL    AUTO_INCREMENT,
    -- Question Text
	text    VARCHAR(256)    NOT NULL,
  	-- What is the orientation (liberal or conservative) is this question on
  	-- the fiscal scale
    orientation_fiscal      INTEGER         NOT NULL,
    orientation_social      INTEGER         NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB; 

-- Insert initial data: question text
INSERT INTO questions (id, text, orientation_fiscal, orientation_social) VALUES
(1, 'Governments, like households, shouldn''t take on more debt by spending more than they earn.', 1, 0),
(2, 'Taxes are necessary because they pay for public services I appreciate like a police force, firefighters, and paved roads.', -1, 0),
(3, 'If small business were unfettered by regulations, like minimum wage, they could create even more jobs', 1, 0),
(4, 'It is more important for the Federal Reserve to focus on reducing inflation rather than lowering unemployment.', 1, 0),
(5, 'High net wealth individuals should pay higher tax rates than lower income individuals.', -1, 0);

-- ------- Create users table
-- This table will hold all of the uers's login and 
-- demographic info
CREATE TABLE users (
    -- User ID
	id		    INTEGER         NOT NULL    AUTO_INCREMENT,
    name      	VARCHAR(30)     NOT NULL,
    username    VARCHAR(15)     NOT NULL,
    password    VARCHAR(30)     NOT NULL,
    score_fis   FLOAT           NOT NULL,
    score_soc   FLOAT           NOT NULL,
    -- Foreign Key: Politicat 
    politicat_id   INTEGER      NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB; 

-- ------- Create results table
-- This table will hold all of the results for the user of our quiz
-- and the weights chosen for each question; this is done by mapping 
-- one user to many questions in this particular table 
CREATE TABLE answers (
	id		        INTEGER         NOT NULL    AUTO_INCREMENT,
    -- Foreign Key User ID
	users_id        INTEGER         NOT NULL,
  	-- The users answers to each question    <---------------------- if you've added more questions, insert more columns here
	q1_value  		FLOAT           NOT NULL,
	q1_weight 		FLOAT           NOT NULL,
	q2_value  		FLOAT           NOT NULL,
	q2_weight 		FLOAT           NOT NULL,
	q3_value  		FLOAT           NOT NULL,
	q3_weight 		FLOAT           NOT NULL,
	q4_value  		FLOAT           NOT NULL,
	q4_weight 		FLOAT           NOT NULL,
	q5_value  		FLOAT           NOT NULL,
	q5_weight 		FLOAT           NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB; 

-- ------- Create politicats image table
-- This table will hold all of the cat images we have 
CREATE TABLE catpics (
	id		        INTEGER         NOT NULL    AUTO_INCREMENT,
	catpic          VARCHAR(100)    NOT NULL,
	scoreMin_fiscal FLOAT           NOT NULL,
	scoreMax_fiscal FLOAT           NOT NULL,
	scoreMin_social FLOAT           NOT NULL,
	scoreMax_social FLOAT           NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB; 
