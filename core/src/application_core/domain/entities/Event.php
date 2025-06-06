<?php

namespace App\application_core\domain\entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Eloquent représentant une catégorie.
 * Correspond à la table "categorie" en base de données.
 **
 */

class Event extends Model {
    protected $table = 'Event';

    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        "price",
        "start_date",
        "end_date",
        "time",
        "category_id",
        "is_published",
        "user_id"
    ];


    /**
     * Relation Eloquent : une catégorie possède plusieurs prestations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function images() {
        return $this->hasMany(Image::class, "event_id");
    }
}
