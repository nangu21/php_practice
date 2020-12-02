<?php

//オブジェクト指向

/*
クラス：設計図
- メンバー変数
- メソッド(関数)
- コンストラクタ

インスタンス：クラスを実体化したもの
*/

class User{
    public $name;
    public $email;

    public function __construct($name, $email){
        $this->name = $name;
        $this->email = $email;
    }

    public function sayHi(){
        
    }
}