<?php

namespace App\Http\Controllers\Post;

use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class ShowController extends BaseController {
    public function __invoke(Post $post) {
        $tags = Tag::all();
        $categories = Category::all()->keyBy('id');

        return new PostResource($post);
       /* return view('post.show',
            [
                'post' => $post,
                'categories' => $categories,
                'tags' => $tags,
            ]
        );*/
    }
}
