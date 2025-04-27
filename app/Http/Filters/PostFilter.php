<?php

namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter {
    public const TITLE = 'title';
    public const CATEGORY_ID = 'category_id';
    public const CONTENT = 'content';
    public const IS_PUBLISHED = 'is_published';

    public function getCallbacks(): array {
        return [
            self::TITLE => [$this, 'title'],
            self::CATEGORY_ID => [$this, 'categoryId'],
            self::CONTENT => [$this, 'content'],
            self::IS_PUBLISHED => [$this, 'isPublished'],
        ];
    }

    public function title(Builder $builder, $value) {
        $builder->where(self::TITLE, 'like', "%{$value}%");
    }

    public function content(Builder $builder, $value) {
        $builder->where(self::CONTENT, 'like', "%{$value}%");
    }

    public function categoryId(Builder $builder, $value) {
        $builder->where(self::CATEGORY_ID, $value);
    }

    public function isPublished(Builder $builder, $value) {
        $isPublished = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $builder->where(self::IS_PUBLISHED, $isPublished);
    }
}
