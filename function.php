
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自訂函式練習</title>
    <style>
        h1 {
            text-align: center;
        }

        .quiz {
            width: 100%;
            padding: 0.6rem 1rem;
            border: blue;
            background: lightblue;
            box-shadow: 1px 1px 10px #ccc;
            margin: 0.5rem;
        }
    </style>
</head>

<body>
    <h1>自訂函式練習</h1>
    <div class="quiz">
        給定一個正整數的數值後，會印出對應行數的正三角形星星(依此類推可以設計印菱形，方形的函式)
    </div>
    <?php
    $size = isset($_GET['size']) ? $_GET['size'] : 3;
    $shap = isset($_GET['shap']) ? $_GET['shap'] : '正三角形';
    ?>
    <form action="function.php">
        大小: <input type="number" name="size" value="<?= $size; ?>">&nbsp;&nbsp;
        形狀: <select name="shap" id="">
            <option value="正三角形" <?= ($shap == '正三角形') ? 'selected' : ''; ?>>正三角形</option>
            <option value="直角三角形" <?= ($shap == '直角三角形') ? 'selected' : ''; ?>>直角三角形</option>
            <option value="菱形" <?= ($shap == '菱形') ? 'selected' : ''; ?>>菱形</option>
            <option value="矩形" <?= ($shap == '矩形') ? 'selected' : ''; ?>>矩形</option>
            <option value="矩形(X)" <?= ($shap == '矩形(X)') ? 'selected' : ''; ?>>矩形(X)</option>
        </select>
        <input type="submit" value="繪製">
    </form>
    <?php
    starts($size, $shap);
    ?>
    <div class="quiz">
        all()-給定資料表名後，會回傳整個資料表的資料
    </div>
    <?php
    $table = isset($_GET['table']) ? $_GET['table'] : 'dept';

    ?>
    <form action="function.php">
        資料表:<input type="text" name="table" value="<?= $table; ?>">&nbsp;&nbsp;

        <input type="submit" value="列出">
    </form>
    <?php

    $rows = all($table);
    echo "<ul>";
    foreach ($rows as $row) {
        echo "<li>";
        show($row);
        echo "</li>";
    }
    echo "</ul>";
    ?>
    <div class="quiz">
        find()-會回傳資料表指定id的資料
    </div>
    <?php
    $id = isset($_GET['id']) ? $_GET['id'] : '1';
    $table = isset($_GET['table']) ? $_GET['table'] : 'students';

    ?>
    <form action="function.php">
        資料表:<input type="text" name="table" value="<?= $table; ?>">&nbsp;&nbsp;
        id:<input type="text" name="id" value="<?= $id; ?>">&nbsp;&nbsp;

        <input type="submit" value="列出">
    </form>
    <?php
    $row = find($table, $id);
    show($row);
    ?>
    <div class="quiz">
        update()-給定資料表的條件後，會去更新相應的資料。
    </div>


    <?php
update('students',10,['name'=>'白金圓','parents'=>'白鳳鳴','dept'=>3]);

?>
    <div class="quiz">
        insert()-給定資料內容後，會去新增資料到資料表
    </div>
    <?php
insert('dept',['code'=>'601','name'=>'資工系']);

?>
    <div class="quiz">
        del()-給定條件後，會去刪除指定的資料
    </div>
    <?php

del('dept',7);
?>

</body>

</html>
<?php
//給定一個正整數的數值後，會印出對應行數的正三角形星星(依此類推可以設計印菱形，方形的函式)
function starts($size, $shap)
{
    switch ($shap) {
        case '直角三角形':
            for ($i = 1; $i < $size; $i++) {
                for ($j = 1; $j <= $i; $j++) {
                    echo "*";
                }
                echo "<br>";
            }
            break;

        case '正三角形':
            for ($i = 0; $i < $size; $i++) {
                for ($j = ($size - 1); $j > $i; $j--) {
                    echo "&nbsp&nbsp;";
                }
                for ($k = 0; $k < ($i * 2 + 1); $k++) {
                    echo "*";
                }
                echo "<br>";
            }
            break;

        case '菱形':

            if ($size % 2 == 0) {
                $size = $size + 1;
            }
            for ($i = 1; $i <= $size; $i++) {
                for ($j = 1; $j <= $size; $j++) {
                    if (($i - $j) > floor($size / 2) || ($j - $i) > floor($size / 2) || ($i + $j) > ceil($size / 2) + $size || ($i + $j) < ceil($size / 2) + 1) {
                        echo "&nbsp&nbsp";
                    } else {
                        echo "*";
                    }
                }
                echo "<br>";
            }
            break;

        case '矩形':
            for ($i = 1; $i <= $size; $i++) {
                for ($j = 1; $j <= $size; $j++) {
                    if ($i > 1 && $i <= $size - 1) {
                        if ($j > 1 && $j <= $size - 1) {
                            echo "&nbsp&nbsp";
                        } else {
                            echo "*";
                        }
                    } else {
                        echo "*";
                    }
                }
                echo "<br>";
            }
            break;

        case '矩形(X)':
            for ($i = 0; $i < $size; $i++) {
                for ($j = 0; $j < $size; $j++) {
                    if (($i == 0 || $i == $size - 1 || $j == 0 || $j == $size - 1 || $i == $j || $i + $j == $size - 1)) {
                        echo "*";
                    } else {
                        echo "&nbsp&nbsp";
                    }
                }
                echo "<br>";
            }
            break;
    }
}


function pdo($db){
    $dsn="mysql:host=localhost;charset=utf8;dbname=$db";
    return new PDO($dsn,'root','');    
}
//all()-給定資料表名後，會回傳整個資料表的資料
function all($table){
   $pdo=pdo('school2');
    $sql="SELECT * FROM `$table`";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}


//find()-會回傳資料表指定id的資料
function find($table,$id){
    $pdo=pdo('school2');
    $sql="SELECT * FROM `$table` WHERE `id`='$id'";
    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

function show($row){
    
    if(is_array($row)){
        foreach($row as  $value){
            echo $value;
            echo "--";
        }
    }else{
        echo "這不是一筆標準的資料，請重新輸入";
    }
}

//update()-給定資料表的條件後，會去更新相應的資料。
function update($table,$id,$data){
    $pdo=pdo('school2');
    if(is_array($data)){
        

        foreach($data as $key => $value){
            $tmp[]="`$key`='$value'";
        }
        $set=join(',',$tmp);
        $sql= "UPDATE `$table` SET $set WHERE `id`='$id'";
    }else{
        return "資料格式錯誤";
    }


    return $pdo->exec($sql);
}

//insert()-給定資料內容後，會去新增資料到資料表
function insert($table,$data){
    $pdo=pdo('school2');
        $k="`".join("`,`",array_keys($data))."`";
        $v="'".join("','",$data)."'";
    $sql="INSERT INTO `$table` ($k) VALUES($v)";


    $pdo->exec($sql);
}

//del()-給定條件後，會去刪除指定的資料
function del($table,$id){
    $pdo=pdo('school2');
    $sql="DELETE FROM `$table` WHERE `id`='$id'";

    return $pdo->exec($sql);
}

?>