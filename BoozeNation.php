<?php 
/**
 * BoozeNation PHP document view file 
 * calls functions from the logic model file (BoozeNationFunctions.php)
 * Author: Ayodeji Eniabire 000878946
 * Date: November 22, 2022
 */

include_once "BoozeNationFunctions.php";

session_start();

// create cart when session starts 
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();

}

// condition to update cart 
if (isset($_POST["cart"]) ){
    UpdateCart();
}

// add item to cart 
if (isset($_POST['add_item']) ) { 
	array_push($_SESSION['cart'],$_POST['add_item']);
    UpdateCart();
    RemoveFromQuantity();
    
}

// remove item from cart 
if (isset($_POST['remove_item']) ) {
	foreach ($_SESSION['cart'] as $key =>$value) {
		if ($value == $_POST['remove_item']) {
				unset($_SESSION['cart'][$key]);
				break;
		}
	}
    UpdateCart();
    AddToQuantity(); 
}

// list item in a category or all category 
if (isset($_POST["Category"]) && isset ($_POST["Offset"]) && isset($_POST["Limit"]) ) {

    CategoryItems($_POST["Category"], $_POST["Offset"], $_POST["Limit"]);
}

// list item categories 
if (isset($_POST["CategoryList"]) ){
    CategoryList();
}

// view item detail description 
if (isset($_POST["item"])){
    Itemview();
}

?>