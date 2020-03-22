<?php
include('config/db_connect.php');  //db connection so we can save something to db;
//isset method checks is send everything to a server
// $_GET - it is globsal array where we store parameters/data sent with get request. so it checks is sent submit  value to this array or not? (this value is send after click submit button/input)
// if (isset($_GET['submit'])) {
//     echo $_GET['email']; //get methods shows what we send in our browser input
//     echo $_GET['title'];
//     echo $_GET['ingredients'];
// }
//array of errors to store them, and show in inteface form:
$errors = array('email' => '', 'title' => '', 'ingredients' => '');

if (isset($_POST['submit'])) {


    //check email
    if (empty($_POST['email'])) { //if field is empty:
        $errors['email'] = 'An email is required <br>';
    } else {
        // if not:
        // echo htmlspecialchars($_POST['email']);
        //htmlspecialchars() method cause same thing like we would do in js with text method instead html, to avoid xss atacks.

        $email = $_POST['email'];
        //WE PLACE negation operator becouse we want to show message, if email variable isn't proper.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'This field must be a valid email address';
            //meth. filter_var takes to arguments: first the variable we want to filter, second - type of filter that we want to apply

        }
    }

    //check title
    if (empty($_POST['title'])) { //if field is empty:
        $errors['title'] = 'An title is required <br>';
    } else {
        // if not do the code:
        $title = $_POST['title'];
        // we have to negate becouse we want to show info, we input content doesnt match to pattern.
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {  //this is how we match something to regular expression. first arg. is an regular expression, second: varieble we match to our own expression
            $errors['title'] = 'Title must be letters and spaces only';
        }
    }

    //check ingredients
    if (empty($_POST['ingredients'])) { //if field is empty:
        $errors['ingredients'] = 'At least one ingredient is required <br>';
    } else {
        // if not:
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) { //reg ex - list comma separated only.
            //if field isnt filled out properly (so error handling):
            $errors['ingredients'] = 'Please write out only ingredients and separate them with comma (no special characters)!';
        }
    }

    //Are the errors in form or not - show info

    if (!array_filter($errors)) {

        //we overwrite variables to avoid harmful code added to db:
        $email = mysqli_real_escape_string($conn, $_POST['email']); // email is from name in input. $conn goes from external db_connect.php file.
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        //create sql code to save above data to our sql db - thats only query - it dont save it!
        $sql = "INSERT INTO orders(title, email, ingredients) VALUES ('$title','$email','$ingredients')";
    }
    // now if conn and query is alright save to db:
    if (mysqli_query($conn, $sql)) { //this is in if statement but it does save to db!!!
        // success
        header('Location: index.php'); //return true if something is in our errors array (but we negate it so we react to situation when is no errors - we move back to main page.);
    } else {
        // error
        echo 'query error (cant save to db): ' . mysqli_error($conn);
    }
    // array_filter($errors) ?  'errors' :  'no errors';
}; //END of post check



?>

<!DOCTYPE html>
<html lang="en">

<?php require 'templates/header.php'; ?>

<section class="container grey-text">
    <h4 class="center">Add recipe</h4>
    <form action="add.php" method="POST" class="white">
        <label for="">Your Email:</label>
        <input type="text" name="email" value="<?php echo empty($email) ? '' : htmlspecialchars($email);  ?>">
        <div class="error-text"><?php echo $errors['email']; ?> </div>

        <label for="">Title:</label>
        <input type="text" name="title" value="<?php echo empty($title) ? '' : htmlspecialchars($title);  ?>">
        <div class="error-text"><?php echo $errors['title']; ?></div>


        <label for="">Ingredients (comma separated):</label>
        <input type="text" name="ingredients" value="<?php echo empty($ingredients) ? '' : htmlspecialchars($ingredients) ?>">
        <div class="error-text"><?php echo $errors['ingredients']; ?></div>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php require 'templates/footer.php'; ?>



</html>