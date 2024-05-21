<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS</title>
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
                
                <div class="tasks">
                    <img src="../Images/Icons/icons8-task-25.png">
                    <div>Tasks</div>
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
            <section id="topHeaderSection">
                <div id="sectionHeader">
                    <h1 id="headerOptions">...</h1>
                </div>
                <div id="sectionBody">
                    <img src="../Images/Noimg.jpg" alt="" id="assocProfile">
                    <div id="nameContainer">
                        <h2 id="assocName">[Name]</h2>
                        <p id="assocType">[Type]</p>
                    </div>
                </div>
            </section>

            <section id="middleBodySection">

                <section id="List">
                    <div id="leftDiv">
                        <section id="MiddleTotalContainer">
                            <div class="dashRecords" id="total1">Members: 0</div>
                            <div class="dashRecords" id="total2">Request: 0</div>
                            <div class="dashRecords" id="total3">Task: 0</div>
                            <div class="dashRecords" id="total4">Events: 0</div>
                        </section>

                        <section id="requestList">
                            <div id="requestHeader">Request</div>
                            <div id="requestBody">
                                
                                <div class="reqItem">
                                    <div> <img src="../Images/Icons/icons8-document-20.png" alt=""> <p id="reqItemSender">Lorem Ipsum(Username)</p></div>
                                    <p id="reqItemSubject">Request Lorem Ipsum</p>
                                    <p id="reqItemDate">[Month] [day]</p>
                                </div>     
                                
                                <div class="reqItem">
                                    <div> <img src="../Images/Icons/icons8-document-20.png" alt=""> <p id="reqItemSender">Lorem Ipsum(Username)</p></div>
                                    <p id="reqItemSubject">Request Lorem Ipsum</p>
                                    <p id="reqItemDate">[Month] [day]</p>
                                </div>     
                            </div> 
                        </section>
                    </div>
                    
                    <div id="rightDiv">
                        <section id="upcomingEvents">
                            <div id="upcomingEventsHeader">Upcoming Events</div>
                            <div id="upcomingEventsBody">
                                <div class="eventItem">
                                    <p id="eventTitle">[Lorem Ipsum]</p>
                                    <p id="eventDate">[Month] [Day]</p>
                                </div>
                            </div>
                        </section>
                    </div>     
                </section>
            </section>
        </main>

        <script src="./Scripts/utils/navigation.js"></script>
    </body>
</html>