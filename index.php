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


<div class="container">
    <div class="section">
        <div class="row">
            <!-- so it has width 6/12, but is moved to the right cca 2/12 -->
            <div class="col s12 m6 offset-m2">
                <blockquote class="flow-text ">
                    A recipe has no soul. You as the cook must bring soul to the recipe.
                    <br> Thomas Keller
                </blockquote>
            </div>
        </div>
    </div>
    <div class="row">


        <?php foreach ($recipes as $recipe) { ?>
            <div class="col s12 m6 l4 xl3">
                <div class="card  hoverable">
                    <div class="card-content center">
                        <img src="img/note.svg" alt="sticky note image to each recipe item" class="index-item-img">
                        <h6><?php echo htmlspecialchars($recipe['title']); ?></h6>
                        <p>Ingredients:</p>
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
            <p class="flow-text center-align"><?php echo 'There are only 3 or less recipes' ?></p>
        <?php else : ?>
            <p class="flow-text center-align"><?php echo 'There are more than 3 recipes' ?></p>
        <?php endif; ?>
        <!--END - how many recipes are on site? -->
    </div> <!-- end of row -->

</div>
<?php require 'templates/footer.php'; ?>



</html>