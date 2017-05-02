<?php

//登录
$app->get('/', function ($request, $response, $args) {

    return $this->view->render('login.html', array());
});

$app->post('/', function ($request, $response, $args) {
//    获取表单数据
    $body = $request->getParsedBody();

    if (!empty($body['username'])) {
        $username = $body['username'];
    } else {
        return $this->view->render('login.html', array('msg' => '请填写用户名！'));
    }
    if (!empty($body['password'])) {
        $password = $body['password'];
    } else {
        return $this->view->render('login.html', array('msg' => '请填写密码！'));
    }

//    验证
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=ares', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        $sql = 'SELECT * FROM `userprofile` WHERE `username`=:username AND `password`=:password';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        if (!$stmt->execute()) {
            return $this->view->render('login.html', array('msg' => '服务器内部错误！'));
        }
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$users) {
            return $this->view->render('login.html', array('msg' => '用户名或密码错误！'));
        } else {
            return $this->view->render('attendance/record_person.html', array());
        }

        $dbh = null;
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

});

// 部门信息管理
$app->get('/department', function ($request, $response, $args) {
    return $this->view->render('user/department.html', array());
});

// 员工信息管理
$app->get('/user', function ($request, $response, $args) {
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=ares', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        $sql = 'SELECT d.name AS department_name, u.id, u.username, u.name, u.sex, u.position
FROM `department` AS d
INNER JOIN `userprofile` AS u 
ON d.id=u.department_id;';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

//        foreach($dbh->query('SELECT * from userprofile') as $row) {
//            $users[] = $row;
//        }

//        渲染页面
        return $this->view->render('user/user.html', array('users' => $users));

        $dbh = null;
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
});

$app->get('/add/user', function ($request, $response, $args) {
    return $this->view->render('user/add_user.html', array());
});
