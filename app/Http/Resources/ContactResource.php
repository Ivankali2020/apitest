<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->photo == null || $this->created_at == null){
            $this->photo = asset('user.png');
            $this->created_at = now()->subDay(rand(1,41));
        }else{
            $this->photo = asset('user.png');
        }

        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'time' => $this->created_at->diffForHumans(),
        ];
    }
}
