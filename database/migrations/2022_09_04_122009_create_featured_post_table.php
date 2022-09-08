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
      Schema::create('featured_post', function (Blueprint $table) {
        $table->boolean('status');
        $table->integer('post_id');
      });

      DB::table('featured_post')->insert([
        'status' => 0,
        'post_id' => 0,
      ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('featured_post');
    }
};
