var cost = 0;
function doAddAmountStock(maxAmount, price){
    let amount = + document.getElementsByClassName("detail")[0].getElementsByTagName("p")[1].innerHTML;
    if(amount+1<=maxAmount){
        let str = "";
        let count = 0;
        let p = price * (amount + 1);
        cost = p;
        console.log(p);
        while(p>=1){
            str = p % 10 + str;
            p = Math.floor(p/10);
            count += 1;
            if(count % 3 == 0){
                str = "." + str;
            }
        }
        document.getElementsByClassName("totalPrice")[0].getElementsByTagName("h2")[0].innerHTML = "Rp " + str + ",00";
        document.getElementsByClassName("detail")[0].getElementsByTagName("p")[1].innerHTML = 1+amount;
    }
}
function doDecreaseAmountStock(price){
    let amount = + document.getElementsByClassName("detail")[0].getElementsByTagName("p")[1].innerHTML;
    if(amount!=1){
        let str = "";
        let count = 0;
        let p = price * (amount - 1);
        cost = p;
        while(p>=1){
            str = p % 10 + str;
            p = Math.floor(p/10);
            count += 1;
            console.log(p);
            console.log(count);
            if(count % 3 == 0){
                str = "." + str;
            }
        }
        document.getElementsByClassName("totalPrice")[0].getElementsByTagName("h2")[0].innerHTML = "Rp " + str + ",00";
        document.getElementsByClassName("detail")[0].getElementsByTagName("p")[1].innerHTML = amount - 1;
    }
}
const formBuy = document.getElementById("formBuy");
function doBuy(event){
    event.preventDefault();
    let address = document.getElementById("addr").value;
    if(address==""){
        alert("Please input address!");
        document.location.reload();
    }
    else{
        let amount = document.getElementsByClassName("detail")[0].getElementsByTagName("p")[1].innerHTML;
        let name = document.getElementsByClassName("detail")[0].getElementsByTagName("h3")[0].innerHTML;
        console.log(address,amount,name,cost);
        var xhr = new XMLHttpRequest();
        let url = "action_buy.php";
        
        let params = "address=" + address + "&amount=" + amount + "&name=" + name + "&price=" + cost;
        xhr.open('POST', url);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = () => {
            if(xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText=="success"){
                    alert("buy successfull");
                    document.location.href='index.php';
                }
                else{
                    console.log(xhr.responseText);
                    alert("Server goes wrong, Please reload again");
                    document.location.reload();
                }
            }
        }

        xhr.send(params);  
    } 
}



formBuy.addEventListener('submit', doBuy);