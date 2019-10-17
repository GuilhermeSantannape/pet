<?php
class Produto {

    public $ean;
    public $nome;
    public $preco;

    function __construct($ean, $nome, $preco) {
        $this->ean = $ean;
        $this->nome = $nome;
        $this->preco = $preco;
    }
}
?>
