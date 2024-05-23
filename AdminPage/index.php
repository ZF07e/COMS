<?php
    include ("../LandingPage/Functions/SessionManagement.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS: ADMIN</title>
        <link rel="icon" href="../Images/WebLogo/CO (1).png" type="images/icon type">
        
        
        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/header-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/general-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/mainStyle/calendar-style.css">
        <link rel="stylesheet" href="../AdminPage/Styles/home-main-style.css">
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

        <main>
            <section class="pageTitle">
                Dashboard

                <button id="logoutHeader"><img src="../Images/Icons/icons8-bell-24.png"></button>
            </section>
            
            <div id="CenterDivContainer">

                <section id="Account_Con">
                    <h3>Account</h3>
                    <div id="accountProfileHome">
                        <img src="../Images/Noimg.jpg"  id="accountProfileHome">
                        <h3 id="UserNameHome">[Username]</h3>
                        <h5 id="PositionHome">[Position]</h5>
                    </div>
                </section>

                <section id="DateNTotalEvents_Con"> 
                    <div id="topDate">
                        <p id="gotoButton">&#8249; Goto</p>
                    </div>
                    <h3 id="todayTitle">Today</h3> 
                    <div id="datesRow">
                        <div id="not_Today_Con">
                            <p id="day">Tue</p>
                            <p id="date">22</p>  
                        </div>

                        <div id="Today_Con">
                            <p id="day">Wed</p>
                            <p id="date">22</p>  
                        </div>

                        <div id="not_Today_Con">
                            <p id="day">Thu</p>
                            <p id="date">22</p>  
                        </div>
                    </div>  
                    
                    <div id="eventToday">
                            <div id="bullet"></div>
                            <h1 id="EventTodayTotal">0</h1>
                            <p>Events Today</p>
                    </div>
                </section>

                <section id="Association_Con">
                    <h3>Associations</h3>
                    <div class="assoc_Con">
                        <div id="orgTotal">
                            <div id="orgPercentage">0</div>
                        </div>

                        <div id="org_detl">
                                <div id="orgColor"></div>
                                <h3>Organization</h3>
                        </div>
                    </div>

                    <div class="assoc_Con">
                        <div id="ClubTotal">
                            <div id="clubPercentage">0</div>
                        </div>
                        
                        <div id="club_detl">
                                <div id="clubColor"></div>
                                <h3>Clubs</h3>
                        </div>
                    </div>
                </section>

                <section id="TotalUsers_Con">
                    <h3>Users</h3>
                    <div id="totalUsersCount">
                        <div id="totalUsers">0</div>
                    </div>
                    <div id="userPer">
                        <div id="adviserPer_Con">
                            <div id="leftsideAd">
                                <div id="bulletAd"></div>
                                <p>Adviser:</p>
                            </div>
                            <p id="adviPer">0%</p>
                        </div>
                        <hr>
                        <div id="studentPer_Con">
                            <div id="leftsideStu">
                                <div id="bulletAd"></div>
                                <p>Student:</p>
                            </div>
                            <p id="studPer">0%</p>
                        </div>
                    </div>
                </section>

                <section id="TotalRequest_Con"> 
                    <div id="gotoRequest_Con">
                        <div id="gotoRequest">
                            <button id="viewReq">View All Requests</button>
                        </div>
                    </div>

                    <div id="allTotalReq_Con">
                        <div id="inbox_Con">
                            <div id="rightSection_Con">
                                <div id="bullet"></div>
                                <p>Inbox:</p>
                            </div>
                            <p id="totalInbox">0</p>
                        </div>
                        <hr>

                        <div id="unread_Con">
                            <div id="rightSection_Con">
                                <div id="bullet"></div>
                                <p>Unread:</p>
                            </div>
                            <p id="totalUnread">0</p>
                        </div>
                        <hr>

                        <div id="approved_Con">
                            <div id="rightSection_Con">
                                <div id="bullet"></div>
                                <p>Approved:</p>
                            </div>
                            <p id="totalApproved">0</p>
                        </div>
                        <hr>

                        <div id="rejected_Con">
                            <div id="rightSection_Con">
                                <div id="bullet"></div>
                                <p>Rejected:</p>
                            </div>
                            <p id="totalRejected">0</p>
                        </div>
                        
                        
                    </div>
            
                </section>

            </div>  


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