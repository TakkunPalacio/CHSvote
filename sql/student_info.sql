
drop database if exists chs_voting;
CREATE database if not exists chs_voting;
use chs_voting;


-- Table for candidates
-- Table for candidate information
CREATE TABLE candi_info (
  Candidate_id INT AUTO_INCREMENT PRIMARY KEY,
  S_id varchar(50) NOT NULL,
  S_name VARCHAR(255) NOT NULL,
  position int NOT NULL,
  S_year int(1) not null,
  Course varchar(50) not null,
  Section varchar(1) not null,
  img varchar(500) not null,
  platform varchar(1000) not null,
  vote_count int(4) default 0
);

CREATE TABLE IF NOT EXISTS v_acc (
  Id INT NOT NULL AUTO_INCREMENT,
  S_id varchar(50) not null unique,
  is_admin boolean default 0,
  pass varchar(50) NOT NULL,
  PRIMARY KEY (Id)
);

CREATE Table if not exists v_info (
  S_id varchar(50) not null unique,
  S_name varchar(50) not null,
  course varchar(50) not null,
  S_year int(1) not null,
  Section varchar(1) not null,
  PRIMARY Key (S_id),
  FOREIGN Key (S_id) REFERENCES v_acc(S_id) ON UPDATE CASCADE ON DELETE CASCADE
);
-- Table for vote scores
CREATE TABLE position_votes (
  S_id varchar(50) NOT NULL,
  president  INT NOT NULL,
  v_president INT NOT NULL,
  secretary INT NOT NULL,
  a_secretary INT NOT NULL,
  treasurer INT NOT NULL,
  a_treasurer INT NOT NULL,
  auditor INT NOT NULL,
  pio INT NOT NULL,
  b_manager INT NOT NULL,
  nursing_rep INT NOT NULL,
  pharma_rep INT NOT NULL,
  pt_rep INT NOT NULL,
  PRIMARY Key (S_id),
  FOREIGN KEY (S_id) REFERENCES v_acc(S_id) ON UPDATE CASCADE ON DELETE CASCADE
);
/*admin acc*/
INSERT INTO v_acc (S_id, is_admin, pass) VALUES
('99-999999',1,'admin');

INSERT INTO candi_info (Candidate_id,position) VALUES (1,0),(2,-1);

Select * from v_acc;
Select * from v_info;
Select * from candi_info;