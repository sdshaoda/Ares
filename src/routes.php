<?php

//登录
$app->get('/', function ($request, $response, $args) {

    return $this->view->render('login.html', array());

});

$app->post('/', function ($request, $response, $args) {
//    表单数据
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
        $dbh = new PDO('mysql:host=localhost;dbname=ares', 'root', '');
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
        }else{
            return $this->view->render('record_person.html', array());
        }

        $dbh = null;
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

});

// 个人打卡记录
$app->get('/record/person', function ($request, $response, $args) {
    return $this->view->render('record_person.html', array());
});

// 个人出勤记录
$app->get('/attend/person', function ($request, $response, $args) {
    return $this->view->render('attend_person.html', array());
});

// 综合打卡记录
$app->get('/record/all', function ($request, $response, $args) {
    return $this->view->render('record_all.html', array());
});

// 综合出勤记录
$app->get('/attend/all', function ($request, $response, $args) {
    return $this->view->render('attend_all.html', array());
});

// 考勤申请
$app->get('/attendance/apply', function ($request, $response, $args) {
    return $this->view->render('attendance_apply.html', array());
});

// 考勤审核
$app->get('/attendance/verify', function ($request, $response, $args) {
    return $this->view->render('attendance_verify.html', array());
});

// 打卡信息录入
$app->get('/input/record', function ($request, $response, $args) {
    return $this->view->render('input_record.html', array());
});

// 出勤信息修改
$app->get('/edit/attendance', function ($request, $response, $args) {
    return $this->view->render('edit_attendance.html', array());
});

// 部门信息管理
$app->get('/department', function ($request, $response, $args) {
    return $this->view->render('department.html', array());
});

// 员工信息管理
$app->get('/user', function ($request, $response, $args) {
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=ares', 'root', '');
        $sql = 'SELECT * FROM `userprofile`';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

//        foreach($dbh->query('SELECT * from userprofile') as $row) {
//            $users[] = $row;
//        }

        return $this->view->render('user.html', array('users' => $users));
        $dbh = null;
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
});

//$app->get('/user', function ($request, $response, $args) {
//
////    return $this->view->render('login.html', array());
//
////    return json
//    $arr = array('name' => 'shaoda', 'age' => 20);
//    $response = $response->withJson($arr);
//    return $response;
//});
