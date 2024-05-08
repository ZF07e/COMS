<?php
    include ("../LandingPage/Functions/SessionManagement.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS: User Management</title>

        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/header-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/general-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/userManagement.css">
        
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
                
                <div class="associations ">
                    <img src="../Images/Icons/icons8-hierarchy-25.png">
                    <div>Associations</div>
                </div>
                
                <div class="user_management selected">
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
                </div>
    
                <div class="settings">
                    <img src="../Images/Icons/icons8-settings-25.png" alt="">
                    <div>Settings</div>
                </div>
            </nav>
        </header>

        <main>
            <div class="pageTitle">User Management</div>
            <div class="main-header">
                <div class="searchbar">
                    <input type="text" name="" id="searchUser">
                    <img src="../Images/Icons/icons8-search-25.png" alt="search" class="searchButton">
                </div>
                
                <button id="associationButton">+ Add User</button>
            </div>

            <section class="userList">
            <!-- Render Here -->
            </section>
        </main>

        <!-- Form 1 For Inserting -->
        <form id="pop-upFormUser">  
            <div class="form-header">
                <h3>Add User</h3>
                <button type="reset" id="User_x_button">X</button>
            </div>

            <div class="form-body">
                <input type="text" class="normalInput" placeholder="First Name">
                <input type="text" class="normalInput" placeholder="Last Name">
                <input type="text" class="normalInput" placeholder="Outlook Email">
                <select name="" id="type">
                    <option value="" selected disabled>- Role -</option>
                    <option value="Adviser">Adviser</option>
                    <option value="President">President</option>
                </select>
                <select name="" id="handlingAssociation">
                    <option value="" selected disabled>- Association -</option>
                </select>
            </div>

            <div class="form-footer">
                <button type="submit">Add</button>
                <button type="reset" id="User_cancel_Button">Cancel</button>
            </div>
        </form>


        <!-- Form 2 For Editing -->
        <form id="pop-upUserEdit">  
            <div class="form-header">
                <h3>Edit User</h3>
                <button type="reset" id="UserEdit_x_button">&#10005;</button>
            </div>

            <div class="form-body">
                <input type="text" class="normalInput" placeholder="First Name" id="User_FirstName">
                <input type="text" class="normalInput" placeholder="Last Name" id="User_LastName">
                <input type="text" class="normalInput" placeholder="Outlook Email" id="User_Email">
                <select name="" id="type" class="roles">
                    <option value="" selected disabled>- Role -</option>
                    <option value="Adviser">Adviser</option>
                    <option value="President">President</option>
                </select>
                <select name="" id="EdithandlingAssociation">
                    <option value="" selected disabled>- Association -</option>
                </select>
            </div>

            <div class="form-footer">
                <button type="submit">Save</button>
                <button type="reset" id="cancel_Edit">Cancel</button>
                <button id="remove_button">Remove</button>
            </div>
        </form>

        <script src="./Scripts/userList.js"></script>
        <script src="./Scripts/util/navigation.js"></script>
    </body>
</html>