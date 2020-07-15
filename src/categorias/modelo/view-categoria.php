<?php
    include ( '../../banco/conexao.php' );
    if ( $conexao ) {
        $requestData = $_REQUEST ;
        $id = isset ( $requestData [ 'idcategoria' ])? $requestData [ 'idcategoria' ]: '' ;

        $sql = "SELECT idcategoria, nome, ativo, DATE_FORMAT (datacriacao, '% d /% m /% Y% H:% i:% s') como datacriacao, DATE_FORMAT (datamodificacao, '% d /% m /% Y % H:% i:% s ')
         como especificação de dados FROM categorias WHERE idcategoria = $ id " ;

        $resultado = mysqli_query ( $conexão , $sql );

        if ( $resultado && mysqli_num_rows ( $resultado )> 0 ) {
            while ( $linha = mysqli_fetch_assoc ( $resultado )) {
                $dadosCategoria = array_map ( 'utf8_encode' , $linha );
            }
            $dados = array ( 
                "tipo" => "sucess",
                "mensagem" => "",
                "dados" => $dadosCategoria );
        }else{
            $dados = array ( 
                "tipo" => "error",
                "mensagem" => "Não é possível localizar a categoria.",
                "dados" => array ());
        }
        mysqli_close ( $conexão );
    }else{
        $dados = array ( 
              "tipo" => "info",
              "mensagem" => "Não é possível acessar o banco de dados",
              "dados" => array ());
    }
echo  json_encode ( $dados , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
