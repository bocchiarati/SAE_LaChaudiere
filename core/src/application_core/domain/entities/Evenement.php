<?php

namespace app\application_core\domain\entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Eloquent représentant une catégorie.
 * Correspond à la table "categorie" en base de données.
 **
 */

class Evenement extends Model {
    protected $table = 'categorie';

    public $timestamps = false;
    protected $fillable = ['libelle', 'description'];


    /**
     * Relation Eloquent : une catégorie possède plusieurs prestations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorie() {
        return $this->belongsTo(Categorie::class, "categorie_id");
    }
    public function images() {
        return $this->hasMany(Image::class, "evenement_id");
    }
}
