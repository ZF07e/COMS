<?php
    include ("../LandingPage/Functions/SessionManagement.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS</title>

        <!-- jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <link rel="stylesheet" href="./Styles/mainStyle/general-style.css">
        <link rel="stylesheet" href="./Styles/mainStyle/header-style.css">
        <link rel="stylesheet" href="./Styles/index-style.css">
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
                
                <div class="associations selected">
                    <img src="../Images/Icons/icons8-bulletin-board-25.png">
                    <div>Association</div>
                </div>

                <div class="events">
                    <img src="../Images/Icons/icons8-calendar-25.png">
                    <div>Calendar</div>
                </div>
                
                <div class="user_management">
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

        <main>
            <section id="topHeaderSection">
                <div id="sectionHeader">
                    <div id="headerOptions">
                        ...
                        <div id="EditOptions">
                            <div id="edtMissionVision">Edit Info</div>
                        </div>
                    </div>
                </div>
                <div id="sectionBody">
                    <img src="../Images/Noimg.jpg" alt="" id="assocProfile">
                    <div id="nameContainer">
                        <h2 id="assocName"></h2>
                        <p id="assocType"></p>
                    </div>
                </div>
            </section>

            <section id="middleBodySection">

                <form id="List" action = "http://localhost/COMS/AssocClient/Functions/Querries/InfromationManagement.php" method = "POST">
                    <div id="midDiv">
                        <section id="MiddleTotalContainer">
                            <div class="dashRecords" id="total1"></div>
                            <div class="dashRecords" id="total2"></div>
                            <div class="dashRecords" id="total3"></div>
                        </section>

                        <section id="MissionVisionSection">
                            <div id="aboutDiv">
                                <h2>About</h2>
                                <p id="dashboardAbout"></p>
                                <textarea id="edit_about" name = "description"></textarea>
                            </div>

                            <div id="missionDiv">
                                <h2>Mission</h2>
                                <p id="dashboardMission"></p>
                                <textarea id="edit_mission" name = "mission"></textarea>
                            </div>

                            <div id="visionDiv">
                                <h2>Vision</h2>
                                <p id="dashboardVision"></p>
                                <textarea id="edit_vision" name = "vision"></textarea>
                                <input type="hidden" id = "kuninAssocName" name = "getAssocName" value = "">
                            </div>
                        </section>
                    </div>

                    <div id="optionResult">
                        <button type="submit" id="saveInfoChanges" name="assocChangeBTN">Save Changes</button>
                        <button type="reset" id="resetInfoChanges">Cancel</button>
                    </div>
                </form>

            </section>
        </main>
        <script src="./Scripts/utils/navigation.js"></script>
        <script src="./Scripts/indexScript.js"></script>
    </body>
</html>