<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('clients', 'Client\ClientController', ['except'=>['create', 'edit', 'show', 'update']]);
Route::resource('sheets', 'Sheet\SheetController', ['except'=>['create', 'edit', 'show']]);
Route::resource('sheetinstrument', 'SheetInstrument\SheetInstrumentController', ['only'=>['store', 'index']]);
Route::resource('playlist', 'Playlist\PlaylistController', ['except'=>['create', 'edit', 'show']]);
Route::resource('playlistitem', 'PlaylistItem\PlaylistItemController', ['only'=>['store', 'index']]);
Route::resource('comments', 'Comment\CommentController', ['except'=>['create', 'edit', 'update', 'index']]);


Route::delete('/playlistitem/{playlistID}/{sheetID}','PlaylistItem\PlaylistItemController@destroy')->name('playlistitem.destroy');
Route::get('/playlistitem/{playlistID}/{sheetID}','PlaylistItem\PlaylistItemController@show')->name('playlistitem.show');
Route::delete('/sheetinstrument/{playlistID}/{sheetID}','SheetInstrument\SheetInstrumentController@destroy')->name('sheetinstrument.destroy');
Route::post('/clients/{id}','Client\ClientController@update')->name('client.update');
Route::get('/sheetinstrument/{sheetId}/{instrument}','SheetInstrument\SheetInstrumentController@show')->name('sheetinstrument.show');
Route::get('/sheetinstrument/pdf/{sheetId}/{instrument}','SheetInstrument\SheetInstrumentController@showpdf')->name('sheetinstrument.showpdf');
Route::put('/sheetinstrument/{sheetId}/{instrument}','SheetInstrument\SheetInstrumentController@update')->name('sheetinstrument.update');
Route::get('/clients/{username}','Client\ClientController@show')->name('client.show');
Route::get('/clients/avatar/{id}','Client\ClientController@showimage')->name('client.showimage');
Route::get('/playlist/{id}','Playlist\PlaylistController@show')->name('playlist.show');
Route::get('/playlist/image/{id}','Playlist\PlaylistController@showimage')->name('playlist.showimage');
Route::get('/sheets/{id}','Sheet\SheetController@show')->name('sheet.show');
Route::get('/sheets/client/{clientid}','Sheet\SheetController@showbyclientid')->name('sheet.showbyclientid');
Route::get('/sheets/image/{id}','Sheet\SheetController@showimage')->name('sheet.showimage');
Route::get('/sheetinstrument/download/{sheetId}/{instrument}','SheetInstrument\SheetInstrumentController@downloadpdf')->name('sheetinstrument.downloadpdf');
Route::get('/clientplaylist/{id}','Search\SearchController@getplaylistartist')->name('search.getplaylistartist');
Route::get('/clientsong/{id}','Search\SearchController@getsongartist')->name('search.getsongartist');
Route::get('/search/artist/{name}','Search\SearchController@searchartist')->name('search.searchartist');
Route::get('/search/song/{name}','Search\SearchController@searchsong')->name('search.searchsong');
Route::get('/search/playlist/{name}','Search\SearchController@searchplaylist')->name('search.searchplaylist');
Route::get('/sheetinstrument/{sheetId}','SheetInstrument\SheetInstrumentController@showbysheet')->name('search.showbysheet');
Route::get('/artists', 'Sheet\SheetController@getartists')->name('search.getartists');

Route::put('/sheets/upview/{id}','Sheet\SheetController@upview')->name('sheet.upview');
Route::put('/sheets/uplike/{sheets_id}/{clients_id}','LikedSong\LikedSongController@uplike')->name('likedsong.uplike');
Route::put('/sheets/updislike/{sheets_id}/{clients_id}','DislikedSong\DislikedSongController@updislike')->name('disikedsong.updislike');
Route::put('/sheets/updownload/{id}','Sheet\SheetController@updownload')->name('sheet.updownload');
Route::put('/sheets/downlike/{sheets_id}/{clients_id}','LikedSong\LikedSongController@downlike')->name('likedsong.downlike');
Route::put('/sheets/downdislike/{sheets_id}/{clients_id}','DislikedSong\DislikedSongController@downdislike')->name('dislikedsong.downdislike');
Route::get('/sheets/getuserdislike/{sheets_id}/{clients_id}','DislikedSong\DislikedSongController@getuser')->name('dislikedsong.getuser');
Route::get('/sheets/getuserlike/{sheets_id}/{clients_id}','LikedSong\LikedSongController@getuser')->name('likedsong.getuser');

Route::get('follows/{user_id}', 'Follow\FollowController@index')->name('follow.index');
Route::get('follows/user/{user_id}', 'Follow\FollowController@r_follows')->name('follow.r_follows');
Route::get('follows/notify/{user_id}', 'Follow\FollowController@email')->name('follow.email');
Route::post('follows', 'Follow\FollowController@store')->name('follow.store');
Route::delete('follows/{user_id}/{follower_id}', 'Follow\FollowController@destroy')->name('follow.destroy');

Route::post('favorite/{sheetid}/{clientid}', 'FavoriteSong\FavoriteSongController@add')->name('favoritesong.add');
Route::delete('favorite/{sheetid}/{clientid}', 'FavoriteSong\FavoriteSongController@remove')->name('favoritesong.remove');
Route::get('favorite/{clientid}', 'FavoriteSong\FavoriteSongController@list')->name('favoritesong.list');
Route::get('favorite/{sheetid}/{clientid}', 'FavoriteSong\FavoriteSongController@isfavorite')->name('favoritesong.isfavorite');

Route::get('comments/song/{id}', 'Comment\CommentController@index')->name('comment.index');
