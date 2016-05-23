<?php

namespace ptb;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    public $timestamps = false;

    protected $fillable = [
        'nome_menu',
        'posicao_menu',
        'slug_menu',
        'ativo_menu',
    ];
    protected $guarded = ['id'];
}
