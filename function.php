<!DOCTYPE html>
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
    
    <div class="quiz">
        find()-會回傳資料表指定id的資料
    </div>
    <div class="quiz">
        update()-給定資料表的條件後，會去更新相應的資料。
    </div>
    <div class="quiz">
        insert()-給定資料內容後，會去新增資料到資料表
    </div>
    <div class="quiz">
        del()-給定條件後，會去刪除指定的資料
    </div>


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

//all()-給定資料表名後，會回傳整個資料表的資料
function all()
{
}


//find()-會回傳資料表指定id的資料
function find()
{
}


//update()-給定資料表的條件後，會去更新相應的資料。
function update()
{
}


//insert()-給定資料內容後，會去新增資料到資料表
function insert()
{
}


//del()-給定條件後，會去刪除指定的資料
function del()
{
}

?>