const { pool } = require('./index.controller');

// SheetInstrument --
const getSheetInstruments = async (req, res) => {
    const response = await pool.query('SELECT * FROM sheetinstrument');
    res.status(200).json(response.rows);  
};

const getSheetsInstrumentById = async (req, res) => {
    const sheetid = req.params.sheetid;
    const response = await pool.query('SELECT * FROM sheetinstrument WHERE sheetid = $1', [sheetid]);

    res.json(response.rows);
}

const createSheetInstrument = async (req, res) => {
    const { sheetid, instrument, effects, pdf } = req.body;

    const response = await pool.query('INSERT INTO sheetinstrument (sheetId, instrument, effects, pdf) VALUES ($1, $2, $3, $4)', [
        sheetid,
        instrument,
        effects,
        pdf
    ]);
    console.log(response);
    res.json({
        message: "Sheet Instrument Added Succesfully",
        body: {
            sheet: {sheetid, instrument, effects, pdf}
        }
    })
};

const updateSheetInstrument = async (req, res) => {
    const sheetid = req.params.sheetid;
    const instrument = req.params.instrument;
    const { effects, pdf } = req.body;

    response = await pool.query('UPDATE Sheetinstrument SET effects = $1, pdf = $2 WHERE sheetid = $3 and instrument = $4', [
        effects,
        pdf,
        sheetid,
        instrument
    ]);
    console.log(response);
    res.json('Sheet Instrument Updated Succesfully');
}

const deleteSheetInstrument = async (req, res) => {
    const sheetid = req.params.sheetid;
    const instrument = req.params.instrument;
    const response = await pool.query('DELETE FROM Sheetinstrument WHERE sheetid = $1 and instrument = $2', [sheetid, instrument]);
    console.log(response);
    
    res.send('Sheet from ' + sheetid + ' deleted succesfully');
}

module.exports = {
    getSheetInstruments,
    getSheetsInstrumentById,
    createSheetInstrument,
    updateSheetInstrument,
    deleteSheetInstrument
}