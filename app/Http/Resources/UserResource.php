<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'uuid'  => $this->uuid,
            'first_name'  => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'dob' => $this->dob,
            'age' => $this->age,
            'home_phone' => $this->home_phone,
            'mobile_phone' => $this->mobile_phone,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'zipcode' => $this->zipcode,
            'created_at'  => $this->created_at->format('d M Y, H:i a'),
            'updated_at'  => $this->updated_at->format('d M Y, H:i a')
        ];
    }
}
