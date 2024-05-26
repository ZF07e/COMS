<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>COMS: Create Request</title>
        <!-- QUILL Library -->
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

        <!-- jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- Font Awesome -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <!-- my css -->
        <link rel="stylesheet" href="./Styles/request-style.css">
        <link rel="stylesheet" href="./Styles/mainStyle/general-style.css">
        <link rel="stylesheet" href="./Styles/mainStyle/header-style.css">
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
                
                <div class="associations">
                    <img src="../Images/Icons/icons8-hierarchy-25.png">
                    <div>Associations</div>
                </div>

                <div class="user_management">
                    <img src="../Images/Icons/icons8-management-25.png">
                    <div>User Management</div>
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
            <div class="top-main-section">Create Request </div>
            <form id="Requestmessage" action = "http://localhost/COMS/AdminPage/Functions/letterGenerator.php" method = "POST">
                
                <section id="leftsectionReq">
                    <div id="editor">
                    </div>
                </section>
                
                <section id="RightsectionReq">
                    <div id="SelectRecv">
                        <p for="field1">To</p>
                        <div class="field1"></div>
                    </div>

                    <div class="multiselectFields">
                        <p for="field2">Endorsed by</p>
                        <div class="field2"></div>
                    </div>

                    <div class="multiselectFields">
                        <p for="field3">Noted by</p>
                        <div class="field3"></div>
                    </div>

                    <div class="multiselectFields">
                        <p for="field4">Approved by</p>
                        <div class="field4"></div>
                    </div>

                    <div id="buttonContainer">
                        <button id="sendReq" type = "submit" name = "sendRequest">Send Request</button>  
                        <button id="canlReq" type="reset">cancel</button>                  
                    </div>
                </section>
            </form>
        </main>

        
        <!-- MultiSelect Library -->
        <script src="./Scripts/util/bundle.min.js"></script>
        <script src="./Scripts/util/navigation.js"></script>
        <script src="./Scripts/createRequest.js"></script>
    </body>
</html>