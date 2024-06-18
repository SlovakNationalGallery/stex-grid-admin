<?php

namespace App\Http\Resources;

use App\Models\Authority;
use App\Models\Bucketlist;
use Illuminate\Support\Arr;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['item']->id,
            'author' => $this->getAuthor(),
            'x' => $this['item']->x,
            'y' => $this['item']->y,
            'span_x' => $this['item']->span_x,
            'span_y' => $this['item']->span_y,
            'title' => !empty($this['item']->title) ? $this['item']->title : $this['webumenia_item']->title,
            'medium' => !empty($this['item']->medium) ? $this['item']->medium : $this['webumenia_item']->medium,
            'measurement' => !empty($this['item']->measurement) ? $this['item']->measurement : Arr::first($this['webumenia_item']->measurements),
            'dating' => !empty($this['item']->dating) ? $this['item']->dating : $this->getDating(),
            'dating_short' => $this->getDatingShort(),
            'image_src' => $this->getImageRoute(),
            'images' => $this['webumenia_item']->images,
            'image_aspect_ratio' => $this['webumenia_item']->image_ratio,
            'ord' => $this->when(isset($this['item']->pivot->ord), $this['item']->pivot->ord ?? null),
        ];
    }

    private function getImageRoute($width = 600)
    {
        return config('services.webumenia.url') . '/dielo/nahlad/' . $this['webumenia_item']->id . '/' . $width;
    }

    private function getDatingRaw()
    {
        return $this['webumenia_item']->date_earliest === $this['webumenia_item']->date_latest
            ? $this['webumenia_item']->date_earliest
            : $this['webumenia_item']->date_earliest . '–' . $this['webumenia_item']->date_latest;
    }

    private function getDating()
    {
        if (\App::currentLocale() == 'sk') {
            return $this['webumenia_item']->dating;
        }

        return $this->getDatingRaw();
    }

    private function getDatingShort()
    {
        if (\App::currentLocale() == 'sk') {
            return Str($this['webumenia_item']->dating)
                ->afterLast(',')
                ->squish();
        }

        return $this->getDatingRaw();
    }

    private function getAuthor()
    {
        if (!empty($this['item']->author)) {
            return $this['item']->author;
        }
        $webumeniaAuthorities = collect($this['webumenia_item']->authorities);
        $webumeniaAuthoritiesNames = $webumeniaAuthorities->map(fn (object $authority) => $this->formatName($authority->name));

        $webumeniaAuthoritiesRoles = $webumeniaAuthorities->map(
            fn (object $authority) => $this->formatName($authority->name) .
                (!empty($authority->role) && !in_array($authority->role, ['autor', 'author'])
                    ? ' - ' . $authority->role
                    : '')
        );

        return $webumeniaAuthoritiesRoles->join(', ');
    }

    private function formatName($name)
    {
        return preg_replace('/^([^,]*),\s*(.*)$/', '$2 $1', $name);
    }
}
