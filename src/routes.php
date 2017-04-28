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

// 个人打卡记录
$app->get('/person/punch', function($request, $response, $args){
    return $this->view->render('person_punch.html', array());
});

// 个人出勤记录
$app->get('/person/attend', function($request, $response, $args){
    return $this->view->render('person_attend.html', array());
});

// 综合打卡记录
$app->get('/all/punch', function($request, $response, $args){
    return $this->view->render('all_punch.html', array());
});

// 综合出勤记录
$app->get('/all/attend', function($request, $response, $args){
    return $this->view->render('all_attend.html', array());
});

//// 个人打卡记录
//$app->get('/person/punch', function($request, $response, $args){
//    return $this->view->render('person_punch.html', array());
//});
//
//// 个人打卡记录
//$app->get('/person/punch', function($request, $response, $args){
//    return $this->view->render('person_punch.html', array());
//});
//
//// 个人打卡记录
//$app->get('/person/punch', function($request, $response, $args){
//    return $this->view->render('person_punch.html', array());
//});
//
//// 个人打卡记录
//$app->get('/person/punch', function($request, $response, $args){
//    return $this->view->render('person_punch.html', array());
//});

//$app->get('/user', function ($request, $response, $args) {
//
////    return $this->view->render('login.html', array());
//
////    return json
//    $arr = array('name' => 'shaoda', 'age' => 20);
//    $response = $response->withJson($arr);
//    return $response;
//});
