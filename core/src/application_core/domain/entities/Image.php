<?php

namespace App\application_core\domain\entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Eloquent représentant une catégorie.
 * Correspond à la table "categorie" en base de données.
 **
 */

class Image extends Model {
    protected $table = 'image';

    public $timestamps = false;
    protected $fillable = [
        'event_id',
        'url'
    ];


    /**
     * Relation Eloquent : une catégorie possède plusieurs prestations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evenement() {
        return $this->belongsTo(Event::class, "event_id");
    }
}
