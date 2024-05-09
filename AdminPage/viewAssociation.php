<?php
    include ("../LandingPage/Functions/SessionManagement.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS :Association</title>
        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/general-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/header-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/viewAssociation.css">
  
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
                        <a href="?action=logout"><button id="LogoutButton">Logout</button></a>
                    </section>
                </div>
    
                <div class="settings">
                    <img src="../Images/Icons/icons8-settings-25.png" alt="">
                    <div>Settings</div>
                </div>
            </nav>

        </header>  

        <!-- view user -->
        <div class="upperlayer" id="viewUser">
            <form>
                <div class="formheader"><div id="xbuttonView">&#10005;</div></div>
                <img src="../Images/Noimg.jpg" alt="" id=viewProfileImg>
                
                <div class="infos">
                    <p id="selectedName">[Sample Name]</p>
                    <p id="selectedPosition">[Sample Position]</p>
                    <p id="selectedEmail">[Sample Email]</p>
                    <button type="reset" id="back">Back</button>
                </div>
            </form>
        </div>

        <main>
            <!-- Top Section -->
            <section class="topSection">
                <div id="backbuttonView">&#8634; Back</div>
            </section>

            <!-- Top Section Header -->
            <section class="AssociationHeader">
                <div class="info">
                    <div class="logoContainer">
                        <img src="../Images/Noimg.jpg" alt="" id="associationLogo">
                    </div>
                    <div class="text">
                        <h3 id="associationName">[Association Name]</h3>
                        <p id="associationType">[Association Type]</p>      
                    </div>
                    <div class="divbuttonContainer">
                        <button id="editAssociation">Edit</button>
                    </div>
                </div>
                
                <div id="navigations">
                    <nav id="HomePage" class="selectedNav">Home</nav>
                    <nav id="MembersPage" class="">Members</nav>
                </div>

            </section>

            <!-- Middle Section List-->
            <section id="list">
                <div class="memberContainer">
                    <h5 class="memberHeader">Adviser</h5>
                    <div id="adviser">none</div>
                </div>

                <div class="memberContainer">
                    <h5 class="memberHeader">President</h5>
                    <div id="president">none</div>
                </div>

                <div class="memberContainer">
                    <h5 class="memberHeader">Vice President</h5>
                    <div id="vice_president">none</div>
                </div>

                <div class="memberContainer">
                    <h5 class="memberHeader">Secretary</h5>
                    <div id="secretary">none</div>
                </div>

                <div class="memberContainer">
                    <h5 class="memberHeader">Auditor</h5>
                    <div id="auditor">none</div>
                </div>

                <div class="memberContainer">
                    <h5 class="memberHeader">Treasurer</h5>
                    <div id="treasurer">none</div>
                </div>

                <div class="memberContainer">
                    <h5 class="memberHeader">Head Officer</h5>
                    <div id="head_officer">none</div>
                </div>

                <div class="memberContainer">
                    <h5 class="memberHeader">Officer</h5>
                    <div id="Officers">none</div>
                </div>
            </section>

            <section id="home">
                <div class="postContainer">
                    <div class="postHeader">About</div>
                    <div id="home_about">None</div>
                </div>

                <div class="postContainer">
                    <div class="postHeader">Mission</div>
                    <div id="home_mission">None</div>
                </div>
                
                <div class="postContainer">
                    <div class="postHeader">Vision</div>
                    <div id="home_vision">None</div>
                </div>

            </section>
            
            <form id="editHome">
                <div class="postContainerEdit">
                    <div class="postHeader">About</div>
                    <textarea id="edit_about"></textarea>
                </div>

                <div class="postContainerEdit">
                    <div class="postHeader">Mission</div>
                    <textarea id="edit_mission"></textarea>
                </div>
                
                <div class="postContainerEdit">
                    <div class="postHeader">Vision</div>
                    <textarea id="edit_vision"></textarea>
                </div>

                <button id="submitChanges" type="submit">Save Changes</button>
                <button id="cancelChanges" type="reset">Cancel</button>
            </form>
        </main>

        <script src="./Scripts/viewAssociation.js"></script>
        <script src="./Scripts/util/navigation.js"></script>
    </body>
</html>