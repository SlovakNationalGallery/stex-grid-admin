<?php

use App\Models\Item;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Pool;
use App\Http\Resources\ItemResource;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\SectionResource;
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
})->name('api.items.show');

// Route::get('/items', function () {
//     $items = Item::all()->take(30);
//     $promises = [];

//     $responses = Http::pool(
//         fn (Pool $pool) => $items->map(
//             fn (Item $item) => $pool
//                 ->as($item->id)
//                 ->webumenia()
//                 ->get("/v2/items/{$item->id}")
//         )
//     );

//     $resultItems = [];

//     foreach ($items as $item) {
//         $response = $responses[$item->id];
//         if (empty($response->object()->data)) {
//             continue;
//         }
//         $resultItems[] = [
//             'item' => $item,
//             'webumenia_item' => $response->object()->data,
//         ];
//     }

//     return ItemResource::collection($resultItems);
// });

Route::get('/items', function () {
    return ['data' => Item::all()];
});

Route::get('/sections', function () {    
    $sections = Section::with('items')->get();

    foreach ($sections as $section) {
        $response = Http::webumenia()->get("/v2/items/", [
            'ids' => $section->items->pluck('id')->toArray(),
            'size' => 100,
        ]);

        $resultSections[] = [
            'section' => $section,
            'webumenia_items' => collect($response->object()->data)->keyBy('id'),
        ];
    }
    return SectionResource::collection($resultSections);
});


Route::put('/items/{id}', function (string $id, Request $request) {
    $item = Item::find($id) ?: new Item();
    $item->fill($request->all());
    $item->save();
    return $item;

    // return new ItemResource([
    //     'item' => $item,
    //     'webumenia_item' => [],
    // ]);
});
