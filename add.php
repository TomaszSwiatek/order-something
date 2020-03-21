<?php
//isset method checks is send everything to a server
// $_GET - it is globsal array where we store parameters/data sent with get request. so it checks is sent submit  value to this array or not? (this value is send after click submit button/input)
// if (isset($_GET['submit'])) {
//     echo $_GET['email']; //get methods shows what we send in our browser input
//     echo $_GET['title'];
//     echo $_GET['ingredients'];
// }
if (isset($_POST['submit'])) {


    //check email
    if (empty($_POST['email'])) { //if field is empty:
        echo 'An email is required <br>';
    } else {
        // if not:
        // echo htmlspecialchars($_POST['email']);
        //htmlspecialchars() method cause same thing like we would do in js with text method instead html, to avoid xss atacks.

        $email = $_POST['email'];
        //WE PLACE negation operator becouse we want to show message, if email variable isn't proper.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'this field must be a valid email address';
            //meth. filter_var takes to arguments: first the variable we want to filter, second - type of filter that we want to apply

        }
    }

    //check title
    if (empty($_POST['title'])) { //if field is empty:
        echo 'An title is required <br>';
    } else {
        // if not do the code:
        $title = $_POST['title'];
        // we have to negate becouse we want to show info, we input content doesnt match to pattern.
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {  //this is how we match something to regular expression. first arg. is an regular expression, second: varieble we match to our own expression
            echo 'Title must be letters and spaces only';
        }
    }

    //check ingredients
    if (empty($_POST['ingredients'])) { //if field is empty:
        echo 'At least one ingredient is required <br>';
    } else {
        // if not:
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) { //reg ex - list comma separated only.
            //if field isnt filled out properly (so error handling):
            echo 'Please write out only ingredients and separate them with comma!';
        }
    }
};
//END


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