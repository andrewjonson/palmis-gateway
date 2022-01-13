<?php

namespace App\Http\Resources\v1\References;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\ApiService\v1\ToeisService\Transactions\Unit;

class DocSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $path = 'header_logos/'.$this->logo;
        if (!file_exists($path)) {
            $path = 'no_image.png';
        }
        
        $type = pathinfo(public_path('header_logos/'.$this->logo), PATHINFO_EXTENSION);
        $image = file_get_contents($path);
        return [
            'id' => hashid_encode($this->id),
            'header' => $this->header,
            'logo' => 'data:image/'.$type.';base64,'.base64_encode($image),
        ];
    }
}
