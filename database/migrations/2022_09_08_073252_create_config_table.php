<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
      Schema::create('config', function (Blueprint $table) {
        $table->string('blog_title');
        $table->string('blog_description');
        $table->boolean('allow_comments')->default(1);
        $table->boolean('allow_register')->default(1);
        $table->boolean('allow_search')->default(1);
        $table->boolean('fixed_navbar')->default(1);
        $table->foreignId('featured_post')->nullable()->constrained('posts');
        $table->string('facebook')->nullable();
        $table->string('instagram')->nullable();
        $table->string('youtube')->nullable();
        $table->string('twitter')->nullable();
        $table->string('footer01')->default('Highlights');
        $table->string('footer02')->default('Useful');
      });

      DB::table('config')->insert([
        'blog_title' => 'Blog Name',
        'blog_description' => 'Blog description',
      ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config');
    }
};
