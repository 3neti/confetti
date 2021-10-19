<?php

namespace App\Domains\Demo\Http\Resources;

use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;

class DemoRegisterResource extends JsonResource
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
        $status_code = $this->get('contact')->wasRecentlyCreated ? Response::HTTP_CREATED : Response::HTTP_ALREADY_REPORTED;

        return parent::toResponse($request)
            ->setStatusCode($status_code);
    }
}
