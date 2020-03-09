const { pool } = require('./index.controller');

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

module.exports = {
    getPlaylists,
    getPlaylistById,
    createPlaylist,
    updatePlaylist,
    deletePlaylist
}