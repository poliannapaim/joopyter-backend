<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\Track;
use App\Http\Resources\TrackResource;
use App\Http\Resources\ArtistResource;
use App\Http\Resources\TrackCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
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
            'artist' => (new ArtistResource($this->user)),
            'album' => [
                'title' => $this->title,
                'cover_pic' => $this->cover_pic,
                'release_date' => Carbon::createFromFormat('Y-m-d', $this->release_date)->format('d/m/Y')
            ],
            'tracks' => TrackResource::collection($this->tracks)->sortBy(['number', 'asc'])
        ];
    }
}