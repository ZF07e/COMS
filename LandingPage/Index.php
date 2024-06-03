<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS</title>

        <link rel="stylesheet" href="Styles/general-style.css">
        <link rel="stylesheet" href="Styles/header-style.css">     
        <link rel="stylesheet" href="Styles/home-main-style.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <header><!--Header-->
            <nav class="leftPanel">
                <a href="Index.php"><h2 class="Logo"><span>CO</span>MS<span>.</span></h2></a>
                <a class="selected" href="Index.php"><div>Home</div></a>
                <a href="Associations.php"><div>Associations</div></a>
            </nav>
        </header><!--Header END-->
        <main>
            <div class="logincontainer">

                <div class="TitleDesc">
                    <h1><span>CO</span>MS<span>:</span> <span>Club</span> and <span>Organization</span> Management System.</h1>
                    <p>Your Ultimate Club and Organization Management </p>
                </div>

                <form action = "http://localhost/COMS/LandingPage/Functions/UserLogin.php" method = "POST">
                    <h3 class="LoginTitleForm">LOGIN</h3>
                    
                    <div id="inputsContainer">
                        <input type="text" name="inputEmail" id="inputEmail" placeholder="Outlook Email">
                        <div id="passwordCon">
                            <input type="password" name="inputPassword" id="password" placeholder="Password">
                            <button id="seePass" type="button"><img src="../Images/Icons/icons8-eye-15.png" alt=""></button>
                        </div>   
                        <button type="button" id="loginButtonInput">Login</button>
                        <p>- Or -</p>
                    </div>

                    <div class="buttoncontainer">
                            <button type = "submit" name = "login">
                            <img src="../Images/Icons/icons8-microsoft-30.png" alt="">    
                            Continue With Microsoft </button>
                    </div>
                    <p id="noAcc">No Account? <a href="Associations.php" id="applyText">Apply To The Organization/Club</a></p>
             
                </form>
            </div>

        </main>
        <script src="./Scripts/index-script.js"></script>
    </body>
</html>