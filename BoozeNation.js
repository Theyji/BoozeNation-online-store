/**
 * Javascript for BoozeNation WebApp
 * Author : Ayodeji Eniabire 
 * Date: November 22, 2022
 */

/**
 * Event contains events that happens at load of WebApp
 */
window.addEventListener('load', (loadpage) => {
    
    LoadItem('Category', 'All', 'Limit', '7', 'Offset', '0', 'table' ); // Load item list 
   
    MakeRequest('cart', 'cart', 'cart_table') // Load updated cart from session data 

    MakeRequest('CategoryList', 'List', 'List' ); // Load list of item category 
   
});

/**
 * Process Request and Response between HTML and PHP documents to update user with item list 
 * @param {*} field1 
 * @param {*} value1 
 * @param {*} field2 
 * @param {*} value2 
 * @param {*} field3 
 * @param {*} value3 
 * @param {*} HTMLParentTagID 
 */
function LoadItem(field1, value1, field2, value2, field3, value3, HTMLParentTagID){
    var http = new XMLHttpRequest();
    var url = 'BoozeNation.php';
    var params = field1 + "=" + value1 + "&" + field2 + "=" + value2 + "&" + field3 + "=" +value3 ;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            console.log("sucessful");
            var feedback = this.response;
            console.log(feedback);
            document.getElementById(HTMLParentTagID).innerHTML = feedback;
        }
    }
    http.send(params);

}

/**
 * process request and respose to update cart, category list, and view selected item 
 * @param {*} field 
 * @param {*} value 
 * @param {*} HTMLParentTagID 
 */
function MakeRequest(field, value, HTMLParentTagID){
    var http = new XMLHttpRequest();
    var url = 'BoozeNation.php';
    var params = field + "=" + value;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            console.log("sucessful");
            var feedback = this.response;
            console.log(feedback);
            document.getElementById(HTMLParentTagID).innerHTML = feedback;
        }
    }
    http.send(params);

}

/**
 * process request to add and remove item from cart 
 * @param {*} field 
 * @param {*} value 
 * @param {*} HTMLParentTagID 
 */
function Add_RemoveItem(field, value, HTMLParentTagID){
    var http = new XMLHttpRequest();
    var url = 'BoozeNation.php';
    var params = field + '=' + value;

    if (field == 'remove_item'){ // check if request is to remove item 

       if(confirm("Do you want to remove item")){ // confirm if user want to remove item 

        http.open('POST', url, true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                console.log("sucessful");
                var feedback = this.response;
                console.log(feedback);
                document.getElementById(HTMLParentTagID).innerHTML = feedback;
            }
        }
        http.send(params);
    
        LoadItem('Category', 'All', 'Limit', '7', 'Offset', '0', 'table' );
       }
       else{

       }
    }
    else{ // continue if request is not to remove item 
        http.open('POST', url, true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                console.log("sucessful");
                var feedback = this.response;
                console.log(feedback);
                document.getElementById(HTMLParentTagID).innerHTML = feedback;
            }
        }
        http.send(params);
    
        LoadItem('Category', 'All', 'Limit', '7', 'Offset', '0', 'table' );
    }

}






