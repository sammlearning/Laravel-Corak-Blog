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
        $table->boolean('allow_comments');
        $table->boolean('allow_register');
        $table->boolean('allow_search');
        $table->boolean('fixed_navbar');
        $table->string('facebook')->nullable();
        $table->string('instagram')->nullable();
        $table->string('youtube')->nullable();
        $table->string('twitter')->nullable();
      });

      DB::table('config')->insert([
        'blog_title' => 'Blog Name',
        'blog_description' => 'Blog description',
        'allow_comments' => 1,
        'allow_register' => 1,
        'allow_search' => 1,
        'fixed_navbar' => 1,
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
