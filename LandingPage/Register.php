    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS: Register</title>

        <link rel="stylesheet" href="Styles/header-style.css">
        <link rel="stylesheet" href="Styles/general-style.css">
        <link rel="stylesheet" href="Styles/register-style.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <header><!--Header-->
            <nav class="leftPanel">
                <a href="Index.php"><h2 class="Logo"><span>CO</span>MS<span>.</span></h2></a>
                <a href="Index.php"><div>Home</div></a>
                <a class="selected" href="Associations.php"><div>Associations</div></a>
            </nav> 
            
        </header><!--Header END-->

        <!-- <main>     ---BEFORE
            <section class="registrationContainer">
                <section class="left-section">
                    <div class="imageContainer"></div>
                    <div class="association-info">
                        <h2 class="associationTitle">[Associtaion Title]</h2>
                        <p class="adviser">[Adviser]</p>
                        <p class="description">[Description]: Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci, dolore temporibus enim saepe dolor veniam 
                                                    laborum quo reprehenderit quae eaque illum nemo eveniet tenetur quibusdam ipsum odit non a quis.</p>
                    </div>  
                </section>

                <form action = "Functions/Application.php" method = "POST">  ---BEFORE
                    <div class="labelconatainer">
                        <div>
                            <h2>Apply</h2>
                        </div>               
                        <p>How can we contact you?</p>
                    </div>
                    <input type="email" placeholder="Outlook Email" name = "outlook">
                    <input type="text" placeholder="Facebook Link" name = "facebook">
                    <input type = "hidden" id = "association" name = "association">
                    <button type="submit" class="submitbutton">Submit</button>
                </form>

                
            </section>

            <section class="bottomSection">

                <section class="mission">
                    <h3>• Mission •</h3>
                    <h5 class="AscMission"></h5>
                </section>

                <section class="vision">
                    <h3>• Vision •</h3>
                    <h5 class="AscVision"></h5>
                </section>

            </section>                                                              
        </main> -->

        <main>  <!--    ---After -->
            <img src="" id="assocLogo" alt="">

            <h2 id="assocTitle">Association Title</h2>

            <p id="assocAdviser">Association Adviser</p>
            <button id="registerButton">Register</button>

            <h3 id="assocDescTitle">About Us</h3>
            <p id="assocDesc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et, fuga ex? Cumque quos molestiae, eaque veritatis velit natus ullam sunt labore mollitia necessitatibus quasi earum, praesentium maxime a perferendis officia!</p>

            <h3 id="assocMissionTitle">Mission</h3>
            <p id="assocMission">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam accusantium illum a dolores ab voluptate esse rerum in. Modi iure placeat iusto quia! Unde dolor et quod, accusamus ut quis.</p>

            <h3 id="assocVisionTitle">Vision</h3>
            <p id="assocVision">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam accusantium illum a dolores ab voluptate esse rerum in. Modi iure placeat iusto quia! Unde dolor et quod, accusamus ut quis.</p>

        </main>


        <script type="module" src="Scripts/Register.js"></script>
    </body>
</html>