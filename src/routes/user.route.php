<?php

/**
 * 用户管理中的相关路由
 */

$config = require __DIR__ . '/../../config/db.config.php';

//登录
$app->get('/', function ($request, $response, $args) {

    return $this->view->render('login.html', array());
});

$app->post('/', function ($request, $response, $args) {
    // 获取表单数据
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

    // 数据库验证
    global $config;
    $userdb = \Ares\Dao\UserDao::getInstance($config);
    $users = $userdb->loginCheck($username, $password);

    if (!$users) {
        return $this->view->render('login.html', array('msg' => '用户名或密码错误！'));
    } else {
        return $this->view->render('attendance/record_person.html', array());
    }
});

// 部门信息管理
$app->get('/department', function ($request, $response, $args) {
    return $this->view->render('user/department.html', array());
});

// 员工信息管理
$app->get('/user', function ($request, $response, $args) {

    global $config;
    $userdb = \Ares\Dao\UserDao::getInstance($config);
    $users = $userdb->getAllUserInfos();
    unset($userdb);

    return $this->view->render('user/user.html', array('users' => $users));
});

$app->get('/add/user', function ($request, $response, $args) {
    return $this->view->render('user/add_user.html', array());
});
