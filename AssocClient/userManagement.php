<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS: User Management</title>

        <link rel="stylesheet" href="./Styles/mainStyle/general-style.css">
        <link rel="stylesheet" href="./Styles/mainStyle/header-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/userManagement.css">
        
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
                
                <div class="associations">
                    <img src="../Images/Icons/icons8-bulletin-board-25.png">
                    <div>Association</div>
                </div>

                <div class="events">
                    <img src="../Images/Icons/icons8-calendar-25.png">
                    <div>Calendar</div>
                </div>

                <div class="user_management selected">
                    <img src="../Images/Icons/icons8-group-25.png">
                    <div>Members</div>
                </div>
    
                <div class="request">
                    <img src="../Images/Icons/icons8-request-feedback-25.png">
                    <div>Request</div>
                </div>
            </nav>
            
            <nav id="profileNav">
                <hr>
                <div class="profile">
                    <img src="" alt="">
                    <div>Profile</div>

                    <section class="popUp">
                        <button id="ProfileButton">Profile</button>
                        <a href="?action=logout"><button id="LogoutButton">Logout</button></a>        
                    </section>
                </div>  
            </nav>

        </header>   

    <!-- confirmation -->
        <div class="upperlayer2">
            <form id="confirmation" action = "http://localhost/COMS/AdminPage/Functions/InfromationManagement.php" method = "POST">
                <div class="confHeader">
                    <h3>Warning!</h3>
                    <button id="xbuttonConf">&#10005;</button>
                </div>
                <p>You're about to delete this account are you sure?</p>
                <input type="hidden" id = "name" name = "name" value = "">
                <input type="hidden" id = "position" name = "position" value = "">
                <input type="hidden" id = "email" name = "email" value = "">
                <div class="options">
                    <button type="submit" id="yesbtn" name = "removeUser" onClick = "getValueFromForm()">Yes</button>
                    <button type="button" id="nobtn">No</button>
                </div>
                <script>
                    function getValueFromForm() {
                        var name = document.getElementById('selectedName').innerText;
                        var position = document.getElementById('selectedPosition').innerText;
                        var email = document.getElementById('selectedEmail').innerText;

                        document.getElementById('name').value = name;
                        document.getElementById('position').value = position;
                        document.getElementById('email').value = email;
                    }
                </script>
            </form>
        </div>

        <!-- view user -->
        <div class="upperlayer" id="viewUser">
            <form action = "http://localhost/COMS/AdminPage/Functions/InfromationManagement.php" method = "POST">
                <div class="formheader"><div id="xbuttonView">&#10005;</div></div>
                <img src="../Images/Noimg.jpg" alt="" id=viewProfileImg>
                <div class="edit_infos">
                    <input type="text" class="normalInput" placeholder="First Name" id="User_FirstName" name = "newFirstName">
                    <input type="text" class="normalInput" placeholder="Last Name" id="User_LastName" name = "newLastName">
                    <select name="newPosition" id="EditselectedPosition">
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
                    <input type="text" class="normalInput" placeholder="Outlook Email" id="User_Email" name = "newEmail">
                    <select name="newAffiliation" id="EdithandlingAssociation">
                        <option value="" selected disabled>- Association -</option>
                    </select>
                    <input type="hidden" id="ID" name="userID">
                    <button type="submit" id="saveChanges" name = "saveBTN">SaveChanges</button>
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
        <form id="pop-upFormUser" action = "http://localhost/COMS/AdminPage/Functions/InfromationManagement.php" method = "POST">  
            <div class="form-header">
                <h3>Add User</h3>
                <button type="reset" id="User_x_button">X</button>
            </div>

            <div class="form-body">
                <input type="text" class="normalInput" placeholder="First Name" name = "firstName">
                <input type="text" class="normalInput" placeholder="Last Name" name = "lastName">
                <input type="text" class="normalInput" placeholder="Outlook Email" name = "email">
                <select name="position" id="type">
                    <option value="" selected disabled>- Role -</option>
                    <option value="Adviser">Adviser</option>
                    <option value="President">President</option>
                </select>
                <select name="" id="handlingAssociation">
                    <option value="" selected disabled>- Association -</option>
                </select>
            </div>

            <div class="form-footer">
                <button type="submit" name = "addBTN">Add</button>
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
        <script src="./Scripts/utils/navigation.js"></script>
    </body>
</html>