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

        <div id="ApprovePopUp_Con" action="">
            <form id="ApprovePopUp">
                <div id="ApproveHeader">
                    <h3>Sign Document</h3>
                    <div id="exitApproveHeader" type="reset">&#10005;</div>
                </div>  

                <div id="SignOptions">
                    <div id="UploadSignature" class="seclectedOption">Upload</div>
                    <div id="SignWithCanvas">Sign in Canvas</div>
                </div>

                <div id="ApproveBody">
                    <div id="UploadBody">               
                        <input type="file" id="fileSelector" accept=".png">
                        <img src="" alt="" id="prevIMg" width="380" height="210" style="display: none;">
                        <label for="fileSelector" id="labelFile">Choose A File</label>
                            
                        <canvas id="offscreen-canvas-upload" width="390" height="250" style="display: none;">
                        </canvas>
                    </div>

                    <div id="SignBody">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Sign in the canvas below</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <canvas id="sig-canvas" width="390" height="250">
                                </canvas>

                                <canvas id="offscreen-sig-canvas" width="390" height="250" style="display: none;">
                                </canvas>
                            </div>
                        </div>
                   
                        <div class="row">
                            <div class="footerSign">
                                <button class="btn btn-primary" id="sig-submitBtn" type="submit">Submit Signature</button>
                                <button class="btn btn-default" id="sig-clearBtn" type="button">Clear Signature</button>
                            </div>
                        </div>
                    </div>
                    <div id="ApproveOptions">
                        <button id="signUploaded" type="submit">Sign</button>
                        <button id="cancelUpload" type="reset">Cancel</button>
                    </div>                   
                </div>
            </form>  
        </div>

        <main>
            <section id="topHeader"> 
                <div id="backButton">
                    &#8634; back
                </div>

                <div id="headerTitleRequest">
                    [Sample Title]
                </div>

                <div> 
                    <button id="approveRequest">Approve</button>
                    <button id="rejectRequest">Reject</button>
                </div>

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
                        <div id="approvedBy">
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
                        </div>
                        <button id="downloadButton">Download</button>
                    </div>

                    <div id="comments">                     
                        <div id="commentHeader">Comments</div>

                        <form id="addCommentContainer">
                            <textarea name="" id="commentTextbox" placeholder="Add a Comment..."></textarea>
                            <button id="commentButton">Comment</button>
                        </form>

                        <div id="commentsList">
                            <!-- <div id="commentStyle">
                                <div id="commentStyleHeader">Marius Brylle U. Pastoral (Student)</div>
                                <div id="commentBody">OOoohhhwwshiittt angaling</div>
                            </div>

                            <div id="commentStyle">
                                <div id="commentStyleHeader">Marius Brylle U. Pastoral (Student)</div>
                                <div id="commentBody">UwU</div>
                            </div> -->
                        </div>

                    </div>
                </section>
            </section>

        </main>

        <script src="./Scripts/util/navigation.js"></script>
        <script src="./Scripts/viewRequest.js"></script>
    </body>
</html>