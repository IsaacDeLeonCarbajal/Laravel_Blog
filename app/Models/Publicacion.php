<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "publicaciones";

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function categorias() {
        return $this->belongsToMany(Categoria::class);
    }

    public function respuestas() {
        return $this->hasMany(Comentario::class)->orderBy('created_at', 'desc');
    }

    protected function titulo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn($value) => strtolower($value)
        );
    }
}
