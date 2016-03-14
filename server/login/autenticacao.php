<?php
    
    session_start();

    $continuar = true;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['nome_usuario']) && strcmp($_POST['nome_usuario'], '')){
            $usuario =  $_POST['nome_usuario'];
        } else {
            $continuar = false;
        }
        
        if(isset($_POST['senha']) && strcmp($_POST['senha'], '')){
            $senha = $_POST['senha'];
        } else {
            $continuar = false;
        }
        
        if($continuar==false){
            echo 
            '<script>
                alert("Verifique se os dados foram preenchidos!");
                javascript:window.history.go(-1)
            </script>';
        } else { //vamos continuar
            $servidor_bd = 'localhost';
            $usuario_bd = 'root';
            $senha_bd = 'iago2014';
            $nome_bd = 'ouvidoria_app';
            
            mysql_connect($servidor_bd, $usuario_bd, $senha_bd) or die("MySQL: Não foi possível conectar-se ao servidor de banco de dados.");
            mysql_select_db($nome_bd) or die("MySQL: Não foi possível conectar-se ao banco de dados.");
            
            $senha_cript = $senha;
            //$senha_cript = md5($senha);
            
            $sql = "SELECT id FROM usuario WHERE login = '$usuario' AND senha = '$senha_cript'";
            $query_sql = mysql_query($sql);
            $resultado = mysql_fetch_assoc($query_sql);
            
            if(empty($resultado)){
                echo
                '<script>
                    alert("Usuario ou senha incorreta(as)!");
                    javascript:window.history.go(-1);
		</script>';
            } else {
                $_SESSION['CODSIST_usuario'] = $resultado['id'];
                header('Location: ../');
            }
        }
    }

?>
