const { Router } = require('express');
const router = Router();

const { getClients, getClientById, createClient, updateClient, deleteClient, getSheets, getSheetById, createSheet, updateSheet, deleteSheet } = require('../controllers/index.controller');

// Clients --
router.get('/clients', getClients);
router.get('/clients/:id', getClientById);
router.post('/clients', createClient);
router.put('/clients/:id', updateClient);
router.delete('/clients/:id', deleteClient);

// Sheets --
router.get('/sheets', getSheets);
router.get('/sheets/:id', getSheetById);
router.post('/sheets', createSheet);
router.put('/sheets/:id', updateSheet);
router.delete('/sheets/:id', deleteSheet);

module.exports = router;