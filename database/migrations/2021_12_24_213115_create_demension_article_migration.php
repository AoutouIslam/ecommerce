<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemensionArticleMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demension_article', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained();
            $table->string('demension');
            $table->integer('prix_achat');
            $table->integer('prix_vente');
            $table->string('is_promo',10)->default('no');
            $table->integer('promo_price')->default(0);
            $table->dateTime('promo_debut')->nullable();
            $table->dateTime('promo_fin')->nullable();
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
        Schema::dropIfExists('demension_article_migration');
    }
}
