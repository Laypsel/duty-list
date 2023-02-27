<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Duty list</title>
</head>
    <body>
        <main>
            <div>
                <form action="index.php" method="post">
                    <table class="table">
                        <thead class="bg">
                            <tr>
                                <th rowspan="2" class="number">Ім’я</th>
                                <th rowspan="2">Група</th>
                                <th colspan="5">Графік</th>
                                <th rowspan="2">Off</th>
                            </tr>
                            <tr>
                                <th>Понеділок</th>
                                <th>Вівторок</th>
                                <th>Середа</th>
                                <th>Четвер</th>
                                <th>П'ятниця</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                session_start (); //щоб відкрити глобальний масив Сесея
                                if (isset($_SESSION["students"])) {
                                    $students = json_decode($_SESSION["students"]); // беремо із сесії а потім розшифровуємо
                                } else { // тоді використовуємо фіксований масив
                                    $students = [  // змінна у якій є фіксований масив та елементи у ньому це студенти та їх групи
                                        ["Петро","ІПЗ-11"],
                                        ["Сашко","ІПЗ-12"],
                                        ["Даша","ІПЗ-13"],
                                        ["Олексій","ІПЗ-11"],
                                        ["Дмитро","ІПЗ-13"],
                                        ["Яна","ІПЗ-11"],
                                        ["Аня","ІПЗ-13"],
                                        ["Галя","ІПЗ-12"],
                                        ["Федько","ІПЗ-12"],
                                        ["Славко","ІПЗ-11"],
                                        ["Андрій","ІПЗ-11"],
                                        ["Марія","ІПЗ-13"],
                                        ["Катрина","ІПЗ-12"]
                                    ];
                                }
                                $ipz11 = []; //змінна групи ІПЗ-11 дорівнює пустому масиву де будуть виводитися елементи
                                $ipz12 = []; //змінна групи ІПЗ-12 дорівнює пустому масиву де будуть виводитися елементи
                                $ipz13 = []; //змінна групи ІПЗ-13 дорівнює пустому масиву де будуть виводитися елементи
                                $ipz11Start = 9;
                                $ipz12Start;
                                $ipz13Start = 17;
                                $howManyDays = 5;
                                if (isset($_POST["add"])) {
                                    $newStudent = [];
                                    $newStudent [] = $_POST["name"];
                                    $newStudent [] = $_POST["group"];
                                    $students [] = $newStudent;
                                    $_SESSION ["students"] = json_encode($students); //записує у сесію студентів у вигляді строки json
                                    header ('Location: index.php');
                                }
                                if (isset($_POST["delete"])) {
                                    array_splice ($students,$_POST["delete"],1);
                                    $_SESSION ["students"] = json_encode($students); //записує у сесію студентів у вигляді строки json
                                    header ('Location: index.php');
                                }
                                for ($i = 0; $i < $howManyDays; $i++, $ipz11Start++, $ipz13Start--) {
                                    $time1 = $time2 = $time3 = "";
                                    $ipz12Start = rand(9,17);
                                    if ($ipz11Start < 10) {
                                        $time1 .= 0;
                                    }
                                    if ($ipz12Start < 10) {
                                        $time2 .= 0;
                                    }
                                    if ($ipz13Start < 10) {
                                        $time3 .= 0;
                                    }
                                    $time1 .= $ipz11Start.":00";
                                    $time2 .= $ipz12Start.":00";
                                    $time3 .= $ipz13Start.":00";
                                    $ipz11 [] = $time1;// звертаємося до масиву і запушуємо нове число
                                    $ipz12 [] = $time2;
                                    $ipz13 [] = $time3;
                                }
                                for ($i = 0; $i < count($students); $i++) {
                                    echo ("<tr>");
                                    echo ("<td>".$students[$i][0]."</td>");
                                    echo ("<td>".$students[$i][1]."</td>");
                                    for ($j = 0; $j < $howManyDays; $j++) {
                                        if ($students[$i][1] == "ІПЗ-11") {
                                            echo ("<td>".$ipz11[$j]."</td>");
                                        }
                                        if ($students[$i][1] == "ІПЗ-12") {
                                            echo ("<td>".$ipz12[$j]."</td>");
                                        }
                                        if ($students[$i][1] == "ІПЗ-13") {
                                            echo ("<td>".$ipz13[$j]."</td>");
                                        }
                                    }
                                    echo ("<td><button type='submit' name='delete' value='$i'>-</button></td>");
                                    echo ("</tr>");
                                }
                            ?>
                        </tbody>
                    </table>
                    <label><input type="text" class="inputtext" placeholder="Введіть ім’я" name="name"></label>
                    <label>
                        <select class="inputtext" name="group" id="">
                            <option value="ІПЗ-11">ІПЗ-11</option>
                            <option value="ІПЗ-12">ІПЗ-12</option>
                            <option value="ІПЗ-13">ІПЗ-13</option>
                        </select>
                    </label>
                    <button type="submit" name="add" value="add">+</button>
                </form>
            </div>
        </main>
    </body>
</html>