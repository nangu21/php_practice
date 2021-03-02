<?php 
//標準入力
    echo '1行だけ入力する場合は「0」を、複数行入力する場合は「1」を入力してね: ';
    $num = trim(fgets(STDIN));
    if($num == 1){
        echo '内容を入力してね: ';
        $stdin = trim(fgets(STDIN));
        echo '受け取りました: ';
        var_dump($stdin);
    }else if($num == 0){
        echo '内容を入力してね。終わったら「end」と入力してね: ';
        while($stdin = trim(fgets(STDIN))){
            if($stdin !== 'end'){
                $lines[] = $stdin;
            }else{
                echo '受け取りました: ';
                var_dump($lines);
                exit();
            }
        }
    }
?>
