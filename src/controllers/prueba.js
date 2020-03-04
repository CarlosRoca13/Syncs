const { Pool } = require('pg');
const tunnel = require('tunnel-ssh');

var config = { 
    dstPort: 22, 
    user: 'al361876', 
    host: 'lynx.uji.es', 
    privateKey: 'carlitos13' 
}; 
var server = tunnel(config, function (error, server) { 
    if(error){ 
        console.log("SSH connection error: " + error); 
    } 
    console.log('database connection initalizing'); 
    const pool = new Pool({
        host: 'db-aules.uji.es',
        user: 'al361876',
        password: 'carlitos13',
        database: 'ei1050-syncs',
        port: '5432'
    }) 

    module.exports = {
        pool
    }
});

