<?php
namespace ptb\Helper;
/*
Criado por: Master Tag Desenvolvimento Web Ltda.
Vers�o 1.4.2
�ltima atualiza��o: 19/08/2012 �s 15:44

- confere largura e altura da imagem, caso seja enviado via upLoad do Fash
- criacao do metodo maiorComprimento(), usado para criar imagens proporcionais
- craiacao do metodo layout(), para saber se a imagem � quadrada, retrato, ou paisagem

*/
class Arquivo
{
    // Propriedades
    private $altura_limit = 3000;
    private $largura_limite = 3000;

    public $largura_imagem = -1;// se for imagem
    public $altura_imagem = -1;// se for imagem
    public $nome = "";
    public $tipo = "";
    public $nome_tmp = "";
    public $cod_erro = 0;
    public $bytes = 0;

    public $url_marcaDagua = "";

    // MIME_TYPE ARQUIVOS
    public static $MIME_JPG = "image/jpeg";
    public static $MIME_PDF = "application/pdf";
    public static $MIME_DOCX = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
    public static $MIME_DOC = "application/msword";
    public static $MIME_PPT = "application/vnd.ms-powerpoint"; // power point
    public static $MIME_TXT = "text/plain";

    //CONSTRUTOR
    function __construct()
    {
    }

    //METODOS

    public function nomeDoArquivo()
    {
        if ($this->tipoDoErro() == 0) { // se nao tiver nenhum erro
            return $this->nome;
        }
    }

    // nome do arquivo sem extensao
    public function nomeDoArquivoPuro()
    {
        if ($this->tipoDoErro() == 0) { // se nao tiver nenhum erro
            $indice = strrpos($this->nomeDoArquivo(), '.');
            return substr($this->nomeDoArquivo(), 0, $indice);
        }
    }

    public function nomeTmpDoArquivo()
    {
        if ($this->tipoDoErro() == 0) { // se nao tiver nenhum erro
            return $this->nome_tmp;
        } else {
            echo $this->tipoDoErro();
        }
    }

    public function trocarNome($novo_nome_com_extensao)
    {
        $this->nome = $novo_nome_com_extensao;
    }

    public function extensaoDoArquivo()
    {  //  .jpg ,  .exe
        $indice = strrpos($this->nomeDoArquivo(), '.');
        return strtolower(substr($this->nomeDoArquivo(), $indice));
    }

    public function tamanhoDoArquivo()
    {
        if ($this->tipoDoErro() == 0) { // se nao tiver nenhum erro
            return $this->bytes;
        } else {
            echo $this->tipoDoErro();
        }
    }

    public function tipoDoErro()
    {
        return $this->cod_erro;
    }

    public function tipoDoArquivo()
    {
        if ($this->tipoDoErro() == 0) { // se nao tiver nenhum erro
            $file = $this->nomeTmpDoArquivo();
            $finfo = new finfo(FILEINFO_MIME);
            $mime = $finfo->file($file, FILEINFO_MIME);
            $partes = explode('; ', $mime);
            return $partes[0];
        } else {
            echo $this->tipoDoErro();
        }
    }

    public function seForImagem()
    {

        if ($this->tipoDoArquivo() == self::$MIME_JPG) {
            if ($this->largura_imagem == -1 && $this->altura_imagem == -1) {
                $this->pegarLarguraAltura(); // calcular
            }
            return true;
        } else {
            return false;
        }
    }

    public function seForTipo($TIPO_MIME)
    {
        if ($this->tipoDoArquivo() == $TIPO_MIME) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function pegarLarguraAltura()
    {

        $tamanhos = getimagesize($this->nomeTmpDoArquivo());
        $this->largura_imagem = $tamanhos[0];
        $this->altura_imagem = $tamanhos[1];

    }

    public function seForImagemFlash()
    {

        $mime = mime_content_type($this->nomeTmpDoArquivo());

        $tipo = substr($mime, 0, 5);
        if ($tipo == "image") {
            if ($this->largura_imagem == -1 && $this->altura_imagem == -1) {
                $this->pegarLarguraAltura(); // calcular
            }
            return true;
        } else {
            return false;
        }

    }

    public function seForFlash()
    {
        $tipo = substr($this->tipoDoArquivo(), 12);
        if ($tipo == "x-shockwave-flash") {
            return true;
        } else {
            return false;
        }
    }


    public function largura()
    {
        if ($this->seForImagem()) {
            return $this->largura_imagem;
        }
    }

    public function altura()
    {
        if ($this->seForImagem()) {
            return $this->altura_imagem;
        }
    }

    public function larguraFlash()
    { // somente para uploadFlash
        $tamanhos = getimagesize($this->nomeTmpDoArquivo());
        return $tamanhos[0];

    }

    public function alturaFlash()
    { // somente para uploadFlash
        $tamanhos = getimagesize($this->nomeTmpDoArquivo());
        return $tamanhos[1];
    }

    public function maiorComprimento()
    {
        if ($this->seForImagem()) {
            $largura = $this->largura();
            $altura = $this->altura();
            return max($largura, $altura);
        } else { // pode ser uma imagem enviada via Flash
            $largura = $this->larguraFlash();
            $altura = $this->alturaFlash();
            return max($largura, $altura);
        }
    }

    public function layout()
    {
        if ($this->seForImagem()) {
            $largura = $this->largura();
            $altura = $this->altura();
        } else { // pode ser uma imagem enviada via Flash
            $largura = $this->larguraFlash();
            $altura = $this->alturaFlash();
        }
        if ($largura == -1 || $altura == -1) {
            return "";
        }
        if ($largura > $altura) {
            return "paisagem";
        }
        if ($largura < $altura) {
            return "retrato";
        }
        if ($largura == $altura) {
            return "quadrado";
        }
    }


    public function moverPara($caminho_com_extensao)
    {
        move_uploaded_file($this->nomeTmpDoArquivo(), $caminho_com_extensao);
        return true;
    }

    //Metodos muito usados

    public function conferirPreferencias($extensao, $largura, $altura)
    {
        if ($this->extensaoDoArquivo() == $extensao && $this->largura() <= $largura && $this->altura() <= $altura) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function arquivosValidos()
    { // confere se o campo de file postado, � do tipo de arquivo que eu quero (MIME TYPE)

        $tipo = $this->tipoDoArquivo();//
        switch ($tipo) {

            case "application/pdf": //pdf
                return TRUE;
                break;

            case "application/msword": //word 2003
                return TRUE;
                break;

            case "application/vnd.openxmlformats-officedocument.wordprocessingml.document": //word 2007 (.docx)
                return TRUE;
                break;

            case "application/vnd.ms-powerpoint"://powerpoint 2003
                return TRUE;
                break;

            case "application/vnd.ms-excel"://excel 2003
                return TRUE;
                break;

            case "audio/mpeg": // mp3
                return TRUE;
                break;

            case "video/x-flv": // flash video (.flv)
                return TRUE;
                break;

            case "video/mp4": // flash video mp4 (.f4v)
                return TRUE;
                break;
        }

        return false;


    }

    public function setDimensoesLimite($largura, $altura)
    {
        if ($this->seForImagem()) {
            $this->altura_limite = $altura;
            $this->largura_limite = $largura;
        }
    }

    public function criarNovaImagemProporcional($origem, $destino, $largura, $formato)
    {
        //$this->moverPara($origem);
        switch ($formato) {
            case 'JPEG':
                $tn_formato = 'jpg';
                break;

            case 'PNG':
                $tn_formato = 'png';
                break;
        }

        $indice = strrpos(strtolower($origem), '.'); // onde come�a o ponto
        $ext = substr(strtolower($origem), $indice + 1); // jpg

        //echo "origem :".$origem;
        $arr = explode("/", $origem);

        //echo "<br> arr: ".$arr;
        $n = count($arr) - 1;
        //echo "<br> n ".$n;
        $arra = explode('.', $arr[$n]);
        //echo "<br> arra explode de arr[n] ".print_r($arra);
        $n2 = count($arra) - 1;
        //echo "<br> n2 count de arra -1:  ".$n2;
        $tn_name = str_replace('.' . $arra[$n2], '', $arr[$n]);

        //$destino = $destino.$tn_name.'.'.$tn_formato; // destino da imagem miniatura


        //------

        if ($ext == 'jpg' || $ext == 'jpeg') {
            $im = imagecreatefromjpeg($origem);
        } elseif ($ext == 'png') {
            $im = imagecreatefrompng($origem);
        } elseif ($ext == 'gif') {
            return false;
        }

        // exemplo de figura em p�
        $w = imagesx($im); // 768
        $h = imagesy($im); // 1024

        if ($w > $h) { //768 > 1024 (falso)
            $nw = $largura; // 115 por parametro
            $nh = ($h * $largura) / $w;  // ( 768 * 115) /1024  == 86,25
        } else {

            $nw = ($w * $largura) / $h; // ( 768 * 115) /1024  == 86,25
            $nh = $largura;  // 115

        }

        if (function_exists('imagecopyresampled')) {
            if (function_exists('imageCreateTrueColor')) {
                $ni = imageCreateTrueColor($nw, $nh);
            } else {
                $ni = imagecreate($nw, $nh);
            }

            if (!@imagecopyresampled($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h)) {
                imagecopyresized($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
            }
        } else {
            $ni = imagecreate($nw, $nh);
            imagecopyresized($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
        }

        if ($tn_formato == 'jpg') {
            imagejpeg($ni, $destino, 75);
        } elseif ($tn_formato == 'png') {
            imagepng($ni, $destino);
        }
    }

    public function criarNovaImagemExata($origem, $destino, $largura, $altura, $formato)
    {
        //$this->moverPara($origem);
        switch ($formato) {
            case 'JPEG':
                $tn_formato = 'jpg';
                break;

            case 'PNG':
                $tn_formato = 'png';
                break;
        }

        $indice = strrpos(strtolower($origem), '.');
        $ext = substr(strtolower($origem), $indice + 1);

        //echo "origem :".$origem;
        $arr = explode("/", $origem);

        //echo "<br> arr: ".$arr;
        $n = count($arr) - 1;
        //echo "<br> n ".$n;
        $arra = explode('.', $arr[$n]);
        //echo "<br> arra explode de arr[n] ".$arra;
        $n2 = count($arra) - 1;
        //echo "<br> n2 count de arra -1:  ".$n2;
        $tn_name = str_replace('.' . $arra[$n2], '', $arr[$n]);

        //$destino = $destino.$tn_name.'.'.$tn_formato; // destino da imagem miniatura


        //------

        if ($ext == 'jpg' || $ext == 'jpeg') {
            $im = imagecreatefromjpeg($origem);
        } elseif ($ext == 'png') {
            $im = imagecreatefrompng($origem);
        } elseif ($ext == 'gif') {
            return false;
        }

        $w = imagesx($im);
        $h = imagesy($im);

        $nw = $largura; // exatamente
        $nh = $altura; // exatamente

        if (function_exists('imagecopyresampled')) {
            if (function_exists('imageCreateTrueColor')) {
                $ni = imageCreateTrueColor($nw, $nh);
            } else {
                $ni = imagecreate($nw, $nh);
            }

            if (!@imagecopyresampled($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h)) {
                imagecopyresized($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
            }
        } else {
            $ni = imagecreate($nw, $nh);
            imagecopyresized($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
        }

        if ($tn_formato == 'jpg') {
            imagejpeg($ni, $destino, 100);
        } elseif ($tn_formato == 'png') {
            imagepng($ni, $destino);
        }
    }

    // PNG ou GIF com fundo transparente
    public function carregaMarcaDagua($url_imagem)
    {
        $this->url_marcaDagua = $url_imagem;
    }

    //Precisa usar carregaMarcaDagua(); antes de usar
    public function criarImagemComMarcaDagua($origem, $destino, $largura, $altura = NULL, $padding = 10, $opacidade = 100)
    {

        $indice = strrpos(strtolower($origem), '.'); // onde come�a o ponto
        $ext = substr(strtolower($origem), $indice + 1); // jpg

        //echo "origem :".$origem;
        $arr = explode("/", $origem);

        //echo "<br> arr: ".$arr;
        $n = count($arr) - 1;
        //echo "<br> n ".$n;
        $arra = explode('.', $arr[$n]);
        //echo "<br> arra explode de arr[n] ".print_r($arra);
        $n2 = count($arra) - 1;
        //echo "<br> n2 count de arra -1:  ".$n2;
        $tn_name = str_replace('.' . $arra[$n2], '', $arr[$n]);

        //$destino = $destino.$tn_name.'.'.$tn_formato; // destino da imagem miniatura


        //------
        switch ($ext) {
            case "jpg":
                $im = imagecreatefromjpeg($origem);
                break;
            case "jpeg":
                $im = imagecreatefromjpeg($origem);
                break;
            case "png":
                $im = imagecreatefrompng($origem);
                break;

            default:
                return FALSE;
                break;

        }

        $w = imagesx($im); // 768
        $h = imagesy($im); // 1024

        // Se vai ser proprocional
        if ($largura !== NULL && $altura === NULL) {
            if ($w > $h) { //768 > 1024 (falso)
                $nw = $largura; // 115 por parametro
                $nh = ($h * $largura) / $w;  // ( 768 * 115) /1024  == 86,25
            } else {

                $nw = ($w * $largura) / $h; // ( 768 * 115) /1024  == 86,25
                $nh = $largura;  // 115

            }
        }

        if ($largura !== NULL && $altura !== NULL) {
            $nw = $largura; // exatamente
            $nh = $altura; // exatamente
        }


        if (function_exists('imagecopyresampled')) {
            if (function_exists('imageCreateTrueColor')) {
                $ni = imageCreateTrueColor($nw, $nh);
            } else {
                $ni = imagecreate($nw, $nh);
            }

            if (!@imagecopyresampled($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h)) {
                imagecopyresized($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
            }
        } else {
            $ni = imagecreate($nw, $nh);
            imagecopyresized($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
        }

        // criar a nova imagem primeiro
        if ($ext == 'jpg') {
            imagejpeg($ni, $destino, 75);
        } elseif ($ext == 'png') {
            imagepng($ni, $destino);
        }

        // Marca d'agua

        $logo = $this->criarRecursoImagem($this->url_marcaDagua);//cria a logo

        $tamanhos = getimagesize($this->url_marcaDagua);//obtem as dimensoes da logo
        $marca_width = $tamanhos[0];//atribui a largura da logo
        $marca_height = $tamanhos[1];//atribui a altura da logo


        $imagem = $this->criarRecursoImagem($destino);//cria a imagem original

        $tamanhos = getimagesize($destino);//obtem as dimensoes da imagem original
        $dest_x = $tamanhos[0] - $marca_width - $padding;//define a posi�ao horizontal que a logo se posicionar�
        $dest_y = $tamanhos[1] - $marca_height - $padding;//define a posi�ao vertical que a logo se posicionar�


        $imagem_temp = imagecreatetruecolor($tamanhos[0], $tamanhos[1]);
        imagealphablending($imagem_temp, FALSE);


        imagecopyresampled($imagem_temp, $imagem, 0, 0, 0, 0, $tamanhos[0], $tamanhos[1], $tamanhos[0], $tamanhos[1]);
        // Insere imagem 2 na 1
        //imagecopy( $imagem, $logo, $dest_x, $dest_y, 0, 0, $marca_width, $marca_height);
        imagecopymerge($imagem_temp, $logo, $dest_x, $dest_y, 0, 0, $marca_width, $marca_height, 50);//c�pia marca d'�gua na imagem original

        // criar a imagem novamente no mesmo lugar com a marca d'agua
        if ($ext == 'jpg') {
            imagejpeg($imagem_temp, $destino, 100);
        } elseif ($ext == 'png') {
            imagepng($imagem_temp, $destino);
        }
        imagedestroy($imagem);
        imagedestroy($logo);


    }

    private function criarRecursoImagem($url)
    {
        $indice = strrpos(strtolower($url), '.'); // onde come�a o ponto
        $ext = substr(strtolower($url), $indice + 1); // jpg
        switch ($ext) {
            case "jpg":
                return imagecreatefromjpeg($url);
                break;

            case "png":
                return imagecreatefrompng($url);
                break;

            case "gif":
                return imagecreatefromgif($url);
                break;

        }
    }


}// FIM DA CLASSE


?>