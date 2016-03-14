<?php
    
    session_start();
    
    if(isset($_GET['CODSIST_sair']) && !strcmp($_GET['CODSIST_sair'], 'true')){
        unset($_SESSION['CODSIST_usuario']);
        session_destroy();
        header('Location: index.php');
    } else {
        echo
            '<script>
                alert("Requisição incorreta!");
                javascript:window.history.go(-1);
            </script>';
    }

?>