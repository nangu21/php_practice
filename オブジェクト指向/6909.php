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
    //メンバー変数
    public $name;
    public $email;

    public function __construct($name, $email){
        $this->name = $name;
        $this->email = $email;
    }

    public function sayHi(){
        echo "hi! my name is ". $this->name;
    }
}

$tom = new User("tom", "dummy@dummy.com");
$bob = new User("bob", "dummy@dummybob.com");


echo $tom->name;
echo $tom->sayHi();
echo $bob->sayHi();