<?php
    include ("../LandingPage/Functions/SessionManagement.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS :Association</title>

        <!-- jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- alertify JavaScript -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

        <!-- Alertify CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>

        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/general-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/header-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/viewAssociation.css">
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
    
                <div class="home ">
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
            
            <nav id="profileNav">
                <hr>
                <div class="profile">
                    <img src="../Images/COMS.png" alt="">
                    <div>Admin</div>

                    <section class="popUp">
                        <button id="ProfileButton">Profile</button>
                        <a href="?action=logout"><button id="LogoutButton">Logout</button></a>        
                    </section>
                </div>  
            </nav>

        </header>  

        <div class="PopUpCon_" id="deleteClub">
            <form action="" class="_PopUpForm" id="deleteAssociation">
                <div class="_PopUpTop">
                    <h3 class="_PopUpType">Alert</h3>
                    <p class="_PopUpExit" id="X_exit">&#10005;</p>
                </div>  
                <p>You're About To Deactivate This Club/Organization?</p>
                <div class="_PopUpOptionsCon">
                    <button type="submit" class="_AcceptOption" id="Y_Option">Yes</button>
                    <button type="reset" class="_NoOption" id="N_Option">No</button>
                </div>
            </form>
        </div>

        <div class="PopUpCon_" id="Activate">
            <form action="" class="_PopUpForm" id="ActivateAssociation">
                <div class="_PopUpTop">
                    <h3 class="_PopUpType">Alert</h3>
                    <p class="_PopUpExit" id="X_exitActive">&#10005;</p>
                </div>  
                <p>Activate This Club/Organization?</p>
                <div class="_PopUpOptionsCon">
                    <button type="submit" class="_AcceptOption" id="Y_OptionActive">Yes</button>
                    <button type="reset" class="_NoOption" id="N_OptionActive">No</button>
                </div>
            </form>
        </div>

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
                        <h3 id="associationName" name = "assocName"></h3>
                        <p id="associationType"></p>      
                    </div>
                    <div class="divbuttonContainer">
                        <button id="activateAssoc">Activate</button>
                        <button id="removeAssoc">Deactivate</button>
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
                    <div id="home_about"></div>
                </div>

                <div class="postContainer">
                    <div class="postHeader">Mission</div>
                    <div id="home_mission"></div>
                </div>
                
                <div class="postContainer">
                    <div class="postHeader">Vision</div>
                    <div id="home_vision"></div>
                </div>

            </section>
            
            <form id="editHome" action = "http://localhost/COMS/AdminPage/Functions/InfromationManagement.php" method = "POST">
                <div class="postContainerEdit">
                    <div class="postHeader">About</div>
                    <textarea id="edit_about" name = "description"></textarea>
                </div>

                <div class="postContainerEdit">
                    <div class="postHeader">Mission</div>
                    <textarea id="edit_mission" name = "mission"></textarea>
                </div>
                
                <div class="postContainerEdit">
                    <div class="postHeader">Vision</div>
                    <textarea id="edit_vision" name = "vision"></textarea>
                    <input type="hidden" id = "kuninAssocName" name = "getAssocName" value = "">
                </div>
                <button id="submitChanges" type="submit" name = "assocChangeBTN">Save Changes</button>
                <button id="cancelChanges" type="reset">Cancel</button>
            </form>
        </main>

        <script src="./Scripts/viewAssociation.js"></script>
        <script src="./Scripts/util/navigation.js"></script>
    </body>
</html>