const { Pool } = require('pg');

const pool = new Pool({
    host: 'localhost',
    user: 'postgres',
    password: '',
    database: 'syncs',
    port: '5432'
}) 

// Clients --
const getClients = async (req, res) => {
    const response = await pool.query('SELECT * FROM client');
    res.status(200).json(response.rows);  
};

const getClientById = async (req, res) => {
    const id = req.params.id;
    const response = await pool.query('SELECT * FROM client WHERE clientid = $1', [id]);

    res.json(response.rows);
}

const createClient = async (req, res) => {
    const { name, lastname, email, clientname, password, verified, avatar, birthday } = req.body;

    const response = await pool.query('INSERT INTO client (name, lastname, email, clientname, password, verified, avatar, birthday) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)', [
        name,  
        lastname,
        email, 
        clientname, 
        password, 
        verified, 
        avatar, 
        birthday
    ]);
    console.log(response);
    res.json({
        message: "Client Added Succesfully",
        body: {
            user: {name, lastname, email, clientname, password, verified, avatar, birthday}
        }
    })
};

const updateClient = async (req, res) => {
    const id = req.params.id;
    const { name, lastname, email, clientname, password, verified, avatar, birthday } = req.body;

    response = await pool.query('UPDATE Client SET name = $1, lastname = $2, email = $3, clientname = $4, password = $5, verified = $6, avatar = $7, birthday = $8 WHERE clientid = $9', [
        name,  
        lastname,
        email, 
        clientname, 
        password, 
        verified, 
        avatar, 
        birthday,
        id
    ]);
    console.log(response);
    res.json('Client Updated Succesfully');
}

const deleteClient = async (req, res) => {
    const id = req.params.id;
    const response = await pool.query('DELETE FROM Client WHERE clientid = $1', [id]);
    console.log(response);
    
    res.send('Client ' + id + ' deleted succesfully');
}

// Sheets --
const getSheets = async (req, res) => {
    const response = await pool.query('SELECT * FROM sheet');
    res.status(200).json(response.rows);  
};

const getSheetById = async (req, res) => {
    const id = req.params.id;
    const response = await pool.query('SELECT * FROM sheet WHERE sheetid = $1', [id]);

    res.json(response.rows);
}

const createSheet = async (req, res) => {
    const { name, clientId, description, pdf, key, mainGenre, likes, dislikes, views, downloads, image } = req.body;

    const response = await pool.query('INSERT INTO sheet (name, clientId, description, key, mainGenre, likes, dislikes, views, downloads, image) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)', [
        name, 
        clientId, 
        description, 
        key, 
        mainGenre, 
        likes, 
        dislikes, 
        views, 
        downloads, 
        image
    ]);
    console.log(response);
    res.json({
        message: "Sheet Added Succesfully",
        body: {
            sheet: {name, clientId, description, key, mainGenre, likes, dislikes, views, downloads, image}
        }
    })
};

const updateSheet = async (req, res) => {
    const id = req.params.id;
    const { name, clientId, description, pdf, key, mainGenre, likes, dislikes, views, downloads, image } = req.body;

    response = await pool.query('UPDATE Sheet SET name = $1, clientId = $2, description = $3, key = $4, mainGenre = $5, likes = $6, dislikes = $7, views = $8, downloads = $9, image = $10 WHERE sheetid = $11', [
        name, 
        clientId, 
        description, 
        key, 
        mainGenre, 
        likes, 
        dislikes, 
        views, 
        downloads, 
        image,
        id
    ]);
    console.log(response);
    res.json('Sheet Updated Succesfully');
}

const deleteSheet = async (req, res) => {
    const id = req.params.id;
    const response = await pool.query('DELETE FROM Sheet WHERE sheetid = $1', [id]);
    console.log(response);
    
    res.send('Sheet ' + id + ' deleted succesfully');
}

// SheetInstrument --
const getSheetInstruments = async (req, res) => {
    const response = await pool.query('SELECT * FROM sheetinstrument');
    res.status(200).json(response.rows);  
};

const getSheetsInstrumentById = async (req, res) => {
    const sheetid = req.params.sheetid;
    const response = await pool.query('SELECT * FROM sheetinstrument WHERE sheetid = $1', [sheetid]);

    res.json(response.rows);
}

const createSheetInstrument = async (req, res) => {
    const { sheetid, instrument, effects, pdf } = req.body;

    const response = await pool.query('INSERT INTO sheetinstrument (sheetId, instrument, effects, pdf) VALUES ($1, $2, $3, $4)', [
        sheetid,
        instrument,
        effects,
        pdf
    ]);
    console.log(response);
    res.json({
        message: "Sheet Instrument Added Succesfully",
        body: {
            sheet: {sheetid, instrument, effects, pdf}
        }
    })
};

const updateSheetInstrument = async (req, res) => {
    const sheetid = req.params.sheetid;
    const instrument = req.params.instrument;
    const { effects, pdf } = req.body;

    response = await pool.query('UPDATE Sheetinstrument SET effects = $1, pdf = $2 WHERE sheetid = $3 and instrument = $4', [
        effects,
        pdf,
        sheetid,
        instrument
    ]);
    console.log(response);
    res.json('Sheet Instrument Updated Succesfully');
}

const deleteSheetInstrument = async (req, res) => {
    const sheetid = req.params.sheetid;
    const instrument = req.params.instrument;
    const response = await pool.query('DELETE FROM Sheetinstrument WHERE sheetid = $1 and instrument = $2', [sheetid, instrument]);
    console.log(response);
    
    res.send('Sheet from ' + sheetid + ' deleted succesfully');
}

// Playlist --
const getPlaylists = async (req, res) => {
    const response = await pool.query('SELECT * FROM playlist');
    res.status(200).json(response.rows);  
};

const getPlaylistById = async (req, res) => {
    const id = req.params.id;
    const response = await pool.query('SELECT * FROM playlist WHERE playlistid = $1', [id]);

    res.json(response.rows);
}

const createPlaylist = async (req, res) => {
    const { clientid, name, image, description } = req.body;

    const response = await pool.query('INSERT INTO playlist (clientid, name, image, description) VALUES ($1, $2, $3, $4)', [
        clientid, 
        name, 
        image, 
        description
    ]);
    console.log(response);
    res.json({
        message: "Playlist Added Succesfully",
        body: {
            playlist: {clientid, name, image, description}
        }
    })
};

const updatePlaylist = async (req, res) => {
    const id = req.params.id;
    const { clientid, name, image, description } = req.body;

    response = await pool.query('UPDATE playlist SET clientId = $1, name = $2, image = $3, description = $4 WHERE playlistid = $5', [
        clientid, 
        name, 
        image, 
        description,
        id
    ]);
    console.log(response);
    res.json('Playlist Updated Succesfully');
}

const deletePlaylist= async (req, res) => {
    const id = req.params.id;
    const response = await pool.query('DELETE FROM playlist WHERE playlistid = $1', [id]);
    console.log(response);
    
    res.send('Playlist ' + id + ' deleted succesfully');
}

// PlaylistItem --
const getPlaylistItems = async (req, res) => {
    const response = await pool.query('SELECT * FROM playlistitem');
    res.status(200).json(response.rows);  
};

const getPlaylistItemsById = async (req, res) => {
    const playlistid = req.params.playlistid;
    const response = await pool.query('SELECT * FROM playlistitem WHERE playlistid = $1', [playlistid]);

    res.json(response.rows);
}

const createPlaylistItem = async (req, res) => {
    const { playlistid, sheetid } = req.body;

    const response = await pool.query('INSERT INTO playlistitem (playlistid, sheetid) VALUES ($1, $2)', [
        playlistid, 
        sheetid
    ]);
    console.log(response);
    res.json({
        message: "Playlist Sheet Added Succesfully",
        body: {
            playlist: {playlistid, sheetid}
        }
    })
};

const deletePlaylistItem = async (req, res) => {
    const playlistid = req.params.playlistid;
    const sheetid = req.params.sheetid;
    const response = await pool.query('DELETE FROM playlistitem WHERE playlistid = $1 and sheetid = $2', [playlistid, sheetid]);
    console.log(response);
    
    res.send('Playlist from ' + playlistid + ' deleted succesfully');
}

// Comment --
const getComments = async (req, res) => {
    const response = await pool.query('SELECT * FROM comment');
    res.status(200).json(response.rows);  
};

const getCommentById = async (req, res) => {
    const id = req.params.id;
    const response = await pool.query('SELECT * FROM comment WHERE commentid = $1', [id]);

    res.json(response.rows);
}

const createComment = async (req, res) => {
    const { clientid, sheetid, dateTime, description, response, likes, dislikes } = req.body;

    const resp = await pool.query('INSERT INTO comment (clientid, sheetid, dateTime, description, response, likes, dislikes) VALUES ($1, $2, $3, $4, $5, $6, $7)', [
        clientid, 
        sheetid, 
        dateTime, 
        description, 
        response, 
        likes, 
        dislikes
    ]);
    console.log(resp);
    res.json({
        message: "Comment Added Succesfully",
        body: {
            comment: {clientid, sheetid, dateTime, description, response, likes, dislikes}
        }
    })
};

const deleteComment = async (req, res) => {
    const id = req.params.id;
    const response = await pool.query('DELETE FROM comment WHERE commentid = $1', [id]);
    console.log(response);
    
    res.send('Comment ' + id + ' deleted succesfully');
}

module.exports = {
    getClients,
    getClientById,
    createClient,
    updateClient,
    deleteClient,
    getSheets,
    getSheetById,
    createSheet,
    updateSheet,
    deleteSheet,
    getSheetInstruments,
    getSheetsInstrumentById,
    createSheetInstrument,
    updateSheetInstrument,
    deleteSheetInstrument,
    getPlaylists,
    getPlaylistById,
    createPlaylist,
    updatePlaylist,
    deletePlaylist,
    getPlaylistItems,
    getPlaylistItemsById,
    createPlaylistItem,
    deletePlaylistItem,
    getComments,
    getCommentById,
    createComment,
    deleteComment
}    

