confirmCancel(oid)  
{ 
    var confirm = confirm("Do you want to cancel the order ? ");
    if(confirm)
    {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "CancelOrder.php");
        xhr.onload = function () {
            console.log(this.response);
        };
        xhr.send(oid);
        return false;
    }
    else
    {
        window.location.replace('Orders.php');
    }
}