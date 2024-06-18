<?php

namespace App\Http\Resources;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['section']->id,
            'title' => $this['section']->title,
            'perex' => str($this['section']->perex)->markdownWithLineBreaks(),
            'text' => str($this['section']->text)->markdownWithLineBreaks(),
            'items' => ItemResource::collection($this->items()),
        ];
    }

    protected function items()
    {
        return $this['section']->items_with_position->filter(
            fn (Item $item) => !empty($this['webumenia_items'][$item->id])
        )->map(
                fn (Item $item) => [
                    'item' => $item,
                    'webumenia_item' => $this['webumenia_items'][$item->id] ?? null,
                ]
            );
    }
}
