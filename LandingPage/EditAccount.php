<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS: Edit Account</title>
        <link rel="stylesheet" href="Styles/header-style.css">
        <link rel="stylesheet" href="Styles/general-style.css">
        <link rel="stylesheet" href="Styles/edit-account-style.css">
        <link rel="icon" href="/Images/WebLogo/CO (1).png" type="images/icon type">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    </head>
    <body>
        <header><!--Header-->
            <nav class="leftPanel">
                <a href="Index.php"><h2 class="Logo"><span>CO</span>MS<span>.</span></h2></a>
                <a href="Index.php"><div>Home</div></a>
                <a href="Associations.php"><div>Associations</div></a>
            </nav>
        </header><!--Header END-->
   
        <main>
            <section class="registrationContainer">
                <form>
                    <div class="formHeader">
                        <img src="" alt="Club Profile">
                        <h4><span>[Club Name]</span> Registration</h4>
                    </div>
                    <div class="studentInformation">
                        <div class="studentInformationBorder">
                            <p>Student Information</p>
                        </div>
                        <div class="studentId">
                            <input type="text" placeholder="Student Number">
                        </div>
                        <div class="nameContainer">
                            <input type="text" placeholder="First Name">
                            <input type="text" placeholder="Middle Name">
                            <input type="text" placeholder="Last Name">
                        </div>
                        <div class="extraInfo">
                            <input type="text" placeholder="Gender">
                            <input type="text" placeholder="Course/Strand">
                        </div>
                    </div>

                    <div class="contactDetails">
                        <div class="contactDetailsBorder">
                            <p>Contact Details</p>
                        </div>
                        <div class="contactsContainer">
                            <input type="text" placeholder="Phone Number">
                            <input type="email" placeholder="Outlook Email">
                        </div>
                        <div class="location1Container">
                            <input type="text" placeholder="Subdivision/Village/Building">
                            <input type="text" placeholder="Barangay">
                        </div>
                        <div class="location2Container">
                            <input type="text" placeholder="City/Municipality">
                            <input type="text" placeholder="Province">
                        </div>
                    </div>
                    <div class="fileAndSubmit">
                        <label for="selectFile">
                            <input id="selectFile" type="file">
                        </label>
                        
                        <button type="submit">Send Application</button>
                    </div>            
                </form>
            </section>

            <section class="associationsMissionVision">   
                <!-- Render Here -->
            </section>

            <script type="module" src="Scripts/Register.js"></script>
        </main>
    </body>
</html>