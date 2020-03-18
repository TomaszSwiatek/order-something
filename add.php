<?php
//isset method checks is send everything to a server
// $_GET - it is globsal array where we store parameters/data sent with get request. so it checks is sent submit  value to this array or not? (this value is send after click submit button/input)
// if (isset($_GET['submit'])) {
//     echo $_GET['email'];
//     echo $_GET['title'];
//     echo $_GET['ingredients'];
// }
if (isset($_POST['submit'])) {
    echo $_POST['email'];
    echo $_POST['title'];
    echo $_POST['ingredients'];
}

?>

<!DOCTYPE html>
<html lang="en">

<?php require 'templates/header.php'; ?>

<section class="container grey-text">
    <h4 class="center">Add something</h4>
    <form action="add.php" method="POST" class="white">
        <label for="">Your Email:</label>
        <input type="text" name="email">

        <label for="">Title:</label>
        <input type="text" name="title">

        <label for="">Ingredients (comma separated):</label>
        <input type="text" name="ingredients">
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php require 'templates/footer.php'; ?>



</html>