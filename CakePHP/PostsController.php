<?php
    class PostsController extends AppController{
        //public $scaffold; //一覧が表示される

        public $helpers = array('Html', 'Form'); //選択的読み込みでメモリ消費を抑える

        public function index(){
            $this->set('posts', $this->Post->find('all')); //記事を引っ張ってくる(第一引数で設定した変数に第二引数が渡される)
        }

        public function add(){
            
        }
    }

?>