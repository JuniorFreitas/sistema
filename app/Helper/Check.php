<?php
namespace ptb\Helper;

use sistema\Categoria;
use sistema\User;

class Check{

	public function CategoriaId($id){
		$Categoria = Categoria::find($id);
		return $Categoria->categoria;
	}

}