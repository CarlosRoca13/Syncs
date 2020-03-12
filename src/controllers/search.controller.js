const { pool } = require('./index.controller');

const getSearch = async (req, res) =>{
    const name = req.params.body;
    //name = name.toLowerCase();
    const response = pool.query('SELECT s.name, c.name, p.name FROM sheet as s FULL JOIN client as c USING(name) FULL JOIN playlist as p USING(name)WHERE name like $1', ['%' + name + '%']);

    res.json(response.rows);

} //probar funcionamiento

module.exports = { 
    getSearch
}
