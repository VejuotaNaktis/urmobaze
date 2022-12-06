<?php
session_start();
include "./ShopsController.php";
$edit = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['save'])) {
        ShopsController::store();
        header("Location: ./index.php");
        die;
    }
    if (isset($_POST['edit'])) {
        session_unset();
        $shop = ShopsController::show();
        $edit = true;
    }

    if (isset($_POST['update'])) {
        print_r($_POST);
        ShopsController::update();
        header("Location: ./index.php");
        die;
    }
    if (isset($_POST['destroy'])) {
        session_unset();
        ShopsController::destroy();
        header("Location: ./index.php");
        die;
    }
}
$shops = ShopsController::index();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ec862e51e4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
</head>

<body class=" <?= $edit ? "stop-scrolling" : "" ?>">
    <header>
        <?php
        if (isset($_SESSION['error'])) {
        ?>
            <span class="red-text"><?= $_SESSION['error'] ?></span>

        <?php
        }

        ?>
        <nav class="navbar">
            <form action="" method="post">
                <a href="#" class="nav-branding">Urmobaze.</a>

                <ul class="nav-menu <?= $edit ? "active" : "" ?>">
                    <li class="nav-item">
                        <input class="nav-link" type="text" name="name" value="<?= $edit ? $shop->name : "" ?>">name<br>
                    </li>
                    <li class="nav-item">
                        <input class="nav-link" type="text" name="sales_field" value="<?= $edit ? $shop->sales_field : "" ?>">sales_field<br>
                    </li>
                    <li class="nav-item">
                        <input class="nav-link" id="checkbox" type="checkbox" name="accepts_card" <?php echo $edit && $shop->accepts_card ? 'checked' : '' ?>>accepts_card<br>
                    </li>
                    <li class="nav-item">
                        <input class="nav-link" type="number" name="items_quantity" value="<?= $edit ? $shop->items_quantity : "" ?>">items_quantity<br>
                    </li>
                    <li>
                        <input type="hidden" id="id" name="id" value="<?= $edit ? $shop->id : "" ?>">
                    </li>
                    <li class=" nav-item" id="btnContainer">
                        <?php
                        if ($edit) { ?>
                            <button id="btnUpdate" type="submit" name="update" class="btn btn-success">update</button>
                        <?php } else { ?>
                            <button type="submit" name="save" class="btn btn-primary">save</button>
                        <?php } ?>
                    </li>
                </ul>
            </form>

            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>

    <div class="container">
        <table class="table table-sm table-dark">
            <tr>
                <th>id</th>
                <th>name</th>
                <th>sales_field</th>
                <th>accepts_card</th>
                <th>items_quantity</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
            <?php foreach ($shops as $shop) { ?>
                <tr>
                    <td><?= $shop->id; ?> </td>
                    <td><?= $shop->name; ?> </td>
                    <td><?= $shop->sales_field; ?> </td>
                    <td> <input type="checkbox" disabled readonly <?php echo $shop->accepts_card == 1 ? 'checked' : ''; ?> /></td>
                    <td><?= $shop->items_quantity; ?> </td>

                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $shop->id ?>">
                            <button id="btnEdit" type="submit" name="edit" class="btn btn-primary">edit</button>
                        </form>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $shop->id ?>">
                            <button type="submit" name="destroy" class="btn btn-danger">delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <footer>
        <div class="footer">
            <div class="inner-footer">
                <div class="social-links">
                    <ul>
                        <li class="social-items"><a href="#"><i class="fa-brands fa-square-facebook"></i></a></li>
                        <li class="social-items"><a href="#"><i class="fa-brands fa-square-twitter"></i></a></li>
                        <li class="social-items"><a href="#"><i class="fa-brands fa-square-instagram"></i></a></li>
                        <li class="social-items"><a href="#"><i class="fa-brands fa-square-tumblr"></i></li>
                    </ul>
                </div>
                <div class="quick-links">
                    <ul>
                        <li class="quick-items"><a href="#">Home</a></li>
                        <li class="quick-items"><a href="#">Tutorial</a></li>
                        <li class="quick-items"><a href="#">Services</a></li>
                        <li class="quick-items"><a href="#">About us</a></li>
                        <li class="quick-items"><a href="#">Contact us</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </footer>

    <script src="./script.js"></script>
</body>

</html>