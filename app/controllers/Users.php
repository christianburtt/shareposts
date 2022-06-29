<?php
class Users extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
    }

    public function register(){
        //check if its GET or POST
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //process form
            //sanitize post data
            $data = [
                'name'=>htmlspecialchars(trim($_POST['name'])),
                'email'=>htmlspecialchars(trim($_POST['email'])),
                'pw'=>htmlspecialchars(trim($_POST['pw'])),
                'confirm'=>htmlspecialchars(trim($_POST['confirm'])),
                'name_err'=>'',
                'email_err'=>'',
                'pw_err'=>'',
                'confirm_err'=>''
            ];
            //validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Please Enter Email';
            }else{
                //check email
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = "Email is already taken";
                }
            }

            //validate name
            if(empty($data['name'])){
                $data['name_err'] = 'Please Enter Name';
            }
            //validate pw
            if(empty($data['pw'])){
                $data['pw_err'] = 'Please Enter Password';
            }else if(strlen($data['pw'])<6){
                $data['pw_err'] = "Password must be at least 6 characters";
            }
            //validate confirm
            if(empty($data['confirm'])){
                $data['confirm_err'] = 'Please confirm password';
            }else{
                if($data['pw'] != $data['confirm']){
                    $data['confirm_err'] = "Passwords must match";
                }
            }

            //check error variables
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['pw_err']) && empty($data['confirm_err'])){
                // die('success');
                //validated
                $data['pw'] = password_hash($data['pw'],PASSWORD_DEFAULT);

                //register user with model
                if($this->userModel->register($data)){
                    // header('location: '.URLROOT.'/users/login');
                    flash('register_success','You are registered. Please log in');
                    redirect('users/login');
                }else{
                    die('Something went wrong');
                }

            }else{
                //load view with errors
                $this->view('users/register',$data);

            }
        }else{
            //init data
            $data = [
                'name'=>'',
                'email'=>'',
                'pw'=>'',
                'confirm'=>'',
                'name_err'=>'',
                'email_err'=>'',
                'pw_err'=>'',
                'confirm_err'=>''
            ];

            //load the empty form
            $this->view('users/register',$data);
        }
    }

    public function login(){
        //check if its GET or POST
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //process form
            //sanitize post data
            $data = [
                'email'=>htmlspecialchars(trim($_POST['email'])),
                'pw'=>htmlspecialchars(trim($_POST['pw'])),
                'email_err'=>'',
                'pw_err'=>''
            ];
            //validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Please Enter Email';
            }

            //validate pw
            if(empty($data['pw'])){
                $data['pw_err'] = 'Please Enter Password';
            }else if(strlen($data['pw'])<6){
                $data['pw_err'] = "Password must be at least 6 characters";
            }
            
            //chek for user/email
            if($this->userModel->findUserByEmail($data['email'])){
                //user found!
            }else{
                $data['email_err'] = 'Email / PW incorrect';
            }

            //check error variables
            if(empty($data['email_err']) &&  empty($data['pw_err']) ){
                //validated
                //check and set logged in user
                $loggedInUser =$this->userModel->login($data['email'],$data['pw']);
                if($loggedInUser){
                    //create session variables
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['pw_err'] = "Email / PW incorrect";
                    $this->view('users/login',$data);
                }
            }else{
                //load view with errors
                $this->view('users/login',$data);

            }
        }else{
            //init data
            $data = [
                'email'=>'',
                'pw'=>'',
                'email_err'=>'',
                'pw_err'=>''
            ];

            //load the empty form
            $this->view('users/login',$data);
        }
    }
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name']= $user->name;
        redirect('posts');
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }
    
}