    <!-- underneath methods to connect to our database ( we ve been created that with xampp, but it can also be real database on other machine/server - not my pc.) -->
    <!-- MySQLi ( more procedural manner) or PDO (oo approach) approach. We ll proceed firstly with mySqli but better one is PDO whats mean : php data objects. -->
    <?php
    // connect to database
    $conn = mysqli_connect('localhost', 'ofc', 'test123', 'order-something'); //host we choose in db, user name, pw, name of database we ve created;
    //check connection (error handling - if here is no connection):
    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();  //gonna echo specific error in interface
    }

    $sql = 'SELECT title, ingredients, id FROM orders'; //get all columns from orders table.
    // make query and get result
    $result = mysqli_query($conn, $sql);
    //fetch the resulting rows as an array
    $receipts = mysqli_fetch_all($result, MYSQLI_ASSOC); //MYSQLI_ASSOC = ASSOCIATIVE ARRAY KEY => VALUE as we rememeber
    //after we ve fetched our data and saved in $receipts variable we can free result from memory
    mysqli_free_result($result);
    //and then close connection
    mysqli_close($conn);

    print_r($receipts)
    ?>
    <!DOCTYPE html>
    <html lang="en">


    <?php require 'templates/header.php'; ?>
    <?php require 'templates/footer.php'; ?>



    </html>