function doAddAmountStock(maxAmount){
    console.log(maxAmount)
    let amount = + document.getElementsByClassName("detail")[0].getElementsByTagName("p")[1].innerHTML;
    console.log(amount)
    if(amount+1>=10){
        document.getElementById("countAmount").style.width = "142px"
    }
    document.getElementsByClassName("detail")[0].getElementsByTagName("p")[1].innerHTML = 1+amount;
}
function doDecreaseAmountStock(event){
    event.preventDefault();
    let amount = + document.getElementsByClassName("detail")[0].getElementsByTagName("p")[1].innerHTML;
    console.log(amount)
    if(amount-1<10){
        document.getElementById("countAmount").style.width = "134px"
    }
    if(amount-1>=1){
        document.getElementsByClassName("detail")[0].getElementsByTagName("p")[1].innerHTML = amount - 1;
    }
}
function doSubmitAdd(id){
    let amount = + document.getElementsByClassName("detail")[0].getElementsByTagName("p")[1].innerHTML;
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
document.getElementById("countAmount").getElementsByTagName("a")[0].addEventListener("click", doDecreaseAmountStock);