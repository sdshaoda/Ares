<?php

try {
    $username = 'shaoda';
    $password = 'shaoda';

    $dbh = new PDO('mysql:host=localhost;dbname=ares;charset=utf8', 'root', 'root');
    $sql = 'SELECT * FROM `userprofile` WHERE `username`=:username AND `password`=:password';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $users = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($users);
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}




//try {
//
//    $dbh = new PDO('mysql:host=localhost;dbname=ares;charset=utf8', 'root', 'root');
//    $sql = 'SELECT d.name AS department_name, u.id, u.username, u.name, u.sex, u.position
//FROM `department` AS d
//INNER JOIN `userprofile` AS u
//ON d.id=u.department_id;';
//    $stmt = $dbh->query($sql);
//    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    var_dump($users);
//} catch (PDOException $e) {
//    echo "Error!: " . $e->getMessage() . "<br/>";
//    die();
//}
