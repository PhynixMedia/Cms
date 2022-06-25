<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebPageTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_page_templates', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('url')->unique();
            $table->string('label');
            $table->integer('parent');
            $table->string('layout');
            $table->integer('category')->nullable();
            $table->longText('meta_title');
            $table->longText('meta_description');
            $table->longText('meta_keywords');
            $table->integer('header_position');
            $table->integer('footer_position');
            $table->integer('page_order');
            $table->integer('status');
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
        Schema::dropIfExists('web_page_templates');
    }
}
