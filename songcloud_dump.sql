DROP TABLE IF EXISTS 'Artists';

CREATE TABLE 'Artists' (
    debut INT(4), 
    name VARCHAR(40) NOT NULL,
    genre VARCHAR(20),
    artist_id INT(12) NOT NULL PRIMARY KEY,
    country VARCHAR(20),
);

DROP TABLE IF EXISTS 'Song';

CREATE TABLE 'Song' (
    song_id INT(12) NOT NULL,
    title VARCHAR(40) NOT NULL,
    artist_id INT(12) REFERENCES Artists(artist_id),
    duration INT(4),
    album VARCHAR(20) REFERENCES Album(album_id),
);

DROP TABLE IF EXISTS 'Album';

CREATE TABLE 'Album' (
    album_id INT(12) NOT NULL PRIMARY KEY,
    name VARCHAR(40) NOT NULL,
    num_songs INT(4) NOT NULL,
    artist_id INT(12) NOT NULL REFERENCES Artists(artist_id),
    release_date INT(4) NOT NULL,
);