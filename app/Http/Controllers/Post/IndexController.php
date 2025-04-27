<?php

namespace App\Http\Controllers\Post;

use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\PostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class IndexController extends BaseController {

    public function __invoke(PostRequest $request) {
        $data = $request->validated();

        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);

        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        $posts = Post::filter($filter)->paginate($perPage, ['*'], 'page', $page);


        $archivedPosts = Post::onlyTrashed()->paginate(10);

        /*return view('post.index', [
            'posts' => $posts,
            'archivedPosts' => $archivedPosts
        ]);*/
        /* return PostResource::collection($posts);*/
        return response()->json([
            'data' => $posts->items(),
            'archivedPosts' => $archivedPosts->items(),
            'currentPage' => $posts->currentPage(),
            'perPage' => $perPage,
            'totalPages' => $posts->lastPage(),
            'totalPosts' => $posts->total(),
        ]);
    }
}
