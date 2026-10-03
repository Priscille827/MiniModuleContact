<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class DemandeContact extends Model
{
    use SoftDeletes;

    protected $table = 'demandes_contact';

    protected $fillable = [
        'numero_demande', 'nom', 'email', 'id_service', 'message', 'statut',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }

    /** Génère un numéro unique : DEM-2026-0001 */
    public static function genererNumero(): string
    {
        do {
            $suffixe = strtoupper(Str::random(4));
            $numero  = sprintf('DEM-%s-%s', date('Y'), $suffixe);
        } while (self::where('numero_demande', $numero)->exists());

        return $numero;
    }

}