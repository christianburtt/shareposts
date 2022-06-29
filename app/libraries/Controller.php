<?php
/**
 * The base controller which loads models and views
 */

class Controller{
    public function model($model){
        //get the model file
        require_once('../app/models/'.$model.'.php');

        //instantiate model
        return new $model();
    }

    public function view($view,$data=[]){
        //get view file
        if(file_exists('../app/views/'.$view.'.php')){
            require_once('../app/views/'.$view.'.php');
        }else{
            //view does not exist
            die("View file not found");
        }
    }
}