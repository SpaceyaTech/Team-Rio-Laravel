<?php

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignIdFor(Image::class);
            // $table->integer('image_id');
            // $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->foreignIdFor(Post::class);
            // $table->integer('post_id');
            // $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_posts');
    }
};
