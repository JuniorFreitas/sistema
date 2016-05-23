<?php

namespace ptb;

use Illuminate\Database\Eloquent\Model;
use ptb\Helper\DataHora;

class Banner extends Model
{
    protected $table = 'banner';

    public $timestamps = false;

    protected $fillable = [
        'usuarios_id',
        'titulo_banner',
        'url_banner',
        'img_banner',
        'data_banner',
        'ativo_banner',
        'contador_banner',
        'qnt_banner',
    ];
    protected $guarded = ['id'];

    public function dataHoraCriado()
    {
        $data = new DataHora($this->data_banner);
        return $data->dataCompleta() . ' às ' . $data->hora() . ':' . $data->minuto();
    }

    public function dataHoraAtualizado()
    {
        $data = new DataHora($this->data_banner);
        return $data->dataCompleta() . ' às ' . $data->hora() . ':' . $data->minuto();
    }

    public function usuario()
    {
        return $this->hasOne('ptb\User', 'id', 'usuarios_id');
    }
}
