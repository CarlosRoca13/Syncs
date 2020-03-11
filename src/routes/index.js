const { Router } = require('express');
const router = Router();

const { getClients, getClientById, createClient, updateClient, deleteClient } = require('../controllers/client.controller');
const { getSheets, getSheetById, createSheet, updateSheet, deleteSheet } = require('../controllers/sheet.controller');
const { getSheetInstruments, getSheetsInstrumentById, createSheetInstrument, updateSheetInstrument, deleteSheetInstrument } = require('../controllers/sheetinstrument.controller');
const { getPlaylists, getPlaylistById, createPlaylist, updatePlaylist, deletePlaylist } = require('../controllers/playlist.controller');
const { getPlaylistItems, getPlaylistItemsById, createPlaylistItem, deletePlaylistItem } = require('../controllers/playlistitem.controller');
const { getComments, getCommentById, createComment, deleteComment } = require('../controllers/comment.controller');
const { getSearch } = require('../controllers/search.controller');

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

// Search --
router.get('/search', getSearch);

module.exports = router;