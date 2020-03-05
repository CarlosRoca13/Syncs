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

module.exports = {
    getClients,
    getClientById,
    createClient,
    updateClient,
    deleteClient
}    

