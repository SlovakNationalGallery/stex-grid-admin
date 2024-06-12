<?php

namespace App\Http\Resources;

use App\Models\Authority;
use App\Models\Bucketlist;
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
            'title' => $this['webumenia_item']->title,
            'medium' => $this['webumenia_item']->medium ?? null, // @TODO: medium is missing in the Webumenia API v2
            'measurement' => $this['webumenia_item']->measurement ?? null, // @TODO: measurement is missing in the Webumenia API v2 
            'dating' => $this->getDating(),
            'dating_short' => $this->getDatingShort(),
            'image_src' => $this->getImageRoute(),
            'image_srcset' => collect([220, 300, 600, 800])
                ->map(fn($width) => $this->getImageRoute($width) . " ${width}w")
                ->join(', '),
            'images' => $this['webumenia_item']->images,
            'image_aspect_ratio' => $this['webumenia_item']->image_ratio,
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
        $localAuthoritiesNames = explode(', ', $this['item']->author_name);
        $webumeniaAuthorities = collect($this['webumenia_item']->authorities);
        $webumeniaAuthoritiesNames = $webumeniaAuthorities->map(fn(object $authority) => $this->formatName($authority->name));

        $filteredLocalAuthoritiesNames = collect($localAuthoritiesNames)->reject(
            fn($name) => $webumeniaAuthoritiesNames->contains($this->formatName($name))
        )->filter();

        $webumeniaAuthoritiesRoles = $webumeniaAuthorities->map(
            fn(object $authority) => $this->formatName($authority->name) .
                (!empty($authority->role) && !in_array($authority->role, ['autor', 'author'])
                    ? ' - ' . $authority->role
                    : '')
        );

        return $webumeniaAuthoritiesRoles->concat($filteredLocalAuthoritiesNames)->join(', ');
    }

    private function formatName($name)
    {
        return preg_replace('/^([^,]*),\s*(.*)$/', '$2 $1', $name);
    }    
}
