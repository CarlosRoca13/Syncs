const { Router } = require('express');
const router = Router();

const { getClients, getClientById, createClient, updateClient, deleteClient } = require('../controllers/index.controller');

// Clients --
router.get('/clients', getClients);
router.get('/clients/:id', getClientById);
router.post('/clients', createClient);
router.put('/clients/:id', updateClient);
router.delete('/clients/:id', deleteClient);

module.exports = router;