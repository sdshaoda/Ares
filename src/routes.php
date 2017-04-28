<?php

//登录
$app->get('/', function ($request, $response, $args) {

    return $this->view->render('login.html', array());

});

$app->post('/login', function ($request, $response, $args) {
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
    if ($username == 'shaoda' && $password == 'shaoda') {
        return $this->view->render('index.html', array());
    } else {
        return $this->view->render('login.html', array('msg' => '用户名或密码错误！'));
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
