<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class UpdateController extends BaseController {

    public function __invoke(UpdateRequest $request, Post $post) {
        $data = $request->validated();

        try {
            $post = $this->service->update($data, $post);

            return new PostResource($post);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 400);
        }
    }
}
