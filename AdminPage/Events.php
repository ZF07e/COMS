<?php
    include ("../LandingPage/Functions/SessionManagement.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="./Styles/mainStyle/general-style.css">
        <link rel="stylesheet" href="./Styles/mainStyle/header-style.css">
        <link rel="stylesheet" href="./Styles/events-style.css">
        <title>COMS: Events</title>
        <script src="../FullCalendarIO/index.global.min.js"></script>
    </head>
    <body>  
        <section class="pageTitle">
                Events
            </section>
        <div id="popUpCreateEvent">
            <form id="addEvent">
                <div id="popUpHeader">Add Event <div id="xButtonPopUp">&#10005;</div></div>
                    <div id="popUpBody">
                        <section id="eventNameContainer">
                            <label for="nm_time">Event Name</label> 
                            <input type="text" id="eventName" placeholder="Event Name" class="normalInput">
                        </section>

                        <section id="timeDate">
                            <div class="dateTimeContainer" name="setDate">
                                <label for="nm_date1">From (Date)</label>
                                <input type="date" id="start_eventDate" name="nm_date1" class="normalInput">
                            </div>

                            <div class="dateTimeContainer" >
                                <label for="nm_date2">To (Date)</label>
                                <input type="date" id="end_eventDate" name="nm_date2" class="normalInput">
                            </div>   
                        </section>

                        <div id="popUpButtons">
                            <button id="submitEvent" type="submit">Add</button>
                            <button id="cancelAddEvent" type="reset">Cancel</button>
                        </div>
                    </div>
            </form>
        </div>

        <div id="popUpCreateEvent2">
            <form id="editEvent">
                <div id="popUpHeader">Edit Event <div id="xButtonEditPopUp">&#10005;</div></div>
                    <div id="popUpBody">
                        <section id="eventNameContainer">
                            <label for="nm_time">Event Name</label> 
                            <input type="text" id="edit_eventName" placeholder="Event Name" class="normalInput">
                        </section>

                        <section id="timeDate">
                            <div class="dateTimeContainer" name="setDate">
                                <label for="nm_date1">From (Date)</label>
                                <input type="date" id="edit_startEvent" name="nm_date1" class="normalInput">
                            </div>

                            <div class="dateTimeContainer" >
                                <label for="nm_date2">To (Date)</label>
                                <input type="date" id="edit_endEvent" name="nm_date2" class="normalInput">
                            </div>    
                        </section>

                        <div id="popUpButtons">
                            <button id="saveEditEvent" type="submit">Save</button>
                            <button id="cancelEditEvent" type="reset">Cancel</button>
                            <button id="removeEditEvent" type="reset">Remove</button>
                        </div>
                    </div>
            </form>
        </div>

        <header>
            <nav>
                <div class="system-logo">
                    <div class="title"><span>CO</span>MS<span>.</span></div>
                </div>
    
                <div class="home ">
                    <img src="../Images/Icons/icons8-home-25.png">
                    <div>Home</div>
                </div>
    
                <div class="events selected">
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

        <main>  
            <section id="middleSection">
                <!--Calendar-->
                <div id="calendar"></div> 
            </section>
        </main>


        <script src="./Scripts/util/calendarScript.js"></script>
        <script src="./Scripts/util/navigation.js"></script>
    </body>
</html>