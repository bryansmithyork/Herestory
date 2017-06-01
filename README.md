# Herestory

## Description
Herestory is a web app for documenting histories of place.

## Setup (Roll your own) - WORK IN PROGRESS

### Requirements

1. PHP (>= 5.3.24)
2. MySQL (>= 5.5.19)


If you want to roll your own instance of Herestory, follow these steps:

#### 1. Database Setup
The first thing you'll need to do is set up a MySQL database. HereStory requires a table with the following structure:

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

The following SQL query will create the table above for you:

```
CREATE TABLE `herestory` (
  `id` int(11) NOT NULL auto_increment,
  `date` text NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `story` text NOT NULL,
  `tag` text NOT NULL,
  `picture` text NOT NULL,
  `hide` char(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1201 DEFAULT CHARSET=utf8
```

#### 2. Configure database and JS scripts
a. Rename */db_scripts/credentials.php.template* to */db_scripts/credentials.php*. Open */db_scripts/credentials.php* and add in your host, user, password and database name:

```
<?php
	$host = "";
	$user = "";
	$pass = "";
	$db = "";
?>
```

b. Rename */js/mapbox_prefs.js.template* to */js/mapbox_prefs.js*. Open */js/mapbox_prefs.js* and add in the MapBox token and style id:

```
var mbToken = '';
var mbStyle = '';
```

See the instructions in the template for more info about getting a token and style id.

#### 3. Prepare for image uploads
Create a directory called *images/* in the root directory.

#### 4. Upload
Upload everything to your web host.