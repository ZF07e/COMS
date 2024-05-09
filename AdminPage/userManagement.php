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
    
                <div class="home selected">
                    <img src="../Images/Icons/icons8-home-25.png">
                    <div>Home</div>
                </div>
    
                <div class="events">
                    <img src="../Images/Icons/icons8-calendar-25.png">
                    <div>Events</div>
                </div>
                
                <div class="associations">
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
                        <button id="LogoutButton">Logout</button>
                    </section>
                </div>
    
                <div class="settings">
                    <img src="../Images/Icons/icons8-settings-25.png" alt="">
                    <div>Settings</div>
                </div>
            </nav>

        </header>  


    <!-- confirmation -->
        <div class="upperlayer2">
            <form action="" id="confirmation">
                <div class="confHeader">
                    <h3>Warning!</h3>
                    <button id="xbuttonConf">&#10005;</button>
                </div>
                <p>You're about to delete this account are you sure?</p>
                <div class="options">
                    <button type="submit" id="yesbtn">Yes</button>
                    <button type="button" id="nobtn">No</button>
                </div>
            </form>
        </div>

        <!-- view user -->
        <div class="upperlayer" id="viewUser">
            <form>
                <div class="formheader"><div id="xbuttonView">&#10005;</div></div>
                <img src="../Images/Noimg.jpg" alt="" id=viewProfileImg>
                <div class="edit_infos">
                    <input type="text" class="normalInput" placeholder="First Name" id="User_FirstName">
                    <input type="text" class="normalInput" placeholder="Last Name" id="User_LastName">
                    <select name="" id="EditselectedPosition">
                        <option value="" selected disabled>- Position -</option>
                        <option value="Adviser">Adviser</option>
                        <option value="President">President</option>
                        <option value="Vice President">Vice President</option>
                        <option value="Secretary">Secretary</option>
                        <option value="Auditor">Auditor</option>
                        <option value="Treasurer">Treasurer</option>
                        <option value="Head Officer">Head Officer</option>
                        <option value="Officer">Officer</option>
                    </select>
                    <input type="text" class="normalInput" placeholder="Outlook Email" id="User_Email">
                    <select name="" id="EdithandlingAssociation">
                        <option value="" selected disabled>- Association -</option>
                    </select>
                        
                    <button type="submit" id="saveChanges">SaveChanges</button>
                    <button type="reset" id="cancelEdit">Cancel</button>
                </div>
                
                <div class="infos">
                    <p id="selectedName">[Sample Name]</p>
                    <p id="selectedPosition">[Sample Position]</p>
                    <p id="selectedEmail">[Sample Email]</p>

                    <button type="button" id="editInfo">Edit</button>
                    <button type="button" id="removeUser">Remove User</button>
                    <button type="reset" id="back">Back</button>
                </div>
            </form>
        </div>

        
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

        <script src="./Scripts/userList.js"></script>
        <script src="./Scripts/util/navigation.js"></script>
    </body>
</html>