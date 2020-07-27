<?php

    include ( '../../banco/conexao.php' );

    if ( $conexao ) {

        $requestData = $_REQUEST ;

        $id = isset ( $requestData [ 'idcategoria' ])? $requestData [ 'idcategoria' ]: '' ;

        $sql = "DELETE FROM categorias WHERE idcategoria = $ id" ;

        $resultado = mysqli_query ( $conexão , $sql );

        if ( $resultado ) {
            $dados = array (
                "tipo" => "sucesso" ,
                "mensagem" => "Categoria excluída com sucesso."
            );
        } else {
            $dados = array (
                "tipo" => "erro" ,
                "mensagem" => "Não foi possível excluir uma categoria."
            );
        }

        mysqli_close ( $conexão );

    } else {
        $dados = array (
            "tipo" => "info" ,
            "mensagem" => "Ops ... não foi possível conectar ao banco de dados."
        );
    }

    echo  json_encode ( $dados , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );