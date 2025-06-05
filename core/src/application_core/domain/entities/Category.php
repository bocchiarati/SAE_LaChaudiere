<?php

namespace App\application_core\domain\entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Eloquent représentant une catégorie.
 * Correspond à la table "categorie" en base de données.
 **
 */

class Category extends Model {
    protected $table = 'category';

    public $timestamps = false;
    protected $fillable = ['label', 'description'];


    /**
     * Relation Eloquent : une catégorie possède plusieurs prestations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evenements() {
        return $this->hasMany(Event::class, "category_id");
    }
}
