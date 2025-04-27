<?php

namespace App\Http\Controllers\Post;

use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class DestroyController extends BaseController {
    public function __invoke($id) {
        $post = Post::find($id);

        if ($post) {
            $post->is_published = false;
            $post->delete();
            return new PostResource($post);
        } else {
            return response()
                ->json(['errorMessage' => 'Пост не найден или уже удалён'], 404);
        }
    }
}
