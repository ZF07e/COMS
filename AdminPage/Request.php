<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS: Request</title>

        <!-- jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <link rel="stylesheet" href="./Styles/mainStyle/general-style.css">
        <link rel="stylesheet" href="./Styles/mainStyle/header-style.css">
        <link rel="stylesheet" href="./Styles/request-style.css">
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
            
            <div class="tasks">
                <img src="../Images/Icons/icons8-task-25.png">
                <div>Tasks</div>
            </div>

            <div class="user_management">
                <img src="../Images/Icons/icons8-group-25.png">
                <div>Members</div>
            </div>

            <div class="request selected">
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
        <section class="top-main-section">
            Request
        </section>

        <section id="topSection">
            <div id="inbox" class="selected">Inbox</div>
            <div id="approved" class="">Approved</div>
            <div id="rejected" class="">Rejected</div>
            <div id="archives" class="">Archives</div>
        </section>

        <section id="requestContainer">
            <div id="containerHeader">  
                <div id="searchContainer">
                    <input type="text" id="searchRequest" placeholder="Search...">
                    <img src="../Images/Icons/icons8-search-25.png" alt="" width="20px">
                </div>
                <button id="CreateRequest">New Request</button>
            </div>

            <div id="containerBody" class="HideTab">
                <div class="mailRequest">
                    <div id="mailSender">Association Sender(Inbox)</div>
                    <div id="mailSubject">Sender Subject</div>
                    <div id="mailDate">DateTime</div>
                </div>
            </div>

            <div id="containerBodyApproved">
                <div class="mailRequest">
                    <div id="mailSender">Association Sender(Approved)</div>
                    <div id="mailSubject">Sender Subject</div>
                    <div id="mailDate">DateTime</div>
                </div>
            </div>

            <div id="containerBodyRejected">
                <div class="mailRequest">
                    <div id="mailSender">Association Sender(Rejected)</div>
                    <div id="mailSubject">Sender Subject</div>
                    <div id="mailDate">DateTime</div>
                </div>
            </div>

            <div id="containerBodyArchived">
                <div class="mailRequest">
                    <div id="mailSender">Association Sender(Archived)</div>
                    <div id="mailSubject">Sender Subject</div>
                    <div id="mailDate">DateTime</div>
                </div>
            </div>

        </section>
    </main>
        <script src="./Scripts/util/request.js"></script>
        <script src="./Scripts/util/navigation.js"></script>
    </body>
</html>