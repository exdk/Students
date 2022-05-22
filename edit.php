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
    <p class="lead">Редактирование данных студента | <a href="index.php">Добавить нового</a></p>
    <hr class="my-4">
    <p class="lead">
    <?php
    $ids = intval($_GET['id']);
    if (isset($_POST['save'])) {
        $fio = htmlspecialchars($_POST['fio']);
        $kurs = intval($_POST['kurs']);
        $res_update = mysqli_query($connection, "UPDATE student SET fio = '".$fio."', kurs = '".$kurs."' WHERE id = '".$ids."'");
        echo'<div class="alert alert-success mt-4" role="alert">Данные студента изменены</div>';
    }
    $rew1 = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM student WHERE id = '$ids'"));
    $res = mysqli_query($connection, "SELECT * FROM student ORDER by id");
    ?>

    <form class="mt-4" action="?id=<?php echo $ids; ?>" method="post">
        <div class="col-md-12 mb-3">
            <label for="fio" class="form-label">Ф.И.О. студента</label>
            <input type="text" class="form-control" name="fio" id="fio" value="<?php echo $rew1['fio']; ?>">
        </div>
        <div class="col-md-12 mb-3">
            <label for="kurs" class="form-label">Курс</label>
            <select class="form-select" name="kurs" aria-label="kurs">
                <?php
                if ($rew1['kurs'] == 1) {
                    echo'<option value="1" selected>Первый курс</option>';
                } elseif ($rew1['kurs'] == 2) {
                    echo'<option value="2" selected>Второй курс</option>';
                } elseif ($rew1['kurs'] == 3) {
                    echo'<option value="3" selected>Третий курс</option>';
                } elseif ($rew1['kurs'] == 4) {
                    echo'<option value="4" selected>Четвертый курс</option>';
                } else {
                    echo'<option value="5" selected>Пятый курс</option>';
                }
                ?>
                <option value="1">Первый курс</option>
                <option value="2">Второй курс</option>
                <option value="3">Третий курс</option>
                <option value="4">Четвертый курс</option>
                <option value="5">Пятый курс</option>
            </select>
        </div>
        <button type="submit" name="save" class="btn btn-primary">Сохранить</button>
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
        while ($rew=mysqli_fetch_array($res)) {
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
            echo'
                <td>'.$type.'</td>
                <td><a href="index.php?del='.$rew['id'].'" class="link-danger">Удалить</a></td>
            </tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<?php
require_once 'foot.php';