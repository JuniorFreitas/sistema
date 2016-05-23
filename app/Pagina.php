<?php

namespace ptb;

use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    protected $table = 'pagina';

    public $timestamps = false;

    protected $fillable = [
        'nome_pagina',
        'conteudo_pagina',
        'url_pagina',
        'menu_pagina',
        'ativo_pagina',
        'menu_id',
    ];
    protected $guarded = ['id'];

    public function cat()
    {
        return $this->hasOne('ptb\Menu', 'id', 'menu_id');
    }

}
