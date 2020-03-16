const { pool } = require('./index.controller');

const getSearch = async (req, res) =>{
    const { name }= req.body;
    //name = name.toLowerCase();
    const response = await pool.query("SELECT COALESCE(s.name, 'NO RESULTS') as sheet, COALESCE(c.name, 'NO RESULTS') as client, COALESCE(p.name, 'NO RESULTS') as playlist FROM sheet as s FULL JOIN client as c USING(name) FULL JOIN playlist as p USING(name)WHERE name like $1", ['%' + name + '%']);

    res.status(200).json(response.rows);
        

} //probar funcionamiento

module.exports = { 
    getSearch
}
