-- Set up for Database: `politicats`
-- The new names come from what Michael Hess named our projects database

-- Recreate database
DROP DATABASE IF EXISTS 572cats;
CREATE DATABASE 572cats;

-- Enter database
USE 572cats;


-- Create user
GRANT ALL ON 572cats.* TO '572cats'@'localhost' IDENTIFIED BY '53727f39e';

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
(1, 'Governments should reduce spending and not run a deficit', 1, 0),
(2, 'People should pay taxes to create greater economic equality between people', -1, 0),
(3, 'If small business were unfettered by regulations, like minimum wage, they could create even more jobs', 1, 0),
(4, 'It is more important for the Federal Reserve to focus on reducing inflation rather than lowering unemployment.', 1, 0),
(5, 'High net wealth individuals should pay higher tax rates than lower income individuals', -1, 0),
(6, 'People should have the right to an abortion', 0, -1), 
(7, 'Illegal immigrants should be sent back to their home country', 0, 1),
(8, 'Gay marriage should be legal in every state', 0, -1), 
(9, 'Prostitution between consenting adults should be illegal', 0, 1), 
(10, 'Marijuana use should be decriminalized', 0, -1);

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
	q6_value  		FLOAT           NOT NULL,
	q6_weight 		FLOAT           NOT NULL,
	q7_value  		FLOAT           NOT NULL,
	q7_weight 		FLOAT           NOT NULL,
	q8_value  		FLOAT           NOT NULL,
	q8_weight 		FLOAT           NOT NULL,
	q9_value  		FLOAT           NOT NULL,
	q9_weight 		FLOAT           NOT NULL,
	q10_value  		FLOAT           NOT NULL,
	q10_weight 		FLOAT           NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB; 

-- ------- Create politicats image table
-- This table will hold all of the cat images we have 
CREATE TABLE politicat (
	id		        INTEGER         NOT NULL    AUTO_INCREMENT,
	catpic          VARCHAR(100)    NOT NULL,
	name	        VARCHAR(100)    NOT NULL,
	score_fiscal FLOAT           NOT NULL,
	score_social FLOAT           NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB; 

-- Insert Politicat Data
INSERT INTO politicat (catpic, name, score_fiscal, score_social) VALUES
('ChairmanMeow2.png', 'Chairman Meow', -1, 1),
('Palin_cat.png','Feline Palin', .7, .9),
('michael_meowr.png','Michael Meowr', -0.5, -1),
('ronpaw2.png','Ron Paw', .9, -.9),
('rush_limpaw_final.png','Rush Limpaw', .9, .9);
