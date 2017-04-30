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
    if ($username == 'shaoda' && $password == 'shaoda') {
        return $this->view->render('record_person.html', array());
    } else {
        return $this->view->render('login.html', array('msg' => '用户名或密码错误！'));
    }

});

// 个人打卡记录
$app->get('/record/person', function($request, $response, $args){
    return $this->view->render('record_person.html', array());
});

// 个人出勤记录
$app->get('/attend/person', function($request, $response, $args){
    return $this->view->render('attend_person.html', array());
});

// 综合打卡记录
$app->get('/record/all', function($request, $response, $args){
    return $this->view->render('record_all.html', array());
});

// 综合出勤记录
$app->get('/attend/all', function($request, $response, $args){
    return $this->view->render('attend_all.html', array());
});

// 考勤申请
$app->get('/attendance/apply', function($request, $response, $args){
    return $this->view->render('attendance_apply.html', array());
});

// 考勤审核
$app->get('/attendance/verify', function($request, $response, $args){
    return $this->view->render('attendance_verify.html', array());
});

// 打卡信息录入
$app->get('/input/record', function($request, $response, $args){
    return $this->view->render('input_record.html', array());
});

// 出勤信息修改
$app->get('/edit/attendance', function($request, $response, $args){
    return $this->view->render('edit_attendance.html', array());
});

// 部门信息管理
$app->get('/department', function($request, $response, $args){
    return $this->view->render('department.html', array());
});

// 员工信息管理
$app->get('/user', function($request, $response, $args){
    return $this->view->render('user.html', array());
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
