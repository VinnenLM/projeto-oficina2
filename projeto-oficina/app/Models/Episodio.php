<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    protected $table = 'episodios';

    public $timestamps = false;

    protected $fillable = ['nome'];

    public function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }
}
