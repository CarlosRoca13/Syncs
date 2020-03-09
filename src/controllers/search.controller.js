import { Pool } from "pg";

src="https://code.jquery.com/jquery-3.4.1.min.js"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.min.js"

/* function search(){
    const name = document.getElementById('name').value;
    getSheet(name);
    getArtist(name);
    getPlayList(name);
} //probar funcionamiento
 */
app.get('/search',function(req,res){
    pool.query('SELECT * from playlist as p JOIN sheet as s JOIN client as c JOIN where p.name like "%'+req.query.key+'%" OR s.name like "%'+req.query.key+'%" OR c.name like "%'+req.query.key+'%"',
    function(err, rows, fields) {
    if (err) throw err;
    var data=[];
    for(i=0;i<rows.length;i++)
    {
    data.push(rows[i].name);
    }
    res.end(JSON.stringify(data));
    });
});


const getSearch = async (req, res) =>{
    const name = req.body;
    name = name.toLowerCase();
    const response = await pool.query('SELECT * from playlist as p JOIN sheet as s JOIN client as c JOIN where p.name like %$1% OR s.name like %$1% OR c.name like %$1%', name);

    res.json(response.rows);

    var data = [];
    for(i=0; i<response.rows;i++){
        data.push(rows[i].name);
    }
    //res.end(JSON.stringify(data));

    var div = document.getElementsByClassName('dropDown');
    var a = div.getElementsByTagName("a");
    
    for (elem in data){
        a.value = elem.name;
        //a.href = '/sheet/:id='+elem.id;
        //a.href = elem; poner enlace a la partitura 
    }

}; //probar funcionamiento
   
/* 

//crear metodo para los artistas
const getArtist = async (req, res)=>{
    const name = document.getElementById('name').value;
    name = name.toLowerCase();
    const response = await pool.query('SELECT * FROM client WHERE name LIKE $1', [name]);

    res.json(response.rows);

    var data = [];
    for(i=0; i<response.rows;i++){
        data.push(rows[i]);
    }
    //res.end(JSON.stringify(data));

    var div = document.getElementsByClassName('dropDown');
    var a = div.getElementsByTagName("a");
    
    for (elem in data){
        a.value = elem.name;
        a.href = '/client/:id='+elem.id;
        //a.href = elem; poner enlace a la partitura 
    }

}

//crear metodo para las playlists
const getPlayList = async (req, res)=>{
    const name = document.getElementById('name').value;
    name = name.toLowerCase();
    const response = await pool.query('SELECT * FROM playlist WHERE name LIKE $1', [name]);

    res.json(response.rows);

    var data = [];
    for(i=0; i<response.rows;i++){
        data.push(rows[i]);
    }
    //res.end(JSON.stringify(data));

    var div = document.getElementsByClassName('dropDown');
    var a = div.getElementsByTagName("a");
    
    for (elem in data){
        a.value = elem.name;
        a.href = '/playlist/:id='+elem.id;
        //a.href = elem; poner enlace a la partitura 
    }
}

module.exports = { 
    getSheet,
    getArtist,
    getPlayList

};
  */