<?php
$servername = "localhost";
$database = "student";
$username = "root";
$password = "root";
// Создаем соединение
$connection = mysqli_connect($servername, $username, $password, $database);
$title = 'Список студентов';
require 'head.php';
?>
    <div class="container">
    <div class="jumbotron mt-4">
    <h1 class="display-4"><?php echo $title; ?></h1>
    <p class="lead">ООО Евросвет</p>
    <hr class="my-4">
    <p class="lead">
    <?php
    if (isset($_POST['save'])) {
        $fio = htmlspecialchars($_POST['fio']);
        $kurs = intval($_POST['kurs']);
        $res = mysqli_query($connection, "INSERT INTO student (fio, kurs) VALUES ('$fio','$kurs')");
        echo'<div class="alert alert-success mt-4" role="alert">Студент успешно добавлен</div>';
    }
    if (isset($_GET['del'])) {
        $id = intval($_GET['del']);
        $res1 = mysqli_query($connection, "DELETE FROM student WHERE id='$id'");
        echo'<div class="alert alert-warning mt-4" role="alert">Студент удален</div>';
    }
    ?>

    <form class="mt-4" action="" method="post">
        <div class="col-md-12 mb-3">
            <label for="fio" class="form-label">Ф.И.О. студента</label>
            <input type="text" class="form-control" name="fio" id="fio" placeholder="Введите Ф.И.О. студента">
        </div>
        <div class="col-md-12 mb-3">
            <label for="kurs" class="form-label">Курс</label>
            <select class="form-select" name="kurs" aria-label="kurs">
                <option value="1">Первый курс</option>
                <option value="2">Второй курс</option>
                <option value="3">Третий курс</option>
                <option value="4">Четвертый курс</option>
                <option value="5">Пятый курс</option>
            </select>
        </div>
        <input type="submit" name="save" class="btn btn-primary" value="Сохранить">
    </form>
    <hr>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID студента</th>
            <th>Ф.И.О. студента</th>
            <th>Курс</th>
            <th><i class="fa fa-trash-o"></i></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $res = mysqli_query($connection, "SELECT * FROM student ORDER by id");
        while ($rew = mysqli_fetch_array($res)) {
            echo'
            <tr>
                <td>'.$rew['id'].'</td>
                <td><a href="edit.php?id='.$rew['id'].'">'.htmlspecialchars($rew['fio']).'</a></td>';
            if ($rew['kurs'] == 1) {
                $type = 'Первый курс';
            } elseif ($rew['kurs'] == 2) {
                $type = 'Второй курс';
            } elseif ($rew['kurs'] == 3) {
                $type = 'Третий курс';
            } elseif ($rew['kurs'] == 4) {
                $type = 'Четвертый курс';
            } else { $type = 'Пятый курс'; }
                echo'<td>'.$type.'</td>
                <td><a href="?del='.$rew['id'].'" class="link-danger">Удалить</a></td>
            </tr>';
        }
        ?>
        </tbody>    
    </table>
</div>
<?php
require_once 'foot.php';