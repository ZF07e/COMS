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
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <main>
            <div class="form animate--fadeIn delay-3">
                <section class="middlesection">
                    
                    <div class="messageContainer">
                        <div class="imgContainer">
                            <img src="../../Images/COMS.png" alt="Picture" class="joinedAssociationpfp">
                            <h2>COMS</h2>
                        </div>               
                        <p class="formTag">Let's Set Up Your Account</p>
                        <p class="hint">Enter your Student Information</p>
                        <p class="hint2">3/4</p>
                    </div>

                    <div class="inputContainer">
                        <p>Outlook Email. <span class="required">*</span> <span class="Errormessage Emsg1"></span></p>
                        <input id="email" class="normalInput" type="text" placeholder="me.******@alabang.sti.edu.ph" required>

                        <!-- <p>Education Level <span class="required">*</span> <span class="Errormessage Emsg2"></span></p>
                        <select name="" id="educlvl" required>
                            <option value="" disabled selected>-Select-</option>
                            <option value="College">College</option>
                            <option value="Senior High">Senior High</option>
                        </select> -->

                        <p>Mobile Phone No. <span class="required">*</span> <span class="Errormessage Emsg3"></span></p>
                        <input id="mobileNo" class="normalInput" type="tel" placeholder="+(63)" maxlength="11" required>
                    </div>
                   
                </section>
                
                <section class="bottomsection">
                    <div class="buttonContainer">
                        <button class="submit-studInfo  animate--fadeIn delay-1">Next</button>
                    </div>
                </section>

            </div>
        </main>
        <script type="module" src="../Scripts/setupData/contact.js"></script>
    </body>
</html>