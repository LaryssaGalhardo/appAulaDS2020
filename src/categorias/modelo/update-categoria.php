<?php

    include ( '../../banco/conexao.php' );

    if ( $conexao ) {

        $requestData = $_REQUEST ;

        if ( vazio ( $requestData [ 'nome' ]) || vazio ( $requestData [ 'ativo' ])) {
            $dados = array (
                "tipo" => "info" ,
                "mensagem" => "Existe (m) campo (s) obrigatório (s) em branco."
            );
        } else {
            $id = isset ( $requestData [ 'idcategoria' ])? $requestData [ 'idcategoria' ]: '' ;
            $requestData [ 'ativo' ] = $requestData [ 'ativo' ] == "on" ? "S" : "N" ;

            $date = date_create_from_format ( 'd / m / YH: i: s' , $requestData [ 'dataagora' ]);
            $requestData [ 'dataagora' ] = date_format ( $date , 'Ymd H: i: s' );

            $sql = "UPDATE categorias SET nome = '$requestData [nome]', ativo = '$requestData [ativo]', $datamodificacao = '$requestData [dataagora]' WHERE idcategoria = $ id" ;

            $resultado = mysqli_query ( $conexão , $sql );

            if ( $resultado ) {
                $dados = array (
                    "tipo" => "sucesso" ,
                    "mensagem" => "Categoria alterada com sucesso."
                );
            } else {
                $dados = array (
                    "tipo" => "erro" ,
                    "mensagem" => mysqli_error ( $conexao ) // "Não foi possível alterar a categoria."
                );
            }
        }

        mysqli_close ( $conexão );

    } else {
        $dados = array (
            "tipo" => "info" ,
            "mensagem" => "Ops ... não foi possível conectar ao banco de dados"
        );
    }

   echo  json_encode ( $dados , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );