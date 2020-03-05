CREATE TABLE Client (
    clientId varchar(9)  NOT NULL,
    name varchar(30)  NOT NULL,
    lastName varchar(60)  NOT NULL,
    email varchar(30)  NOT NULL,
    clientname varchar(20)  NOT NULL,
    password varchar(20)  NOT NULL,
    verified char(1)  NOT NULL,
    avatar varchar(50) NOT NULL,
    birthday date NOT NULL,
    CONSTRAINT client_pk PRIMARY KEY (clientId)
    );

CREATE TABLE Sheet (
    sheetId varchar(9)  NOT NULL,
    name varchar(30)  NOT NULL,
    clientId varchar(60)  NOT NULL,
    description varchar(60)  NOT NULL,
    pdf varchar(20)  NOT NULL,
    key varchar(20)  NOT NULL,
    mainGenre varchar(15)  NOT NULL,
    likes int  NOT NULL,
    dislikes int  NOT NULL,
    views int  NOT NULL,
    downloads int  NOT NULL,
    CONSTRAINT sheet_pk PRIMARY KEY (sheetId),
    CONSTRAINT sheet_Fk FOREIGN KEY (clientId) references Client ON DELETE RESTRICT ON UPDATE CASCADE
    );

CREATE TABLE SheetInstrument (
    sheetId varchar(9)  NOT NULL,
    instrument varchar(30)  NOT NULL,
    effects varchar(60)  NOT NULL,
    CONSTRAINT sheetInstrument_pk PRIMARY KEY (sheetId, instrument),
    CONSTRAINT sheetInstrument_fk FOREIGN KEY (sheetId) references Sheet ON DELETE RESTRICT ON UPDATE CASCADE
    );

CREATE TABLE Playlist (
    playlistId varchar(9)  NOT NULL,
    clientId varchar(9)  NOT NULL,
    name varchar(60)  NOT NULL,
    image varchar(50)  NOT NULL,
    description varchar(60)  NOT NULL,
    CONSTRAINT playlist_pk PRIMARY KEY (playlistId),
    CONSTRAINT playlist_fk FOREIGN KEY (clientId) references Client ON DELETE RESTRICT ON UPDATE CASCADE
    );

CREATE TABLE PlaylistItem (
    playlistId varchar(9)  NOT NULL,
    sheetId varchar(9)  NOT NULL,
    CONSTRAINT playlistItem_pk PRIMARY KEY (playlistId, sheetId),
    CONSTRAINT playlistItem_fk FOREIGN KEY (playlistId) references Playlist ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT playlistItemSheet_fk FOREIGN KEY (sheetId) references Sheet ON DELETE RESTRICT ON UPDATE CASCADE
    );

CREATE TABLE Comment (
    commentId varchar(9)  NOT NULL,
    clientId varchar(9)  NOT NULL,
    sheetId varchar(9)  NOT NULL,
    dateTime date NOT NULL,
    description varchar(60)  NOT NULL,
    response varchar(90)  NOT NULL,
    likes int  NOT NULL,
    dislikes int  NOT NULL,
    CONSTRAINT playlistItem_pk PRIMARY KEY (commentId),
    CONSTRAINT playlistItem_fk FOREIGN KEY (clientId) references Client ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT playlistItemSheet_fk FOREIGN KEY (sheetId) references Sheet ON DELETE RESTRICT ON UPDATE CASCADE
    );
