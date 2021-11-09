<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'agency_name' => $this->agency->name,
            'agency_avatar' => $this->agency->avatar,
            'name' => $this->name,
            'slug' => $this->slug,
            'rating' => mt_rand(2.4, 5),
            'description' => $this->description,
            'price_from' =>  min($this->schedules->map(fn ($schedule) => $schedule->price)->toArray()),
            'schedules_count' => $this->schedules()->count(),
            'schedules' => $this->whenLoaded('schedules', fn () => $this->schedules->map(fn ($schedule) => new TripScheduleResource($schedule))),
            'thumbnail' => $this->images[0],
            'images' => $this->images,
        ];
    }
}
