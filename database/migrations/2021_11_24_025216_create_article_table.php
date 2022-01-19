<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('ref_article');
            $table->string('nom_article');
            $table->string('demension');
            $table->text('description');
            $table->string('category');
            $table->string('color');
            $table->string('misc');
            $table->integer('prix_achat');
            $table->integer('prix_vente');
            $table->string('image_location');
            $table->text('images_article');
            $table->integer('nombre_vues')->default(0);
            $table->integer('nombres_commande')->default(0);
            $table->string('stock',5);
            $table->integer('stock_limit');
            $table->string('is_promo',10);
            $table->integer('promo_price');
            $table->string('disponibility')->default('En Stock');
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
        Schema::dropIfExists('article');
    }
}
