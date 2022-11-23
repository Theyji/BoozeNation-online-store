
<?php 
/**
 * this document contain PHP functions used in BoozeNation WebAPP
 * Author: Ayodeji Eniabire 000878946
 * Date: November22, 2022
 */

 // connection with database 
$servername = "localhost";
$username = "root";
$password = "mohawkcollege558";
$databaseName = "mydatabase";

$severConnection = mysqli_connect($servername, $username, $password, $databaseName);

if(!$severConnection){
    die("Connection failed: " . mysqli_connect_error());
}

/**
 * recieve itemlist request,
 * get requested list from database,
 * format list in HTML tags and 
 * echo HTML formated list 
 */
function CategoryItems($Category, $Offset, $Limit ) {

    $tableData = '<tr><th>Product ID</th><th>Product Name</th><th>Product Price</th><th>Product Category</th><th>Product Quantity</th></tr>'; // format itemlist table header

    // assign post request data for variable name 
    $Offset = (int) $_POST["Offset"];
    $Limit = (int) $_POST["Limit"];
    $Category = $_POST["Category"];

    GLOBAL $severConnection; // secure connection to database

    // logic for database search query to used based on requested list category 
    if ($Category == 'All'){ // if item list in all category is requested 
        $sql = "SELECT product_id, product_name, product_price,product_category, product_quantity FROM catalogue ORDER BY product_name ;";

        $result = mysqli_query($severConnection, $sql);
        $NumberOfRow = mysqli_num_rows($result);

        $sql = "SELECT product_id, product_name, product_price,product_category, product_quantity FROM catalogue ORDER BY product_name LIMIT $Offset, $Limit ;"; // Database selecte query
    }
    else{ // if item list in selected category is requested 
        $sql = "SELECT product_id, product_name, product_price,product_category, product_quantity FROM catalogue WHERE product_category= '$Category' ORDER BY product_name ;";

        $result = mysqli_query($severConnection, $sql);
        $NumberOfRow = mysqli_num_rows($result);

        $sql = "SELECT product_id, product_name, product_price,product_category, product_quantity FROM catalogue WHERE product_category= '$Category' ORDER BY product_name LIMIT $Offset, $Limit ;"; // Database select querey 
    }
 
    $result = mysqli_query($severConnection, $sql); // asign search result to a variable name 

    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) { // assign search result to an associative array 

            // insert search result in HTML table formt. function quantitycheck check if item quantity is 0 and display out of stock 
            $tablerow = '<td id="'.$row['product_id'].'" >'. $row['product_id']. '</td>'. '<td>'. $row['product_name']. '</td>'. '<td>'. $row['product_price']. '</td>'. '<td>' .$row['product_category']. '</td>'. '<td>'. quantityCheck($row['product_quantity']). '</td>' ;

            $tableData .= '<tr onclick="MakeRequest(\'' . 'item' . '\' , \'' . $row['product_id'] . '\' , \'' . 'table'. '\' )" >'. $tablerow . '</tr>'; // add onclick to each table row 
        }
    }

    echo AddButtons($NumberOfRow, $Limit, $Offset, $tableData ); // echo table with previous and next button
}

/**
 * this function add next and previous button to item list using limit and offset as refrence 
 */
function AddButtons($NumberOfRow, $Limit, $Offset, $tableData ){

    $NextButton = '<h4 id="buttonN" onclick="LoadItem(\'' . 'Category' . '\' , \'' . 'All' . '\' , \'' . 'Limit'. '\' , \'' . $Limit. '\' , \'' . 'Offset'. '\' ,  \'' . $Offset + 7 . '\' ,  \'' . 'table'. '\' )">Next</h4>';

    $PrevButton = '<h4 id="buttonP" onclick="LoadItem(\'' . 'Category' . '\' , \'' . 'All' . '\' , \'' . 'Limit'. '\' , \'' . $Limit. '\' , \'' . 'Offset'. '\' ,  \'' . $Offset - 7 . '\' ,  \'' . 'table'. '\' )">Prev</h4>';

    // add only next button if list is more than 7 rows 
    if (($NumberOfRow > $Limit )&& ($Offset <= 0) && ($Offset < $NumberOfRow) ) {
        $table = $tableData. '<tr id="button">'. '<td>'. $NextButton. '</td>'. '</tr>';
       
    }

    // add next and previous button on subsequent pages if there are more rows 
    if($NumberOfRow > 7 && $Offset > 0 && $Offset < $NumberOfRow){
        $table = $tableData. '<tr id="button">'.  '<td>'. $PrevButton. '</td>'.'<td>'. $NextButton. '</td>'. '</tr>';
        
    }

    // add only previous button to subsequent page if there are no more rows after 
    if($NumberOfRow > 7 && ($Offset+7) >= $NumberOfRow){
        
        $table = $table = $tableData. '<tr id="button">'. '<td>'. $PrevButton. '</td>'.  '</tr>';
    }

    // dont add next or previous button if list is not more than 7 rows
    if ($NumberOfRow <= 7){
        $table = $tableData;
    }

    return $table;
}

/**
 * get request to view item description
 * retrive item description form database 
 * insert item description in HTML table format 
 * echo item description 
 */
function ItemView() {
  
    $id = $_POST['item']; // assign post request data to variable 

    $tableData = '<tr><th>Product ID</th><th>Product Name</th><th>Product Description</th>'; // create table header 

    GLOBAL $severConnection; // secure database connection 

    $sql = "SELECT product_id, product_name, product_description, product_quantity FROM catalogue WHERE product_id= '$id' ;"; // database select statement 
   
    $result = mysqli_query($severConnection, $sql);

    if (mysqli_num_rows($result) > 0) { 
        while($row = mysqli_fetch_assoc($result)) {

            $quantity = $row['product_quantity']; // assign item quantity in database to variable 

            $input = $row['product_id']; // assign item id in database to a variable

            $tablerow = '<td>'. $row['product_id']. '</td>'. '<td>'. $row['product_name']. '</td>'. '<td>'. $row['product_description']. '</td>'. '<td>'. CartCheck($quantity, $input); // this function check for product quantiy and contol its addition to cart 
            $tableData .= '<tr>'. $tablerow . '</tr>' ; // insert item description data in HTML table format
        }
        echo $tableData;
    }
    else {
        echo "Error: " . $sql . "<br>" . $severConnection->error;
    }
}  

/**
 * get details of items added in cart from database and echo it in HTML formated table 
 */
function UpdateCart(){

    GLOBAL $severConnection; // secure database connection 

    $table = ""; // instantiate variable for HTML formated table 

    $tableData = '<tr><th>Product ID</th><th>Product Name</th><th>Product Price</th>'; // table header 

    foreach ($_SESSION['cart'] as  $cart_item) { // loop to select each item added in the cart
       
        $sql = "SELECT product_id, product_name, product_price FROM catalogue WHERE product_id= '$cart_item' ;"; // select query to get details of cart items from database

        $result = mysqli_query($severConnection, $sql);

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) { // assign query result to associative array 
                
                $tablerow = '</td>'. '<td>'. $row['product_id']. '</td>'. '<td>'. $row['product_name']. '</td>'. '<td>'. $row['product_price']. '</td>'. '<td>'. '<button id="Removebutton" onclick="Add_RemoveItem(\'' . 'remove_item' . '\' , \'' . $row['product_id'] . '\' , \'' . 'cart_table'. '\' )">Remove Item</button>'; // insert query result in HTML formated table 
    
                $table .= '<tr>'. $tablerow . '</tr>' ;      
            }
        }
	}
    echo $tableData .$table;
}

/**
 * update databse if item is remove from cart 
 * item removed from cart is added to item in the database 
 */
function AddToQuantity(){

    GLOBAL $severConnection;

    $cart_item = $_POST['remove_item']; // assign variable to item removal POST request value 

    $sql = "SELECT product_quantity FROM catalogue WHERE product_id= '$cart_item'; "; // select query to get the current quantity of item to add in database 

    $result = mysqli_query($severConnection, $sql);

    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {
            $quantity = $row['product_quantity']+1; // add 1 to query result and assign it a variable 
        }

        $sql = "UPDATE catalogue SET product_quantity= '$quantity' WHERE product_id= '$cart_item';"; // update item quantity in database with the new quantity 

        if (mysqli_query($severConnection, $sql)) {
            echo "";
          } else {
            echo "Error updating record: " . mysqli_error($severConnection);
          }
    }else {
        echo "Error updating record: " . $severConnection->error;
    }
}

/**
 * update databse if item is added to cart 
 * addition of item to cart removes it from database 
 */
function RemoveFromQuantity(){

    GLOBAL $severConnection;

    $cart_item = $_POST['add_item']; // assign variable to item addition POST request value 

    $sql = "SELECT product_quantity FROM catalogue WHERE product_id='$cart_item' "; // select query to get the current quantity of item to remove in database 

    $result = mysqli_query($severConnection, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {

            $quantity = $row['product_quantity']; // assign variable to quantity search result 
            if ($quantity < 1 ){ // if less than 1, no action taken 
                $quantity = $quantity;
            }
            else{ // if greater than 1, minus 1 from it 
                $quantity--;
            }
        }   

        $sql = "UPDATE catalogue SET product_quantity= '$quantity' WHERE product_id='$cart_item';"; // update database with the new quantity 

        if (mysqli_query($severConnection, $sql)) {
            echo "";
          } else {
            echo "Error updating record: " . mysqli_error($severConnection);
          }
    }else {
        echo "Error updating record: " . $severConnection->error;
    }
        
}

/**
 * get list of item categories from database 
 */
function CategoryList(){

    GLOBAL $severConnection;

    $list = '';
    
    // create additional category outside the list from database 
    $All = '<li id="Allcart" onclick="LoadItem(\'' . 'Category' . '\' , \'' . 'All' . '\'   , \'' . 'Limit'. '\' , \'' . '7'. '\' , \'' . 'Offset'. '\' , \'' . '0'. '\' , \'' . 'table'. '\'  )">All</li>'. '<br>';

    $sql = "SELECT DISTINCT product_category FROM catalogue "; // select query to get category list from database 

    $result = mysqli_query($severConnection, $sql);

    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

            for($i = 0; $i< count($row); $i++){ // loop through list of category and insert in HTML formated table
  
                $list .= '<li id=\'' . $row[$i]. '\' onclick="LoadItem(\'' . 'Category' . '\' , \'' . $row[$i] . '\'  , \'' . 'Limit'. '\' , \'' . '7'. '\' , \'' . 'Offset'. '\' , \'' . '0'. '\' , \'' . 'table'. '\' )" >'.$row[$i].'</li>'.'<br>'; 
            }
        } 
    }

    echo $All.$list;
}

/**
 * check item quantity and alert display out of stock if below 1 
 */
function quantityCheck($check){
	if ( $check <= 0 ){
		$check = '<span style="color:#FF0000;">Out of Stock</span>';
	}
	else{
		$check = $check;
	}

    return $check;
}

/**
 * check item quantity and disable add button if less than 1 
 */
function CartCheck($check, $input){
    $output = '';
    if ( $check <= 0 ){
        $output = '<button disabled onclick="Add'.$check.'()"><span style="color:#FF0000;">Out of Stock</span></button>';
    }
    else{
        $output = '<button id="addbutton" onclick="Add_RemoveItem(\'' . 'add_item' . '\' , \'' . $input . '\' , \'' . 'cart_table'. '\' )">Add Item</button>';
    }

    return $output;
}


?>