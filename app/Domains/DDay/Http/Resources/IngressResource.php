<?php

namespace App\Domains\DDay\Http\Resources;

use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;

class IngressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function toResponse($request)
    {
        return parent::toResponse($request)
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
