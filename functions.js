function displayLogIn(){
    let html = `
    <div class="sign-in-header transition">
        <button style="border-right: 1px solid rgba(0,0,0,0.1);"
            onclick="displayLogIn();">
            Log-in
        </button>
        <button style="color: rgba(0,0,0,0.2);" onclick="displayRegister();">
            Register
        </button>
    </div>
    <form class="input-grid" action="webstore.php" method="POST" style="grid-template-rows: repeat(2, 50px);"> 
        <input type="text" name="user_name" id="user_name" placeholder="User name" required>
        <input type="password" name="pass" id="pass" placeholder="Password" required>
        <input type="submit" class="button green" name="signIn">
    </form>`;

    document.body.querySelector('.form-container').innerHTML= html;
}

function displayRegister(){
    let html = `
    <div class="sign-in-header transition">
        <button style="border-right: 1px solid rgba(0,0,0,0.1); color: rgba(0,0,0,0.2);"
            onclick="displayLogIn();">
            Log-in
        </button>
        <button onclick="displayRegister();" style="background-color: background-color: rgba(0,0,0,0.05);">
            Register
        </button>
    </div>
    <form class="input-grid" action="validateUser.php" method="POST" style="grid-template-rows: repeat(6, 50px);"> 
        <input type="text" name="name" id="name" placeholder="Full name" required>
        <input type="text" name="user_name" id="user_name" placeholder="User name" required>
        <input type="text" name="ign" id="ign" placeholder="Player id   ####-####-####" required>
        <input type="text" name="email" id="email" placeholder="Email address" required>
        <input type="password" name="pass" id="pass" placeholder="Password (at least 8 characters)" required>
        <input type="password" name="cpass" id="cpass" placeholder="Confirm your password" required>
        <input type="submit" class="button green">
    </form>`;

    document.body.querySelector('.form-container').innerHTML= html;
}

function toggleVisibility(class_name){
    let popup = document.body.querySelector(class_name);
    
    popup.style.visibility = popup.style.visibility === 'hidden'?'visible':'hidden';
}

function callPhp(functionName, param = 0){
    $.ajax({
        url: "functions.php",
        type: "POST",
        data: {functionName, param},
        success: function(response) {
            if(response === 'added'){
                alert("Item added to cart!");
                cartCount++;
                document.body.querySelector('.cart-count').innerHTML= cartCount;
            }

            else if(response === 'not added'){
                alert("Sorry item is out of stock");
            }

            else if(response === 'removed' || response === 'removedAll'){
                location.reload();
            }
            
            else if(response === 'transacted'){
                location.reload();
                alert("Transaction Successful!");
            }

            else if(response === 'not transacted'){
                alert("Transaction Failed: Insuffiecient coin balance");
            }

            else if(response === 'paid'){
                
                console.log(response);
            }

            else{
                console.log(response);
            }
        },
    });
}

let gcashInput = document.querySelector(".gcash-number");
let payButton = document.querySelector(".pay-button");

gcashInput.addEventListener("input", function() {
    let gcashNumber = gcashInput.value.trim();
    let isValid = /^09\d{9}$/.test(gcashNumber);
    
    if (isValid){
        payButton.disabled = false;
        payButton.style.opacity = "1";
        payButton.style.pointerEvents = "auto";
    }
    
    else{
        payButton.disabled = true;
        payButton.style.opacity = "0.5";
        payButton.style.pointerEvents = "none"; 
    }
});