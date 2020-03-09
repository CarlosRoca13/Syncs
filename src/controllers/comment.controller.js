const { pool } = require('./index.controller');

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
    getComments,
    getCommentById,
    createComment,
    deleteComment
}