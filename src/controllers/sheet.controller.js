const { pool } = require('./index.controller');

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

module.exports = {
    getSheets,
    getSheetById,
    createSheet,
    updateSheet,
    deleteSheet
}