## Herestory

### Description
Herestrory is a web app designed to collect and represent different stories of place.

### Setup (Roll your own) - WORK IN PROGRESS

#### Requirements

1. PHP (>= 5.3.24)
2. MySQL (>= 5.5.19)


If you want to roll your own instance of Herestory, follow these steps:

1. In a MySQL database, create a table with the following structure:

| Column Name   | Type      |
| :-----------: | :----:    |
| id            | int(11)   |
| date          | text      |
| lat           | float     |
| lng           | float     |
| story         | text      |
| tag           | text      |
| picture       | text      |
| hide          | char(1)   |


2. Open *db_scripts/credentials.php.template* and add in your host, user, password and database name. Once done, rename to *credentials.php*.