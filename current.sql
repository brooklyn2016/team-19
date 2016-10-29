CREATE TABLE IF NOT EXISTS person (
  person_id int NOT NULL,
  name varchar NOT NULL,
  place varchar NOT NULL,
  person_file varchar NOT NULL,
  PRIMARY KEY (person_id)
)

CREATE TABLE IF NOT EXISTS recording (
  person_id int NOT NULL,
  phrase varchar NOT NULL,
  filepath varchar NOT NULL,
  PRIMARY KEY (person_id,phrase)
)

ALTER TABLE recording
ADD CONSTRAINT fk_person_id 
FOREIGN KEY (person_id) REFERENCES person (person_id);

alter table person alter column person_file SET DEFAULT NULL;