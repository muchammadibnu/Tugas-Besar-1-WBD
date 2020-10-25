const formLogin = document.getElementById("formLogin");

function doLogin(event){
    event.preventDefault();
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    var xhr = new XMLHttpRequest();
    var url = "action_login.php";
    
    var params = "email=" + email + "&password=" + password;
    xhr.open('POST', url);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = () => {
        console.log(xhr.status);
        if(xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText=="success"){
                alert("login successfull");
                document.location.href='index.php';
            }
            else{
                console.log(xhr.responseText);
                errorNotifLogin.innerHTML =  "<p>email or password invalid</p>";
            }
        }
    }

    xhr.send(params);   
}

formLogin.addEventListener('submit', doLogin);