<?php
include('config/db_connect.php');
// check get request is proper
if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // make sql
    //pull one order from orders matrix where id is equal to id's clicked card.
    $sql = "SELECT * FROM orders WHERE id = $id"; //have to be double quotes
    // get the query result
    $result = mysqli_query($conn, $sql);
    // fetch the result in array format:
    $recipe = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
    // print_r($recipe);
}




?>
<!DOCTYPE html>
<html>
<?php require 'templates/header.php'; ?>

<div class="container center">

    <?php if ($recipe) : ?>

        <h4><?php echo $recipe['title']; ?></h4>
        <p>ingredients:
            <?php foreach (explode(',', $recipe['ingredients']) as $ingredient) { ?>
                <ul>
                    <li> <?php echo htmlspecialchars($ingredient); ?></li>
                </ul>
            <?php }; ?>
        </p>

    <?php else : ?>
        <h4>No such a recipe!</h4>
    <?php endif; ?>


</div>
<!-- //end of container -->
<?php require 'templates/footer.php'; ?>

</html>