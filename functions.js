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
    <form class="input-grid" action="webstore.html" method="POST"style="grid-template-rows: repeat(2, 50px);"> 
        <input type="text" name="uname" id="uname" placeholder="Username" required>
        <input type="text" name="pass" id="pass" placeholder="Password" required>
        <input type="submit" class="button green">
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
        <button onclick="displayLogIn();" style="background-color: background-color: rgba(0,0,0,0.05);">
            Register
        </button>
    </div>
    <form class="input-grid" action="welcome.php" method="POST" style="grid-template-rows: repeat(6, 50px);"> 
        <input type="text" name="name" id="name" placeholder="Full name" required>
        <input type="text" name="user_name" id="user_name" placeholder="User name" required>
        <input type="text" name="email" id="email" placeholder="Email address">
        <input type="text" name="pass" id="pass" placeholder="Password (at least 8 characters)" required>
        <input type="text" name="cpass" id="cpass" placeholder="Confirm your password" required>
        <input type="submit" class="button green">
    </form>`;

    document.body.querySelector('.form-container').innerHTML= html;
}

function profilePopup(){
    let popup = document.body.querySelector(".profile-popup");
    
    popup.style.visibility = popup.style.visibility === 'hidden'?'visible':'hidden';
}