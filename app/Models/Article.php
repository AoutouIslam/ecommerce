<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $table = "articles";
    use HasFactory;

    protected $fillable = [
        'ref_article',
        'article_salt',
        'nom_article',
        'description',
        'category',
        'color',
        'misc',
        'rating',
        'review_count',
        'images_article',
        'image_location',
        'nombre_vues',
        'stock',
        'stock_limit',
        'is_promo',
        'promo_price',
        'promo_debut',
        'promo_fin',
    ];

    protected $with = ['demensions'];
    public function demension()
    {
        return $this->hasMany(DemensionArticle::class,'article_id','id')->get();
    }


    public function demensions()
    {
        return $this->hasMany(DemensionArticle::class,'article_id','id');
    }
    public function first_demension()
    {
        return $this->hasOne(DemensionArticle::class,'article_id','id')->orderBy('id', 'asc');
    }
    public function first_demension0()
    {
        return $this->hasOne(DemensionArticle::class,'article_id','id');
    }
}
