<?php
class Posts extends Controller{
    public function __construct()
    {
        if(!isLoggedIn()) redirect('users/login');
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }
    public function index(){
        $posts = $this->postModel->getPosts();
        $data = ['posts'=>$posts];
        $this->view('posts/index',$data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //sanitize posts
            $data = [
                'title'=>htmlspecialchars(trim($_POST['title'])),
                'body'=>htmlspecialchars(trim($_POST['body'])),
                'user_id'=>$_SESSION['user_id'],
                'title_err'=>'',
                'body_err'=>''
            ];

            //validate title
            if(empty($data['title'])){
                $data['title_err'] = "Please enter a title";
            }
            if(empty($data['body'])){
                $data['body_err'] = "Please enter text for the body";
            }
            if(empty($data['title_err']) && empty($data['body_err'])){
                //validated now add
                if($this->postModel->addPost($data)){
                    flash('post_message','Post Added Successfully');
                    redirect('posts');
                }else{
                    die('something went wrong');
                }
            }else{
                $this->view('posts/add',$data);
            }
            
        }else{
            $data = ['title'=>'','body'=>''];
            $this->view('posts/add',$data);
        }
    }
    public function edit($post_id){
        if(!$post_id) redirect('posts');

        if($_SERVER['REQUEST_METHOD']=='POST'){
            //sanitize posts
            $data = [
                'post_id'=>$post_id,
                'title'=>htmlspecialchars(trim($_POST['title'])),
                'body'=>htmlspecialchars(trim($_POST['body'])),
                'user_id'=>$_SESSION['user_id'],
                'title_err'=>'',
                'body_err'=>''
            ];

            //validate title
            if(empty($data['title'])){
                $data['title_err'] = "Please enter a title";
            }
            if(empty($data['body'])){
                $data['body_err'] = "Please enter text for the body";
            }
            if(empty($data['title_err']) && empty($data['body_err'])){
                //validated now add
                if($this->postModel->updatePost($data)){
                    flash('post_message','Post Updated Successfully');
                    redirect('posts');
                }else{
                    die('something went wrong');
                }
            }else{
                
                $this->view('posts/edit',$data);
            }
            
        }else{
            $post = $this->postModel->getPost($post_id);
            if($post->user_id != $_SESSION['user_id']) redirect('posts');
            $data = [
                'post_id'=>$post_id,
                'title'=>$post->title,
                'body'=>$post->body
            ];
            $this->view('posts/edit',$data);
        }
    }

    public function show($post_id){
        if(!$post_id) redirect('posts');
        $post = $this->postModel->getPost($post_id);
        $user = $this->userModel->getUser($post->user_id);
        $data = ['post'=>$post, 'user'=>$user];
        $this->view('posts/show',$data);
    }

    public function delete($post_id){
        if(!$post_id) redirect('posts');

        $post = $this->postModel->getPost($post_id);
        if($post->user_id != $_SESSION['user_id']) redirect('posts');

        if($_SERVER['REQUEST_METHOD']=='POST'){
            if($this->postModel->deletePost($post_id)){
                flash('post_message','Post Removed');
                redirect('posts');
            }else{
                die('something went horribly wrong');
            }
        }else{
            redirect('posts');
        }
    }
}