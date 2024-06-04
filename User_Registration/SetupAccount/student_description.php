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
                        <p class="hint">Tell us more about yourself.</p>
                        <p class="hint2">4/5</p>
                    </div>

                    <div class="inputContainer">
                        <p>Course/Strand<span class="required">*</span> <span class="Errormessage Emsg1"></span></p>
                        <input id="courseStrand" type="text" class="normalInput" placeholder="Full course/strand name" required pattern="[A-Za-z\s]+">
                        <p>Description<span class="required">*</span> <span class="Errormessage Emsg2"></span></p>
                        <!-- <input > -->
                        <Textarea id="desc" type="text" class="normalInput normalTextArea" placeholder="eg. Skills, Expertise." required pattern="[A-Za-z\s]+"></Textarea>

                        <!-- <p>Gender <span class="required">*</span> <span class="Errormessage Emsg3"></span></p>
                        <select  id="gender" required>
                            <option value="" disabled selected>-Select-</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select> -->
                    </div>
                   
                </section>
                
                <section class="bottomsection">
                    <div class="buttonContainer">
                        <button class="submit-desc  animate--fadeIn delay-1">Next</button>
                    </div>
                </section>

            </div>
        </main>
        <script type="module" src="../Scripts/setupData/description.js"></script>
    </body>
</html>