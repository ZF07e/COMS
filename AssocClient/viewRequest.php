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
                
                <div class="user_management">
                    <img src="../Images/Icons/icons8-group-25.png">
                    <div>Members</div>
                </div>
    
                <div class="request selected">
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
            <section id="topHeader"> 
                <div id="backButton">
                    &#8634; back
                </div>

                <div id="headerTitleRequest">
                    [Sample Title]
                </div>

                <div> <!--Extra div to center the Title--> </div>

            </section>

            <section id="middleSection">
                <section id="requestDocumentContainer">
                    <div id="requestDocument">
                        <div id="documentReqBody">
                            <iframe id="documentPrev" src="../JOBSTREET.pdf" width="100%" height="100%"></iframe>
                        </div>
                    </div>
                </section>

                <section id="rightContainer">

                    <div id="listOfApprover">
                        <div id="listOfApproverTitle">Recipients</div>

                        <div id="endorsedBy">
                            <div id="endorsedTitle">Endorsed By:</div>
                            <div id="endorsedList">

                                <div id="recipientContainer">
                                    <div id="reciepientName">
                                        <p>[Sample Recipient Name]</p>
                                    </div>
                                    <div id="reciepientStatusPending">Pending</div>
                                </div>      

                                <div id="recipientContainer">
                                    <div id="reciepientName">
                                        <p>[Sample Recipient Name]</p>
                                    </div>
                                    <div id="reciepientStatusPending">Pending</div>
                                </div>    

                                <div id="recipientContainer">
                                    <div id="reciepientName">
                                        <p>[Sample Recipient Name]</p>
                                    </div>
                                    <div id="reciepientStatusPending">Pending</div>
                                </div>    
     
                            </div>
                        </div>
                        <div id="notedBy">
                            <div id="notedTitle">Noted By:</div>
                            <div id="noteList">
                                <div id="recipientContainer">
                                    <div id="reciepientName">
                                        <p>[Sample Recipient Name]</p>
                                    </div>
                                    <div id="reciepientStatusPending">Pending</div>
                                </div>    

                                <div id="recipientContainer">
                                    <div id="reciepientName">
                                        <p>[Sample Recipient Name]</p>
                                    </div>
                                    <div id="reciepientStatusPending">Pending</div>
                                </div>    
                            </div>                            
                        </div>
                        <!-- <div id="approvedBy">
                            <div id="approvedTitle">Approved By:</div>
                            <div id="approvedList">
                                <div id="recipientContainer">
                                    <div id="reciepientName">
                                        <p>[Sample Recipient Name]</p>
                                    </div>
                                    <div id="reciepientStatusPending">Pending</div>
                                </div>    

                                <div id="recipientContainer">
                                    <div id="reciepientName">
                                        <p>[Sample Recipient Name]</p>
                                    </div>
                                    <div id="reciepientStatusPending">Pending</div>
                                </div>    
                            </div>
                        </div> -->
                        <button id="downloadButton">Download</button>
                    </div>

                    <div id="comments">                     
                        <div id="commentHeader">Comments</div>

                        <form id="addCommentContainer">
                            <textarea name="" id="commentTextbox" placeholder="Add a Comment..."></textarea>
                            <button id="commentButton">Comment</button>
                        </form>

                        <!-- <div id="commentsList">
                            <div id="commentStyle">
                                <div id="commentStyleHeader">Marius Brylle U. Pastoral (Student)</div>
                                <div id="commentBody">OOoohhhwwshiittt angaling</div>
                            </div>

                            <div id="commentStyle">
                                <div id="commentStyleHeader">Marius Brylle U. Pastoral (Student)</div>
                                <div id="commentBody">UwU</div>
                            </div>
                        </div> -->

                    </div>
                </section>
            </section>

        </main>

        <script src="./Scripts/utils/navigation.js"></script>
        <script src="./Scripts/viewRequest.js"></script>
    </body>
</html>