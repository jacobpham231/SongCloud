DROP TABLE IF EXISTS Artists;

CREATE TABLE Artists (
    artist_id INT(12) NOT NULL PRIMARY KEY,
    name VARCHAR(40) NOT NULL,
    genre VARCHAR(20),
    debut INT(4),
    country VARCHAR(20)
);
INSERT INTO Artists (artist_id, name, genre, debut, country) VALUES
(1, 'Aurora Blaze', 'Pop', 2010, 'USA'),
(2, 'Echo Drive', 'Rock', 2005, 'UK'),
(3, 'Luna Ray', 'R&B', 2012, 'Canada'),
(4, 'Neon Storm', 'Electronic', 2018, 'Germany'),
(5, 'Indigo Moon', 'Folk', 2011, 'USA'),
(6, 'Sage Orion', 'Jazz', 2000, 'France'),
(7, 'Crimson Tide', 'Metal', 2007, 'Sweden'),
(8, 'Nova Pulse', 'Pop', 2013, 'Australia'),
(9, 'Velvet Mirage', 'Alternative', 2009, 'USA'),
(10, 'Atlas Night', 'Hip-Hop', 2015, 'USA'),
(11, 'Solar Drift', 'Electronic', 2016, 'Norway'),
(12, 'Harmony Sky', 'Classical', 1998, 'Italy'),
(13, 'Golden Echo', 'Soul', 2006, 'USA'),
(14, 'Midnight Rush', 'EDM', 2014, 'Netherlands'),
(15, 'Shadow Bloom', 'Indie', 2010, 'UK'),
(16, 'Ocean Lark', 'Country', 2004, 'USA'),
(17, 'Bliss Haven', 'Ambient', 2019, 'Iceland'),
(18, 'Fire Quartz', 'Rock', 2011, 'Canada'),
(19, 'The Hollow Sun', 'Alternative', 2008, 'Ireland'),
(20, 'Violet Wave', 'Pop', 2020, 'South Korea');

DROP TABLE IF EXISTS Album;

CREATE TABLE Album (
    album_id INT(12) NOT NULL PRIMARY KEY,
    name VARCHAR(40) NOT NULL,
    num_songs INT(4) NOT NULL,
    artist_id INT(12) NOT NULL,
    release_date INT(4) NOT NULL,
    FOREIGN KEY (artist_id) REFERENCES Artists(artist_id) ON DELETE CASCADE
);

INSERT INTO Album (album_id, name, num_songs, artist_id, release_date) VALUES
(101, 'Ignite the Sky', 10, 1, 2011),
(102, 'Speed of Sound', 9, 2, 2006),
(103, 'Lunar Bloom', 11, 3, 2013),
(104, 'Electric Dreams', 8, 4, 2019),
(105, 'Winds of Wood', 10, 5, 2012),
(106, 'Blue Note Nights', 12, 6, 2001),
(107, 'Iron Skies', 10, 7, 2008),
(108, 'Pop Nova', 9, 8, 2014),
(109, 'Mirror Lake', 11, 9, 2010),
(110, 'Rhythm & Rhyme', 10, 10, 2016),
(111, 'Synth Horizon', 8, 11, 2017),
(112, 'Timeless Keys', 10, 12, 1999),
(113, 'Soul Sunrise', 9, 13, 2007),
(114, 'Dance Phase', 11, 14, 2015),
(115, 'Echo Garden', 9, 15, 2011),
(116, 'Dust and Trails', 10, 16, 2005),
(117, 'Frozen Calm', 7, 17, 2020),
(118, 'Blazing Edge', 9, 18, 2012),
(119, 'Dark Valley', 10, 19, 2009),
(120, 'Color Crash', 8, 20, 2021);

DROP TABLE IF EXISTS Song;

CREATE TABLE Song (
    song_id INT(12) NOT NULL PRIMARY KEY,
    title VARCHAR(40) NOT NULL,
    artist_id INT(12),
    duration INT(4),
    album_id INT(12),
    FOREIGN KEY (artist_id) REFERENCES Artists(artist_id) ON DELETE SET NULL,
    FOREIGN KEY (album_id) REFERENCES Album(album_id) ON DELETE SET NULL
);
INSERT INTO Song (song_id, title, artist_id, duration, album_id) VALUES
(1001, 'Skyfire', 1, 210, 101),
(1002, 'Thunder Route', 2, 225, 102),
(1003, 'Moonlight Call', 3, 230, 103),
(1004, 'Binary Love', 4, 215, 104),
(1005, 'Whispering Pines', 5, 200, 105),
(1006, 'Midnight Sax', 6, 240, 106),
(1007, 'Steel Parade', 7, 250, 107),
(1008, 'Pop Machine', 8, 205, 108),
(1009, 'Glass Reflections', 9, 210, 109),
(1010, 'Wordsmith', 10, 195, 110),
(1011, 'Star Pulse', 11, 220, 111),
(1012, 'Eternal Waltz', 12, 230, 112),
(1013, 'Golden Path', 13, 215, 113),
(1014, 'Midnight Circuit', 14, 210, 114),
(1015, 'Sunset Fade', 15, 205, 115),
(1016, 'Prairie Nights', 16, 235, 116),
(1017, 'Driftwood Silence', 17, 225, 117),
(1018, 'Crimson Trail', 18, 240, 118),
(1019, 'Echoes in Snow', 19, 220, 119),
(1020, 'Neon Heart', 20, 215, 120);

DROP TABLE IF EXISTS User;

CREATE TABLE User (
    username VARCHAR(40) NOT NULL PRIMARY KEY,
    password VARCHAR(40) NOT NULL,
    loggedIn Binary NOT NULL
);

INSERT INTO User (username, password, loggedIn) VALUES
('BobBarker02', 'abc123', 0),
('JohnSmith31', 'xyz987', 0),
('GeorgeJohnson', 'password', 0),
('TonyStark', 'IAMIRONMAN', 0);
