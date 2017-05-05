<?php

$dbpath = require __DIR__ . '/../config/access.config.php';

$dsn = "mysql:host=localhost;dbname=ares;charset=utf8";
//try {
//    $dbh = new PDO($dsn, 'root', 'root');
//    var_dump($dbh);
//    $res = array('USERID' => 12, 'CHECKTIME' => '2017-5-4 20:50:29');
//
//    $sql = "INSERT INTO access_checkinout (user_id, check_time) VALUES ({$res['USERID']}, '{$res['CHECKTIME']}')";
//    echo $sql;
//    $r = $dbh->exec($sql);
//
//    echo $r;
//    if (!$r) {
//        echo "wrong!";
//        die();
//    }
//} catch (PDOException $e) {
//    echo "Error!: " . $e->getMessage() . "<br/>";
//    die();
//}


/**
 * 更新 checkinout 信息，将前一工作日11:00到今日11:00的打卡记录写入MySQL
 */
try {
//    $conn = new PDO("odbc:DRIVER={MDBTools};DBQ=" . realpath($dbpath)) or die("Connect Error");
    $conn = odbc_connect("DRIVER={MDBTools};DBQ=/var/www/windows/att2000.mdb", '', '');
    $dbh = new PDO($dsn, 'root', 'root');

    $sql = 'SELECT USERID, CHECKTIME FROM CHECKINOUT';

    $result = odbc_exec($conn, $sql);

    if ($result) {
        while ($res = odbc_fetch_array($result)) {
            $format_datetime = date('Y-m-d H:i:s', strtotime($res['CHECKTIME']));
            $s = "INSERT INTO access_checkinout (user_id, check_time) VALUES ({$res['USERID']}, '{$format_datetime}')";
            $r = $dbh->exec($s);
            if (!$r) {
                echo "wrong!";
                // TODO 事务回滚
                die();
            }
//            var_dump(date('Y-m-d H:i:s', strtotime($res['CHECKTIME'])));
        }
    }
    odbc_close($conn);
    $dbh = null;
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}


/**
 * 更新 userinfo 信息，将表中数据全部重写
 */
//try {
//    $conn = odbc_connect("DRIVER={MDBTools};DBQ=/var/www/windows/att2000.mdb", '', '');
//    $dbh = new PDO($dsn, 'root', 'root');
//
//    $sql = "SELECT USERID, NAME FROM USERINFO";
//
//    $result = odbc_exec($conn, $sql);
//    if ($result) {
//        while ($res = odbc_fetch_array($result)) {
//            $s = "INSERT INTO access_userinfo (user_id, user_name) VALUES ({$res['USERID']}, {$res['NAME']})";
//            $r = $dbh->exec($s);
//            if (!$r) {
//                echo "wrong!";
//                // TODO 事务回滚
//                die();
//            }
//        }
//    }
//    odbc_close($conn);
//} catch (PDOException $e) {
//    echo "Error!: " . $e->getMessage() . "<br/>";
//    die();
//}


// 事务回滚 demo
try {
    $dbh = new PDO($dsn, 'root', 'root');

    $s = "INSERT INTO access_userinfo (user_id, user_name) VALUES ({$res['USERID']}, {$res['NAME']})";
    $r = $dbh->exec($s);
    if (!$r) {
        echo "wrong!";
        // TODO 事务回滚
        die();
    }

    odbc_close($conn);
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}


//try{
//    $conn = odbc_connect("DRIVER={MDBTools};DBQ=/var/www/windows/att2000.mdb", '', '');
//    $sql = "SELECT USERINFO.USERID, USERINFO.NAME, CHECKINOUT.CHECKTIME
//FROM USERINFO
//INNER JOIN CHECKINOUT
//ON USERINFO.USERID=CHECKINOUT.USERID";
//
//    $result = odbc_exec($conn, $sql);
//    if ($result) {
//        while ($res = odbc_fetch_array($result)) {
//            var_dump($res);
//        }
//    }
//    odbc_close($conn);
//} catch (PDOException $e) {
//    echo "Error!: " . $e->getMessage() . "<br/>";
//    die();
//}


//try {
//    $username = 'shaoda';
//    $password = 'shaoda';
//
//    $dbh = new PDO('mysql:host=localhost;dbname=ares;charset=utf8', 'root', 'root');
//    $sql = 'SELECT * FROM `userprofile` WHERE `username`=:username AND `password`=:password';
//    $stmt = $dbh->prepare($sql);
//    $stmt->bindParam(':username', $username);
//    $stmt->bindParam(':password', $password);
//    $stmt->execute();
//    $users = $stmt->fetch(PDO::FETCH_ASSOC);
//    var_dump($users);
//} catch (PDOException $e) {
//    echo "Error!: " . $e->getMessage() . "<br/>";
//    die();
//}


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
