<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('clients', 'Client\ClientController', ['except'=>['create', 'edit']]);
Route::resource('sheets', 'Sheet\SheetController', ['except'=>['create', 'edit']]);
Route::resource('sheetinstrument', 'SheetInstrument\SheetInstrumentController', ['only'=>['store', 'index']]);
Route::resource('playlist', 'Playlist\PlaylistController', ['except'=>['create', 'edit']]);
Route::resource('playlistitem', 'PlaylistItem\PlaylistItemController', ['only'=>['store', 'index']]);
Route::resource('comments', 'Comment\CommentController', ['except'=>['create', 'edit', 'update']]);
Route::resource('search', 'Search\SearchController', ['only'=>['index']]);

Route::delete('/playlistitem/{playlistID}/{sheetID}','PlaylistItem\PlaylistItemController@destroy')->name('playlistitem.destroy');
Route::get('/playlistitem/{playlistID}/{sheetID}','PlaylistItem\PlaylistItemController@show')->name('playlistitem.show');
Route::delete('/sheetinstrument/{playlistID}/{sheetID}','SheetInstrument\SheetInstrumentController@destroy')->name('sheetinstrument.destroy');
Route::get('/sheetinstrument/{sheetId}/{instrument}','SheetInstrument\SheetInstrumentController@show')->name('sheetinstrument.show');
Route::put('/sheetinstrument/{sheetId}/{instrument}','SheetInstrument\SheetInstrumentController@update')->name('sheetinstrument.update');
