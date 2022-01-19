<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemensionArticle extends Model
{
    use HasFactory;
    public $table = "demension_article";

    protected $fillable = [
        'id',
        'demension_salt',
        'article_id',
        'demension',
        'prix_achat',
        'prix_vente',
        'is_promo',
        'promo_price',
        'promo_debut',
        'promo_fin',
        ];

        public function demension()
        {
            return $this->belongsTo(Article::class,'id','article_id');
        }
}
