function doAddAmountStock(maxAmount){
    console.log(maxAmount)
    let amount = + document.getElementsByTagName("p")[2].innerHTML;
    if(amount+1<=maxAmount){
        if(amount+1>=10){
            document.getElementById("countAmount").style.width = "142px"
        }
        document.getElementsByTagName("p")[2].innerHTML = 1+amount;
    }
}
function doDecreaseAmountStock(event){
    event.preventDefault();
    let amount = + document.getElementsByTagName("p")[2].innerHTML;
    if(amount!=1){
        if(amount-1<10){
            document.getElementById("countAmount").style.width = "134px"
        }
        document.getElementsByTagName("p")[2].innerHTML = amount - 1;
    }
}
function doSubmitAdd(id){
    let amount = + document.getElementsByTagName("p")[2].innerHTML;
    var xhr = new XMLHttpRequest();

    var url = "action_AddStock.php";
    console.log(id)
    var params = "amount=" + amount + "&id=" +id;
    xhr.open('POST', url);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText=="success"){
                alert("add stock successfull");
                document.location.href='index.php';
            }
            else{
                alert("Server goes wrong, Please reload again");
                document.location.reload();
            }
        }
    }
    xhr.send(params);
}
function doSubmitCancel(event){
    event.preventDefault();
    document.location.href='index.php';
}
document.getElementsByTagName("a")[0].addEventListener("click", doDecreaseAmountStock);
document.getElementsByTagName("button")[1].addEventListener("click", doSubmitCancel);