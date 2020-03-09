const { pool } = require('./index.controller');

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

module.exports = {
    getPlaylistItems,
    getPlaylistItemsById,
    createPlaylistItem,
    deletePlaylistItem
}