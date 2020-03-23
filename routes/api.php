<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('clients', 'Client\ClientController', ['except'=>['create', 'edit']]);
Route::resource('sheets', 'Sheet\SheetController', ['except'=>['create', 'edit']]);
Route::resource('sheetinstrument', 'SheetInstrument\SheetInstrumentController', ['except'=>['create', 'edit']]);
Route::resource('playlist', 'Playlist\PlaylistController', ['except'=>['create', 'edit']]);
Route::resource('playlistitem', 'PlaylistItem\PlaylistItemController', ['except'=>['create', 'edit', 'update']]);
Route::resource('comments', 'Comment\CommentController', ['except'=>['create', 'edit', 'update']]);
Route::resource('search', 'Search\SearchController', ['except'=>['create', 'store', 'show', 'edit', 'update', 'destroy']]);
