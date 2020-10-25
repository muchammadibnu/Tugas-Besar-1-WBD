const formRegister = document.getElementById("formRegister");

function doRegister(event){
    event.preventDefault();

    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const errorNotifRegister = document.getElementById("errorNotifRegister");

    errorNotifRegister.innerText ="";

    // check for errors
    var errorMessages = [];
    if (username == null || username.value === '' ){
        errorMessages.push("Name is required");
    }
    else{
        if (!(/^[a-zA-Z0-9_]*$/.test(username.value))){
            errorMessages.push("Username must be alphabet/number/underscore")
        }
    }

    if ( email  == null || email.value === ''){
        errorMessages.push("Email is required");
    }
    else{
        if (!(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email.value))){
            errorMessages.push("Email format is incorrect");
        }
    }

    if (password == null ||password.value === '' ){
        errorMessages.push("Password is required");
    }
    

    if (confirmPassword == null || confirmPassword.value === ''){
        errorMessages.push("Password confirmation is required");
    }
    else{
        if (password.value != confirmPassword.value){
            errorMessages.push("Password confirmation not matched");
        }
    }

    // if there is error
    if (errorMessages.length > 0 ){
        console.log(errorMessages);
        newHTML = '<ul>';
        for (i in errorMessages){
            newHTML += "<li>" + errorMessages[i] + "</li>";
        }
        newHTML += '</ul>';
        errorNotifRegister.innerHTML = newHTML;
    }
    else{ 
        // check if there is a duplicate on username or email
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 &&  xhr.status == 200) {
                if (xhr.responseText =='valid'){
                    // all valid -> do post register
                    postRegister(username.value, email.value, password.value);
                }
                else if(xhr.responseText =='invalid'){
                    errorNotifRegister.innerHTML = "<p>Username or email is already taken</p>";
                }
                else{
                    errorNotifRegister.innerHTML = "<p>error: database connection went wrong</p>";
                }
            }
        }
       
        xhr.open('GET', 'action_user.php?username=' + username.value + "&email=" +email.value);
        xhr.send();
    }
}

function postRegister(username, email, password){
    var xhr = new XMLHttpRequest();
    var url = "action_register.php";
    var params = "username=" + username + "&email=" + email + "&password=" + password;
    xhr.open('POST', url);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = () => {
        console.log(xhr.status);
        if(xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText=="success"){
                alert("registration successfull");
                document.location.href='index.php';
            }
            else{
                alert("something went wrong, please try again");
            }
        }
    }

    xhr.send(params);
}

formRegister.addEventListener('submit', doRegister);


const formLogin = document.getElementById("formLogin");

