<?php
	namespace app\admin\validate;

	use think\Validate;

	class User extends Validate
	{
	    protected $rule = [
	        'username'  =>  'require|unique:users',
	        'password' =>  'require|length:6,16',
	        'repassword' =>  'require|confirm:password',
	        'email' =>  'require|email',
	        'phone' =>  'require|regex:\d{11}',
	    ];

	    protected $message = [
	        'username.require'  =>  '用户名不能为空',
	        'username.unique'  =>  '用户名重复',
	        'password.require' =>  '密码不能为空',
	        'password.length' =>  '密码格式不正确',
	        'repassword.require' =>  '重复密码不能为空',
	        'repassword.confirm' =>  '重复密码错误',
	        'email.require' =>  '邮箱不能为空',
	        'email.email' =>  '邮箱格式不正确',
	        'phone.require' =>  '手机号不能为空',
	        'phone.regex' =>  '请输入11位手机号',
	    ];
	    
	    protected $scene = [
	        'add'   =>  ['name','password','repassword','email','phone'],
	        'edit'  =>  ['name','password','repassword','email','phone'],
	    ];

	}