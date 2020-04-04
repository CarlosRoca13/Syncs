<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('clients', 'Client\ClientController', ['except'=>['create', 'edit', 'show']]);
Route::resource('sheets', 'Sheet\SheetController', ['except'=>['create', 'edit', 'show']]);
Route::resource('sheetinstrument', 'SheetInstrument\SheetInstrumentController', ['only'=>['store', 'index']]);
Route::resource('playlist', 'Playlist\PlaylistController', ['except'=>['create', 'edit', 'show']]);
Route::resource('playlistitem', 'PlaylistItem\PlaylistItemController', ['only'=>['store', 'index']]);
Route::resource('comments', 'Comment\CommentController', ['except'=>['create', 'edit', 'update']]);
Route::resource('search', 'Search\SearchController', ['only'=>['index']]);

Route::delete('/playlistitem/{playlistID}/{sheetID}','PlaylistItem\PlaylistItemController@destroy')->name('playlistitem.destroy');
Route::get('/playlistitem/{playlistID}/{sheetID}','PlaylistItem\PlaylistItemController@show')->name('playlistitem.show');
Route::delete('/sheetinstrument/{playlistID}/{sheetID}','SheetInstrument\SheetInstrumentController@destroy')->name('sheetinstrument.destroy');
Route::get('/sheetinstrument/{sheetId}/{instrument}','SheetInstrument\SheetInstrumentController@show')->name('sheetinstrument.show');
Route::get('/sheetinstrument/pdf/{sheetId}/{instrument}','SheetInstrument\SheetInstrumentController@showpdf')->name('sheetinstrument.showpdf');
Route::put('/sheetinstrument/{sheetId}/{instrument}','SheetInstrument\SheetInstrumentController@update')->name('sheetinstrument.update');
Route::get('/clients/{username}','Client\ClientController@show')->name('client.show');
Route::get('/clients/avatar/{username}','Client\ClientController@showimage')->name('client.showimage');
Route::get('/playlist/{id}','Playlist\PlaylistController@show')->name('playlist.show');
Route::get('/playlist/image/{id}','Playlist\PlaylistController@showimage')->name('playlist.showimage');
Route::get('/sheets/{id}','Sheet\SheetController@show')->name('sheet.show');
Route::get('/sheets/image/{id}','Sheet\SheetController@showimage')->name('sheet.showimage');
Route::get('/sheetinstrument/download/{sheetId}/{instrument}','SheetInstrument\SheetInstrumentController@downloadpdf')->name('sheetinstrument.downloadpdf');
