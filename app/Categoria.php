<?php

namespace ptb;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'tipos';
    public $timestamps = false;

    protected $fillable = [
        'nome_tipos',
        'slug_tipos',
        'ativo_tipos',
    ];
    protected $guarded = ['id'];

}
