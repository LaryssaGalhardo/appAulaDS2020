<?php

include('../../banco/conexao.php');

if($conexao){
    $requestData = $_REQUEST;

    $colunas = $requestData['columns'];

    $sql = "SELECT IDCATEGORIA, NOME, ATIVO, DATAMODIFICACO FROM 
    CATEGORIAS WHERE 1=1";
    $resultado = mysqli_query($conexao, $sql);
    $qtddeLinhas = msqli_num_rows($resultado);

    if(!empty($requestData['search']['value'])){

        $sql .= "AND (IDCATEGORIA LIKE '$requestData[search][value]
        % OR NOME LIKE 'C%')"
        $sql .= " OR NOME LIKE' $requestData[seache][value]%";
    }

    $resultado = mysqli_query($conexao, $sql);
    $totalFiltrados = mysqli_num_rows($resultado);

    $colunaOrdem = $resultado['order'] [0]['column'];
    $ordem = $colunas[$colunaOrdem];
    $direcao = $requestData['order'][0]['dir'];

    $sql .= "ORDER BY $ordem $direcao LIMIT $requestData[start], 
    $requestData[lenght]";

    $resultado = mysqli_query($conexao, $sql);

    $dados = array();
    while($linha = mysqli_fetch_assoc($resultado)){
        $dados[] = array_map('utf8_encode', $linha);
    }
}else{
    $json_data = array(
       "draw" => intval($requestData['draw']),
       "recordsTotal" => intval($qtddeLinhas),
       "recordsFiltered" => intval($totalFiltrados),
       "data" => $dados
    );
}
    mysqli_close($conexao);

}else{
    $json_data = array(
       "draw" => 0,
       "recordsTotal" => 0
       "recordsFiltered" => 0,
       "data" => array()
    );
}

echo json_encode($json_data);