<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Upload;

class AppSetupCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'type' => $data->type,
                   'value' => $data->type == 'verification_form' ? json_decode($data->value) : ( is_numeric($data->value) ? ( Upload::where('id','=',$data->value)->first() ? (Upload::where('id',$data->value)->first()->file_name) : $data->value) : $data->value),
                    
                ];
            })
        ];
    }
// ($data->type == 'app_logo' || $data->type == 'splash_image' || $data->type == 'login_image' || $data->type == 'registration_image' || $data->type == 'square_logo' || $data->type == 'placeholder_image'     )
    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
