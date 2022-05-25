<?php
$conexao = mysqli_connect('localhost','root','','aula1');
$id = $_GET["id"];
$registro = mysqli_query($conexao,"select * from tb_contatos where id = $id");
$registroAlterar = mysqli_fetch_assoc($registro);
if ($registroAlterar["sexo"]=='M'){
    $sexoM = "checked";
    $sexoF = "";
}else {
    $sexoF = "checked";
    $sexoM = "";
    
}
?>
<html>

<head>
    <title>Entendendo os formulários HTML</title>
</head>

<body>
    <h1>Preencha os campos abaixo</h1>
    <form method='post' action="">
        <table border="1" cellpadding="5" cellspacing="3">
            <tr>
                <td>
                    Nome
                </td>
                <td>
                    <input type="text" name="nome" value="<?php echo $registroAlterar["nome"]; ?>">
                </td>
                
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <input type="text" name="email" value="<?php echo $registroAlterar["email"]; ?>"> 
                </td>
            </tr>
            <tr>
                <td>
                    Sexo
                </td>
                <td>
                    Masculino <input type="radio" name="sexo" value="M" <?php echo $sexoM; ?>>
                    Feminino <input type="radio" name="sexo" value="F" <?php echo $sexoF; ?>>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Enviar dados</button>
                </td>
            </tr>            
        </table>
    </form>
    <?php
          
    if (isset($_POST['nome'])){
        $nome =$_POST["nome"];
        $email =$_POST["email"];
        $sexo =$_POST["sexo"];

        $gravar = mysqli_query($conexao,"insert into tb_contatos VALUES
        (null, '$nome','$email','$sexo')");
        
        if(!$conexao){
            echo "Erro ao tentar conectar BD <br>";
           return;
        } 
        echo "Conectou com o Banco de Dados <br>";

        if ($sexo=='M'){
            $sexo = "um Homem";   
        }else{
            $sexo ="uma Mulher";
        }
        echo " Olá $nome seu email é $email e você é $sexo";

        echo '<table border="1" cellspading="0" cellspacing="0">';
        echo '<tr><td>Nome</td><td>Email</td><td>Sexo</td><td>Ações</td></tr>';
     
        //Listo os Contatos Gravados até o momento
        $listar = mysqli_query($conexao,"select * from tb_contatos");
        while ($linha = mysqli_fetch_array ($listar)){
            if ($linha["sexo"]=='M'){
                $sexo = "MASCULINO";
            }else{
                $sexo = "FEMININO";
            }
            echo '<td>'.$linha['nome'].'</td>';
            echo '<td>'.$linha['email'].'</td>';
            echo '<td>'.$sexo.'</td>';
            echo '<td><a href="apagar.php?id='.$linha["id"].'">
            <img src="apagar.png" width="32" height="32"
            border="0"></a></td>';
            echo '</tr>';

        }

        echo '</table>';
    }
    ?>
</body>

</html>