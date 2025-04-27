<?php

namespace App\Services\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use DB;
use Exception;
use Log;

class Service {
    public function store($data) {
        try {
            DB::beginTransaction();

            $tags = $data['tags'];
            $category = $data['category'];
            unset($data['tags'], $data['category']);

            $data['category_id'] = $this->getCategoryIdWithUpdate($category);
            $tagsIds = $this->getTagsIdsWithUpdate($tags);

            $post = Post::create($data);
            $post->tags()->attach($tagsIds);

            DB::commit();

            return $post->fresh();
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function update($data, $post) {
        try {
            DB::beginTransaction();

            $tags = $data['tags'];
            $category = $data['category'];
            unset($data['tags'], $data['category']);

            $data['category_id'] = $this->getCategoryIdWithUpdate($category);
            $tagsIds = $this->getTagsIdsWithUpdate($tags);

            $post->update($data);
            $post->tags()->sync($tagsIds);

            DB::commit();

            return $post->fresh();
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception->getMessage();
        }
    }

    private function getCategoryIdWithUpdate($category) {
        if (!isset($category['id'])) {
            $category = Category::create($category);
        } else {
            $currentCategory = Category::find($category['id']);
            $currentCategory->update($category);
            $category = $currentCategory->fresh();
        }

        return $category->id;
    }

    private function getTagsIdsWithUpdate($tags): array {
        $tagsIds = [];

        if (empty($tags)) {
            return $tagsIds;
        }

        foreach ($tags as $tag) {
            if (!isset($tag['id'])) {
                $tag = Tag::create($tag);
            } else {
                $currentTag = Tag::find($tag['id']);
                $currentTag->update($tag);
                $tag = $currentTag->fresh();
            }

            $tagsIds[] = $tag['id'];
        }

        return $tagsIds;
    }
}
