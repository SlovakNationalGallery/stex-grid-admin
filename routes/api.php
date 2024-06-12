<?php

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/items/{id}', function (string $id) {
    $item = Item::find($id) ?: new Item();
    $response = Http::webumenia()->get("/v2/items/$id");

    if (!isset($response->object()->data)) {
        throw new NotFoundHttpException();
    }

    $data = $response->object()->data;
    return new ItemResource([
        'item' => $item,
        'webumenia_item' => $data,
    ]);
});
