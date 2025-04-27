<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');

            $table->index(['post_id', 'tag_id']);
            $table->foreign('post_id', 'post_tag_post_id_fk')
                ->on('posts')
                ->references('id')
                ->cascadeOnDelete();
            $table->foreign('tag_id', 'post_tag_tag_id_fk')
                ->on('tags')
                ->references('id')
                ->cascadeOnDelete();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('post_tag');
    }
}
