<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Tag\TagResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request) {
        return [
            'id' => $this->id ?? "",
            'content' => $this->content ?? "",
            'title' => $this->title ?? "",
            'category' =>  new CategoryResource($this->category),
            'tags' =>  TagResource::collection($this->tags),
            'is_published' => $this->is_published ?? "",
        ];
    }
}
