<?php 
    $id = $_GET['id'];
    $conexao = mysqli_connect('localhost','root','','aula1');
    $apagar = mysqli_query($conexao,"delete from tb_contatos where id=$id");
    if ($apagar) {
        echo "Apagado com Sucesso!";
    }else {
        echo "Não foi possível apagar";
    }
?>