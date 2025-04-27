<?php

namespace App\Http\Controllers\Post;

use App\Models\Category;
use App\Models\Tag;

class CreateController extends BaseController {

    public function __invoke() {
        $categories = Category::all();
        $tags = Tag::all();

        return view('post.create',
            [
                'tags' => $tags,
                'categories' => $categories
            ]
        );
    }
}
