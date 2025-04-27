<?php

namespace App\Http\Controllers\Post;

use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class RestoreController extends BaseController {
    public function __invoke($id) {
        $post = Post::onlyTrashed()->find($id);

        if ($post) {
            $post->is_published = true;
            $post->restore();
            return new PostResource($post);
        } else {
            return response()
                ->json(['errorMessage' => 'Пост не найден или уже восстановлен'], 404);
        }
    }
}
