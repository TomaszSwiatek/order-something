    <!-- underneath methods to connect to our database ( we ve been created that with xampp, but it can also be real database on other machine/server - not my pc.) -->
    <!-- MySQLi ( more procedural manner) or PDO (oo approach) approach. We ll proceed firstly with mySqli but better one is PDO whats mean : php data objects. -->
    <?php
    // connect to database
    $conn = mysqli_connect('localhost', 'ofc', 'test123', 'order-something'); //host we choose in db, user name, pw, name of database we ve created;
    //check connection (error handling - if here is no connection):
    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error(); //gonna echo specific error in interface
    }
    ?>