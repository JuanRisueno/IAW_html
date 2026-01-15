<?php

function encontrarUsuario(PDO $con,$username):array|false{
    try{
        // 1º se Prepara la consulta
        $stm = $con -> prepare('select * from usuario where username = :username');

        // 2º igualamos las variables
        $stm -> bindValue(':username',$username);

        // 3º ejecutamos la variable (que es una consulta)
        $stm -> execute();

        // 4º devolvemos el array encontrado
        return $stm -> fetch();

    }catch(PDOException $e){
        echo $e -> getMessage();
        return false;
    };

};

?>