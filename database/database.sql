CREATE TABLE Client (
    clientId SERIAL  NOT NULL,
    name varchar(30)  NOT NULL,
    lastName varchar(60)  NOT NULL,
    email varchar(30)  NOT NULL,
    clientname varchar(20)  NOT NULL,
    password varchar(20)  NOT NULL,
    verified char(1)  NOT NULL,
    avatar TEXT NOT NULL,
    birthday date NOT NULL,
    CONSTRAINT client_pk PRIMARY KEY (clientId)
);

CREATE TABLE Sheet (
    sheetId SERIAL NOT NULL,
    name varchar(30)  NOT NULL,
    clientId INTEGER NOT NULL,
    description TEXT NOT NULL,
    pdf TEXT NOT NULL,
    key varchar(20)  NOT NULL,
    mainGenre varchar(30)  NOT NULL,
    likes int  NOT NULL,
    dislikes int  NOT NULL,
    views int  NOT NULL,
    downloads int  NOT NULL,
    image TEXT NULL,
    CONSTRAINT sheet_pk PRIMARY KEY (sheetId),
    CONSTRAINT sheet_Fk FOREIGN KEY (clientId) references Client ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE SheetInstrument (
    sheetId SERIAL NOT NULL,
    instrument varchar(30)  NOT NULL,
    effects varchar(60)  NOT NULL,
    CONSTRAINT sheetInstrument_pk PRIMARY KEY (sheetId, instrument),
    CONSTRAINT sheetInstrument_fk FOREIGN KEY (sheetId) references Sheet ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Playlist (
    playlistId SERIAL NOT NULL,
    clientId INTEGER  NOT NULL,
    name varchar(60)  NOT NULL,
    image varchar(50)  NOT NULL,
    description TEXT NOT NULL,
    CONSTRAINT playlist_pk PRIMARY KEY (playlistId),
    CONSTRAINT playlist_fk FOREIGN KEY (clientId) references Client ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE PlaylistItem (
    playlistId INTEGER  NOT NULL,
    sheetId INTEGER NOT NULL,
    CONSTRAINT playlistItem_pk PRIMARY KEY (playlistId, sheetId),
    CONSTRAINT playlistItem_fk FOREIGN KEY (playlistId) references Playlist ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT playlistItemSheet_fk FOREIGN KEY (sheetId) references Sheet ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Comment (
    commentId SERIAL  NOT NULL,
    clientId INTEGER  NOT NULL,
    sheetId INTEGER  NOT NULL,
    dateTime date NOT NULL,
    description TEXT NOT NULL,
    response INTEGER NULL,
    likes int  NOT NULL,
    dislikes int  NOT NULL,
    CONSTRAINT comment_pk PRIMARY KEY (commentId),
    CONSTRAINT comment_fk FOREIGN KEY (clientId) references Client ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT comment_sheet_fk FOREIGN KEY (sheetId) references Sheet ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT comment_comment_fk FOREIGN KEY (commentId) references Comment ON DELETE CASCADE ON UPDATE CASCADE
);
