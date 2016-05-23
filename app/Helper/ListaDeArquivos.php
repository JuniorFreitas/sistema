<?php
namespace ptb\Helper;
/*
Criado por: Felipe Augusto - Felipe-FlashMaster
Vers�o 1.0
�ltima atualiza��o: 14/04/2012 �s 15:00


*/

class ListaDeArquivos
{

    // Propriedades
    public $atual = 1; // arquivo atual da lista
    private $lista = array("lixo");

    //CONSTRUTOR
    function __construct($PHP_FILES)
    {
        // separar o $_FILES[] em objetos Arquivo

        $upLoad = $PHP_FILES;
        //print_r($upLoad);
        if (is_array($upLoad['name'])) { // se foi varios arquivos
            // ir um a um
            for ($i = 0; $i < count($upLoad['name']); $i++) {
                if ($upLoad['name'][$i] != "") {
                    $arquivo = new Arquivo();
                    $arquivo->nome = $upLoad['name'][$i];
                    $arquivo->tipo = $upLoad['type'][$i];
                    $arquivo->nome_tmp = $upLoad['tmp_name'][$i];
                    $arquivo->cod_erro = $upLoad['error'][$i];
                    $arquivo->bytes = $upLoad['size'][$i];
                    $this->lista[] = $arquivo;
                }
            }

        } else {
            $arquivo = new Arquivo();
            $arquivo->nome = $upLoad['name'];
            $arquivo->tipo = $upLoad['type'];
            $arquivo->nome_tmp = $upLoad['tmp_name'];
            $arquivo->cod_erro = $upLoad['error'];
            $arquivo->bytes = $upLoad['size'];
            $this->lista[] = $arquivo;
        }

    }

    //METODOS

    public function quantidade()
    {
        return count($this->lista) - 1;
    }

    public function proximo()
    {
        if (($this->atual + 1) <= $this->quantidade()) {
            $this->atual++;
        } else {
            $this->atual = $this->quantidade();
        }
    }

    public function anterior()
    {
        if (($this->atual - 1) >= 1) {
            $this->atual--;
        } else {
            $this->atual = 1;
        }
    }

    public function arquivo()
    {
        return $this->lista[$this->atual];
    }

    /*public function tipoDoErro(){
        return "ERRO: ".$this->lista[$this->atual]->tipoDoErro();
    }

    public function nomeDoArquivo(){
        return $this->lista[$this->atual]->nomeDoArquivo();
    }

    public function nomeTmpDoArquivo(){
        return $this->lista[$this->atual]->nomeTmpDoArquivo();
    }

    public function trocarNome($novo_nome_com_extensao){
        $this->lista[$this->atual]->trocarNome($novo_nome_com_extensao);
    }

    public function extensaoDoArquivo(){  //  .jpg ,  .exe
        return $this->lista[$this->atual]->extensaoDoArquivo();
    }

    public function tamanhoDoArquivo(){
        return $this->lista[$this->atual]->tamanhoDoArquivo();
    }

    public function tipoDoArquivo(){
        return $this->lista[$this->atual]->tipoDoArquivo();
    }

    public function seForImagem(){
        return $this->lista[$this->atual]->seForImagem();
    }

    public function seForFlash(){
        return $this->lista[$this->atual]->seForFlash();
    }

    public function largura(){
        return $this->lista[$this->atual]->largura();
    }

    public function altura(){
        return $this->lista[$this->atual]->altura();
    }


    public function moverPara($caminho_com_extensao){
        return $this->lista[$this->atual]->moverPara($caminho_com_extensao);
    }

    //Metodos muito usados

    public function conferirPreferencias($extensao,$largura,$altura){
        return $this->lista[$this->atual]->conferirPreferencias($extensao,$largura,$altura);
    }

    public function arquivosValidos(){ // confere se o campo de file postado, � do tipo de arquivo que eu quero (MIME TYPE)
        return $this->lista[$this->atual]->arquivosValidos();

    }

    public function setDimensoesLimite($largura,$altura){
        $this->lista[$this->atual]->setDimensoesLimite($largura,$altura);
    }

    public function criarNovaImagemProporcional($origem,$destino,$largura,$formato) {
        return $this->lista[$this->atual]->criarNovaImagemProporcional($origem,$destino,$largura,$formato);
    }

    public function criarNovaImagemExata($origem,$destino,$largura,$altura,$formato) {
        return $this->lista[$this->atual]->criarNovaImagemExata($origem,$destino,$largura,$altura,$formato);
    }


*/

}// FIM DA CLASSE

?>