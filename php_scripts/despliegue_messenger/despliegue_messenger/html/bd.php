<?php

function findUsuario(PDO $con, $user):array|false{
    try{
        $stm = $con->prepare('select * from usuario where username = :user');

        $stm -> bindValue(':user',$user);

        //Ejecutamos
        $stm -> execute();

        return $stm->fetch(); //Coge la primera línea que cumple los valores que se le dan y lo convierte en un array

    }catch(PDOException $e){
        echo $e -> getMessage();
        return false;
    }
}

function insertUsuario(PDO $con,$user,$pass,$name):bool{
    try{
        $stm = $con->prepare('insert into usuario(username,password,full_name) values(:user,:pass,:name)');

        $pass_segura = password_hash($pass,PASSWORD_DEFAULT);

        $data = [
            ':user' => $user,
            ':pass' => $pass_segura,
            ':name' => $name
        ];

        //Ejecutamos
        $stm -> execute($data);

        return $stm->rowCount() === 1;

    }catch(PDOException $e){
        echo $e -> getMessage();
        return false;
    }
}

function findMensajes(PDO $con, $id_user):array{
    try{
        $stm = $con->prepare('  select  m.id, 
                                        m.asunto, 
                                        u.full_name as remitente,
                                        m.fecha_hora as fecha
                                from usuario u join mensaje m on u.id = m.id_remitente
                                where m.id_destinatario = :id_user');

        $stm -> bindValue(':id_user',$id_user);

        //Ejecutamos
        $stm -> execute();

        return $stm->fetchAll(); 

    }catch(PDOException $e){
        echo $e -> getMessage();
        return [];
    }
}


?>