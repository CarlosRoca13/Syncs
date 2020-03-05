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

    const response = await pool.query('INSERT INTO sheet (name, clientId, description, pdf, key, mainGenre, likes, dislikes, views, downloads, image) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)', [
        name, 
        clientId, 
        description, 
        pdf, 
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
            sheet: {name, clientId, description, pdf, key, mainGenre, likes, dislikes, views, downloads, image}
        }
    })
};

const updateSheet = async (req, res) => {
    const id = req.params.id;
    const { name, clientId, description, pdf, key, mainGenre, likes, dislikes, views, downloads, image } = req.body;

    response = await pool.query('UPDATE Sheet SET name = $1, clientId = $2, description = $3, pdf = $4, key = $5, mainGenre = $6, likes = $7, dislikes = $8, views = $9, downloads = $10, image = $11 WHERE sheetid = $12', [
        name, 
        clientId, 
        description, 
        pdf, 
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
    getClients,
    getClientById,
    createClient,
    updateClient,
    deleteClient,
    getSheets,
    getSheetById,
    createSheet,
    updateSheet,
    deleteSheet
}    

