const { Router } = require('express');
const router = Router();

const { getClients, 
    getClientById, 
    createClient, 
    updateClient, 
    deleteClient, 
    getSheets, 
    getSheetById, 
    createSheet, 
    updateSheet, 
    deleteSheet, 
    getSheetInstruments,
    getSheetsInstrumentById, 
    createSheetInstrument, 
    updateSheetInstrument, 
    deleteSheetInstrument,
    getPlaylists,
    getPlaylistById,
    createPlaylist,
    updatePlaylist,
    deletePlaylist,
    getPlaylistItems,
    getPlaylistItemsById,
    createPlaylistItem,
    deletePlaylistItem,
    getComments,
    getCommentById,
    createComment,
    deleteComment
} = require('../controllers/index.controller');

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

// SheetInstrument --
router.get('/sheetinstrument', getSheetInstruments);
router.get('/sheetinstrument/:sheetid', getSheetsInstrumentById);
router.post('/sheetinstrument', createSheetInstrument);
router.put('/sheetinstrument/:sheetid/:instrument', updateSheetInstrument);
router.delete('/sheetinstrument/:sheetid/:instrument', deleteSheetInstrument);

// Playlist --
router.get('/playlist', getPlaylists);
router.get('/playlist/:id', getPlaylistById);
router.post('/playlist', createPlaylist);
router.put('/playlist/:id', updatePlaylist);
router.delete('/playlist/:id', deletePlaylist);

// PlaylistItem --
router.get('/playlistitem', getPlaylistItems);
router.get('/playlistitem/:playlistid', getPlaylistItemsById);
router.post('/playlistitem', createPlaylistItem);
router.delete('/playlistitem/:playlistid/:sheetid', deletePlaylistItem);

// Comment --
router.get('/comments', getComments);
router.get('/comments/:id', getCommentById);
router.post('/comments', createComment);
router.delete('/comments/:id', deleteComment);

module.exports = router;