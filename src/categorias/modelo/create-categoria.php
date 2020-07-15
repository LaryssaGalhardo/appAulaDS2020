<?php

include('../../banco/conexao.php');

 if($conexao){
     $dados = array(
         'tipo' => 'info',
         'mensagem' => 'OBS, não foi possivel obter uma conexao com o banco de dados, tente mais tarde.'
        );
    }else

    $requestaData = $_REQUEST

    
    if(empty($requestaData['nome']) || empty($requestaData['ativo']) ){
        $dados = array(
            'tipo' => 'info',
            'mensagem' => 'Existe(m) campo(s) obrigatorio(s) vazio(s)'
        );
} else {
    //$requestaData = array_map('utf8_decode', $requestaData);

    $requestaData['ativo'] = $requestaData['ativo'] == "on" ? "S" : "N";

    $requestaData['datacriacao'] = date('Y-d-m H:i:s', strtotime($requestaData['dataagora']));
    $sqlComando = "INSERT INTO CATEGORIAS(nome, ativo, datacriacao, datamodificacao
    VALUES('$requestaData[nome]', '$requestaData[ativo]', '$requestaData[dataagora]',
     '$requestaData[dataagora]')";

     $resultado = msqli_query($conexao, $sqlComando);

     if($resultado){
         $dados = array{
             'tipo' => 'success',
             'mensagem' => 'Categoria criada com sucesso'
         }else{
            $dados = array{
                'tipo' => 'error',
                'mensagem' => 'Não foi possivel criar a categoria' 
         }
     }
     mysqli_close($conexao)
}



$dadis = array_map('utf8_dencode', $dados);
echo json_encode($dados);
 