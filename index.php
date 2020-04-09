<?php
include('config/db_connect.php');

$sql = 'SELECT title, ingredients, id FROM orders ORDER BY created_at'; //get all columns from orders table. ORDER BY sortus item in this case by timestamp
// make query and get result
$result = mysqli_query($conn, $sql);
//fetch the resulting rows as an array
$recipes = mysqli_fetch_all($result, MYSQLI_ASSOC); //MYSQLI_ASSOC = ASSOCIATIVE ARRAY KEY => VALUE as we rememeber
//after we ve fetched our data and saved in $receipts variable we can free result from memory
mysqli_free_result($result);
//and then close connection
mysqli_close($conn);


// print_r(explode(',', $recipes[0]['ingredients'])); // this method changes string to array - that's nice!
// print_r($recipes)  //echo out results on the top of the site, to check if its run
?>
<!DOCTYPE html>
<html lang="en">


<?php require 'templates/header.php'; ?>

<h4 class="center grey-text">Receipts!</h4>
<div class="container">
    <div class="row">
        <?php foreach ($recipes as $recipe) { ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($recipe['title']); ?></h6>
                        <ul>
                            <?php foreach (explode(',', $recipe['ingredients']) as $ingredient) { ?>
                                <li> <?php echo htmlspecialchars($ingredient);  ?></li>
                            <?php     } ?>
                        </ul>
                    </div>
                    <div class="card-action right-align">
                        <!-- in href we re doing something like get request which we can use just in details.php -->
                        <a href="details.php?id=<?php echo $recipe['id']; ?>" class="brand-text">more info</a>
                    </div>
                </div>
            </div>
        <?php   } ?>


    </div> <!-- end of row -->
    <div class="row">
        <!-- how many recipes are on site? -->
        <?php if (count($recipes) <= 3) :
        ?>
            <p><?php echo 'There are only 3 or less recipes' ?></p>
        <?php else : ?>
            <p><?php echo 'There are more than 3 recipes' ?></p>
        <?php endif; ?>
        <!--END - how many recipes are on site? -->
    </div> <!-- end of row -->

</div>
<?php require 'templates/footer.php'; ?>



</html>