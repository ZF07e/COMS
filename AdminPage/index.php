<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS: ADMIN</title>
        <link rel="icon" href="../Images/WebLogo/CO (1).png" type="images/icon type">
        <link rel="stylesheet" href="../AdminPage/Styles/home-main-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/header-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/general-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/calendar-style.css">

        
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

        <main>
            <section class="top-main-section">
                WELCOME ADMIN
            </section>

            <!-- <section class="main-center-section" (RESERVED!)>
                <div class="upcoming-events"> 
                 <div class="calendar">
                    <div class="cal-header">
                        <button class="prevBtn">
                            <div><</div>
                        </button>
                        <div class="monthYear"></div>
                        <button class="nextBtn">></button>
                    </div>
                    <div class="days">
                        <div class="day">Mon</div>
                        <div class="day">Tue</div>
                        <div class="day">Wed</div>
                        <div class="day">Thu</div>
                        <div class="day">Fri</div>
                        <div class="day">Sat</div>
                        <div class="day">Sun</div>
                    </div>
                    <div class="dates"></div>
                 </div>
                </div>      
            </section> -->
            
        </main>
        <!-- <script src="../AdminPage/Scripts/vanila-calendar.js"></script> (RESERVED!)-->
        <script src="./Scripts/util/navigation.js"></script>
    </body>
</html>