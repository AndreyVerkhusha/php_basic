<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends BaseModel {
    protected $guarded = [];

    public function posts(): HasMany {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
