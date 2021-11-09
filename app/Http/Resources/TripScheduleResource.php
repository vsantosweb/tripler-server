<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripScheduleResource extends JsonResource
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
            'uuid' =>   $this->uuid,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'has_package' => $this->has_package,
            'day_use' => $this->day_use,
            'for_adults' => $this->for_adults,
            'published' => $this->published,
            'vacancies_quantity' => $this->vacancies_quantity,
            'has_package' => $this->has_package,
            'price' => $this->price,
            'discount_percent' => $this->discount_percent,
            'purchase_limit' => $this->purchase_limit,
            'status' => $this->status->name,
            'cancellation_policie' => $this->cancellationModel->name,
            'period' => $this->period->name,
            'boarding_locations' => $this->boardingLocations->map(fn ($boarding) => [
                'id' => $boarding->id,
                'name' => $boarding->name,
            ]),

            'roadmap' => [
                'name' => $this->roadmap->name,
                'description' => $this->roadmap->description,
                'steps' =>  $this->roadmap->steps->map(fn ($step) => [
                    'title' => $step->title,
                    'type' => $step->type,
                    'event_date' => $step->event_date,
                    'description' => $step->description,
                    'values' => $step->values->map(fn ($value) => [
                        'type' => $value->type,
                        'values' => $value->value
                    ])
                ])
            ],
            'passengers' => $this->passengers->map(fn ($passenger) => [
                'id' =>  $passenger->pivot->id,
                'name' => $passenger->name,
                'amount' => $passenger->pivot->amount
            ]),
            'optional_packages' => $this->optionalPackages->map(fn ($optionalPackage) => [
                'name' => $optionalPackage->package->name,
                'description' => $optionalPackage->package->description,
                'images' => $optionalPackage->package->images,
                'price' => $optionalPackage->price,
                'quantity' => $optionalPackage->quantity,
            ]),
            
            'packages' => $this->packages->map(fn ($package) => [
                'name' => $package->name,
                'description' => $package->description,
                'quantity' => $package->quantity,
                'amount' => $package->amount,
                'shared' => $package->shared,
                'accommodation' => [
                    'name' => $package->accommodation->name,
                    'description' => $package->accommodation->description,
                    'site_url' =>  $package->accommodation->site_url,
                    'address' => $package->accommodation->address,
                    'geolocation' => $package->accommodation->geolocation,
                    'images' =>  $package->accommodation->images
                ],
                'included_items' => $package->includedItems->map(fn ($includedItem) => [
                    'name' => $includedItem->name,
                    'icon' => $includedItem->icon
                ]),

            ]),
        ];
    }
}
