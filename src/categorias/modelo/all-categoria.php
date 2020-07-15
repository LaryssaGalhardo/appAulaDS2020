<?php
    include ( '../../banco/conexao.php' );
    if ( $conexao ) {

        $sql = "SELECT idcategoria, nome, FROM categoria WHERE ativo = 'S'";   

        $resultado = mysqli_query ( $conexão , $sql );

        if ( $resultado && mysqli_num_rows ( $resultado )> 0 ) {
            while ( $linha = mysqli_fetch_assoc ( $resultado )) {
                $dadosCategoria = array_map ( 'utf8_encode' , $linha );
            }
            $dados = array ( 
                "tipo" => "info",
                "mensagem" => "Não é possível acessar o banco de dados",
                "dados" => array ());
        }else{
            $dados = array ( 
                "tipo" => "sucess",
                "mensagem" => "",
                "dados" => $dadosCategoria );
        }
        mysqli_close ( $conexão );
    }else{
        $dados = array ( 
            "tipo" => "error",
                "mensagem" => "Não é possível localizar a categoria.",
                "dados" => array ());
    }
echo  json_encode ( $dados , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
 