<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = 'series';

    public $timestamps = false;

    protected $fillable = ['nome', 'user_id'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }

}
