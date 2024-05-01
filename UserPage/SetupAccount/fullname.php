<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS: Set Account</title>
        <link rel="stylesheet" href="../Styles/general-style.css">
        <link rel="stylesheet" href="../Styles/form-style.css">
        <link rel="stylesheet" href="../Animations/animation.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    </head>
    <body>
        <main>
            <div class="form animate--fadeIn delay-3">
                <section class="middlesection">
                    
                    <div class="messageContainer">
                        <div class="imgContainer">
                            <img src="" alt="Picture" class="joinedAssociationpfp">
                            <h2>COMS</h2>
                        </div>               
                        <p>Let's Set Up Your Account</p>
                        <p class="hint">Enter your Name / Gender</p>
                    </div>

                    <div class="inputContainer">
                        <p>First name <span class="required">*</span> <span class="Errormessage Emsg1"></span></p>
                        <input id="user-firstname" type="text" class="normalInput" placeholder="Given Name" required pattern="[A-Za-z\s]+">
                        <p>Last name <span class="required">*</span> <span class="Errormessage Emsg2"></span></p>
                        <input id="user-lastname" type="text" class="normalInput" placeholder="Surname" required pattern="[A-Za-z\s]+">

                        <p>Gender <span class="required">*</span> <span class="Errormessage Emsg3"></span></p>
                        <select  id="gender" required>
                            <option value="" disabled selected>-Select-</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                   
                </section>
                
                <section class="bottomsection">
                    <div class="buttonContainer">
                        <button class="submit-name  animate--fadeIn delay-1">Next</button>
                    </div>
                </section>

            </div>
        </main>
        <script type="module" src="../Scripts/setupData/fullname.js"></script>
    </body>
</html>