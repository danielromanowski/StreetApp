Drop database if exists streetdreams;

CREATE DATABASE streetdreams;

\c streetdreams;

Drop table if exists locations;

CREATE TABLE locations (id SERIAL PRIMARY KEY, location_name VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, radius DOUBLE PRECISION NOT NULL, performance_type VARCHAR(255) NOT NULL, duration INTEGER NOT NULL, reservation_type VARCHAR(255) NOT NULL);