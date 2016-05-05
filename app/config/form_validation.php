<?php
/**
 * 申请页面form
 * GaoFei
 * Date: 2015/8/24 9:53
 */
$config = array(
    //添加内容验证
    'School' => array(
        array(
            'field' => 'SchoolName',
            'label' => '名称',
            'rules' => 'required|max_length[20]'
        ),
        array(
            'field' => 'LianName',
            'label' => '姓名',
            'rules' => 'required'
        ),
        array(
            'field' => 'PhoneNumber',
            'label' => '联系电话',
            'rules' => 'required|min_length[11]|min_length[11]|numeric'
        ),
        array(
            'field' => 'OtherLian',
            'label' => '地址',
            'rules' => 'required'
        ),
        array(
            'field' => 'Usage',
            'label' => '使用情况',
            'rules' => 'required'
        ),
    ),
    'YuYue' => array(
        array(
            'field' => 'FirstCall',
            'label' => '电话备注',
            'rules' => 'required'
        ),
        array(
            'field' => 'YuData',
            'label' => '预约时间',
            'rules' => 'required'
        ),
    ),
    'Useradmin' => array(
        array(
            'field' => 'userName',
            'label' => '用户名',
            'rules' => 'required|alpha_numeric|min_length[5]|max_length[20]'
        ),
        array(
            'field' => 'realName',
            'label' => '真实姓名',
            'rules' => 'required|alpha_numeric_spaces|max_length[6]|alpha_numeric_spaces'
        ),
        array(
            'field' => 'passWord',
            'label' => '密码',
            'rules' => 'required|min_length[6]|max_length[15]|alpha_numeric'
        ),
        array(
            'field' => 'email',
            'label' => '邮箱',
            'rules' => 'required|valid_email'
        ),
    ),
    'renwu' => array(
        array(
            'field' => 'title',
            'label' => '标题',
            'rules' => 'required|max_length[33]|min_length[6]'
        ),
        array(
            'field' => 'contents',
            'label' => '内容详情',
            'rules' => 'required|min_length[20]'
        ),

    ),
    'changeMiMa' => array(
        array(
            'field' => 'passwdF',
            'label' => '密码',
            'rules' => 'required|min_length[6]|max_length[20]|alpha_numeric'
        ),
        array(
            'field' => 'passwdS',
            'label' => '密码',
            'rules' => 'required|min_length[6]|max_length[20]|alpha_numeric'
        ),
    ),
    'shouhou' => array(
        array(
            'field' => 'phoneNumber',
            'label' => '电话',
            'rules' => 'required|max_length[12]|min_length[10]'
        ),
        array(
            'field' => 'contents',
            'label' => '内容详情',
            'rules' => 'required'
        ),
    ),
    'user'  =>  array(
        array(
            'username'  =>  'username',
            'label'     =>  '用户名',
            'rules'     =>  'required|max_length[12]|min_length[5]',
        ),
        array(
            'password'  => 'password',
            'label'     => '密码',
            'rules'     => 'required|max_length[15]|min_length[5]|alpha_numeric',
        ),
        array(
            'realname'  =>  'realname',
            'label'     =>  '真实姓名',
            'rules'     =>  'required|max_length[10]|min_length[2]',
        ),
        array(
            'email'     =>  'email',
            'label'     =>  '邮箱',
            'rules'     =>  'required|valid_email',
        ),
        array(
            'phoneNumber'   =>  'phoneNumber',
            'label'         =>  '电话号码',
            'rules'         =>  'required|numeric|max_length[11]'
        ),

    ),
);
?>