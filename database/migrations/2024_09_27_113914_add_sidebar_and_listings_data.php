<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSidebarAndListingsData extends Migration
{
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->string('title');
            $table->text('description');
            $table->string('image');
        });

        Schema::table('sidebar', function (Blueprint $table) {
            $table->string('title');
            $table->text('description');
        });

        // Add some sample data
        DB::table('listings')->insert([
            ['title' => 'Listing 1', 'description' => 'This is listing 1', 'image' => 'image1.jpg'],
            ['title' => 'Listing 2', 'description' => 'This is listing 2', 'image' => 'image2.jpg'],
        ]);

        DB::table('sidebar')->insert([
            ['title' => 'Sidebar 1', 'description' => 'This is sidebar 1'],
            ['title' => 'Sidebar 2', 'description' => 'This is sidebar 2'],
        ]);
    }

    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('description');
            $table->dropColumn('image');
        });

        Schema::table('sidebar', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('description');
        });
    }
}
