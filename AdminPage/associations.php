<?php
    include ("../LandingPage/Functions/SessionManagement.php");   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS: Associations List</title>

        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/general-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/header-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/association-main-style.css">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav>
                <div class="system-logo">
                    <div class="logo">
                        <span><div></div></span>
                        <span><div></div></span>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="title"><span>CO</span>MS<span>.</span></div>
                </div>

                <div class="home">
                    <img src="../Images/Icons/icons8-home-25.png">
                    <div>Home</div>
                </div>

                <div class="events">
                    <img src="../Images/Icons/icons8-calendar-25.png">
                    <div>Events</div>
                </div>
    
                <div class="associations selected">
                    <img src="../Images/Icons/icons8-hierarchy-25.png">
                    <div>Associations</div>
                </div>

                <div class="user_management">
                    <img src="../Images/Icons/icons8-management-25.png">
                    <div>User Management</div>
                </div>

                <div class="request">
                    <img src="../Images/Icons/icons8-request-feedback-25.png">
                    <div>Request</div>
                </div>
            </nav>
            
            <nav>
                <div class="profile">
                    <img src="" alt="Profile">
                    <div>Profile</div>

                    <section class="popUp">
                        <a href="?action=logout"><button id="LogoutButton">Logout</button></a>
                    </section>
                </div>
    
                <div class="settings">
                    <img src="../Images/Icons/icons8-settings-25.png" alt="">
                    <div>Settings</div>
                </div>
            </nav>  

        </header>
        <main>
            <div class="pageTitle">Associations</div>
            <div class="main-header">
                <div class="searchbar">
                    <input type="text" name="" id="searchAssociation">
                    <img src="../Images/Icons/icons8-search-25.png" alt="search" class="searchButton">
                </div>
                
                <button id="associationButton">+ Add Associations</button>
            </div>
            
            <section class="associationList">
            <!-- Render Data Here -->
            </section>
            
        </main>

        <form id="pop-upForm" action = "http://localhost/COMS/AdminPage/Functions/InfromationManagement.php" method = "POST">  
            <div class="form-header">
                <h3>Add Association</h3>
                <button type="reset" id="x_button">&#10005;</button>
            </div>

            <div class="form-body">

                <input type="text" class="normalInput" placeholder="Club/Organization Name" name = "name">
                <select name = "type" id="type">
                    <option value="" selected disabled>- Type -</option>
                    <option value="Club">Club</option>
                    <option value="Organization">Organization</option>
                </select>
    
                <select name="adviser" id="advisers">
                    <option value="">- Advisers -</option>
                </select>

            </div>

            <div class="form-footer">

                <button type="submit" name = "addAssocBTN">Add</button>
                
                <button type="reset" id="cancel_Button">Cancel</button>
            </div>
        </form>
        
        <script type="module" src="./Scripts/associationListAdmin.js"></script>
        <script src="./Scripts/util/navigation.js"></script>
    </body>
</html>