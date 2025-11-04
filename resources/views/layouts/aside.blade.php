<!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database-compat.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

.side-bar {
    position: fixed;
    background: #0C5097;
    width: 50px;
    height: 650vh;
    display: flex
;
    flex-direction: column;
    align-items: center;
    padding-top: 8px;
    top: 0;
    left: 1px !important;
    z-index: 6;
}
.chat-time {
    font-size: 10px;
}



        /* 🔘 Chat open button */
        #openChatBtn {
            padding: 0px;
            background: transparent;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            position: relative;
        }


        /* 🔴 Main unread badge */
        #mainBadge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            border-radius: 50%;
            font-size: 12px;
            padding: 2px 6px;
            display: none;
        }

        /* 🔲 Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0;
            width: 100%; height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        /* 🧱 Modal content */
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 12px;
            width: fit-content;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            position: relative;
        }

        /* ❌ Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover { color: black; }

        /* 💬 Chat styles */
        .chat-box 
        { 
            background: #fff;
             padding: 5px;
              border-radius: 10px; 
              width: 480px;
               margin: auto;
             }
        .user-list 
        { 
            height: 200px;
             overflow-y: auto;
              gap: 10px;
               margin-bottom: 15px;
                padding-bottom: 5px;
                 border-bottom: 1px solid #ddd; 
                 }

  
        .status 
        {
             font-size: 10px;
              margin-top: 2px; 
              color: #555; 
              }

        .user 
        {
             position: relative;
              padding: 8px 15px;
               background: #f0f0f0;
                border-radius: 10px;
                margin-top:5px;
                 cursor: pointer;
                  white-space: nowrap;
                   transition: all 0.3s; 
                }
        .user:hover
         {
             background: #e2e2e2; 
             }

        .user.active 
        {
        background: #0C5097;
        color: #fff;
         }
        .online::before { content: ""; position: absolute; right: 0px; top: 10%; transform: translateY(-50%); width: 10px; height: 10px; background: #28a745; border-radius: 50%; box-shadow: 0 0 0 2px #fff; }
        .badge
         { 
        position: absolute;
        top: -4px;
        right: -6px;
        background: red;
        color: #fff;
        border-radius: 50%;
        font-size: 12px;
        padding: 2px 6px;
        display: none; 
                }
        .user.has-unread .badge { display: inline-block; }
        .tick { font-size: 12px; margin-left: 5px; }
        .tick.read { color: #0b93f6; }
        .tick.delivered { color: #999; }
        img.chat-image { max-width: 180px; border-radius: 6px; display: block; margin: 5px 0; }

        /* Loader */
        #userLoader {
            width: 100%;
            text-align: center;
            padding: 10px;
            display: none;
        }
    </style>

<style>
/* 🔹 Chat input container */
.chat-input {
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 30px;
    padding: 6px 10px;
    background: #f9f9f9;
}

/* 📎 Attachment button */
#uploadBtn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 20px;
    margin-right: 8px;
}

/* ✏️ Message input field */
#message {
    flex: 1;
    border: none;
    outline: none;
    background: transparent;
    padding: 6px 10px;
}

/* 🚀 Send button */
#sendBtn45 {
    background-color: #0C5097;
    color: white;
    border: none;
    border-radius: 20px;
    padding: 6px 14px;
    cursor: pointer;
    transition: background 0.2s;
}

#sendBtn45:hover {
    background-color: #0C5097;
}
</style>


<style>
.chat-dropdown {
    display: none;
    position: fixed;
    bottom: 80px;
    right: 20px;
    width: 550px;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    z-index: 1000;
    padding: 10px;
}
.chat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
    padding-bottom: 6px;
}
.close-btn {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
}
.user-list {
    height: 230px;
    overflow-y: auto;
    margin-top: 8px;
    border-bottom: 1px solid #eee;
    padding-bottom: 6px;
}
.user {
    padding: 10px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
}
.user:hover {
    background: #f2f4f7;
}
.user.active {
    background: #0C5097;
}
.messages {
    max-height: 300px;
    overflow-y: auto;
    margin-top: 10px;
}
.message {
    padding: 8px 12px;
    margin: 4px 0;
    border-radius: 12px;
    max-width: 70%;
    word-wrap: break-word;
    display: inline-block;
    clear: both;
}

.message.me {
    background-color: #0C5097; /* red for sender */
    color: white;
    float: right;
    text-align: right;
}

.message {
    background-color: #f4f4f4; /* green for receiver */
    color: black;
    float: left;
    text-align: left;
}

.chat-image {
    max-width: 200px;
    border-radius: 8px;
    display: block;
}
.chat-input {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 10px;
}
.chat-input input[type="text"] {
    flex: 1;
    padding: 6px;
    border: 1px solid #ccc;
    border-radius: 6px;
}
.chat-input button {
    background: #0C5097;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 6px 10px;
    cursor: pointer;
}
.chat-input button:hover {
    background: #0a3c75;
}
.badge {
    background: red;
    color: white;
    border-radius: 50%;
    font-size: 12px;
    padding: 2px 6px;
    display: none;
}
.chat-topbar {
    position: sticky;
    top: 0;
    background: #0C5097;  /* blue background */
    color: white;
    padding: 8px 12px;
    display: flex;
    align-items: center;
    justify-content: flex-start; /* name on left */
    border-radius: 6px 6px 0 0;
    z-index: 10;
    font-size: 16px;
}


.chat-topbar i {
    font-size: 18px;
    color: white;
    cursor: pointer;
}

.chat-topbar i:hover {
    color: #ffdf00; /* hover effect */
}


</style>


    

<div class="side-bar">
    
    <ul class="inside-bar">
<li class="inside-bar-item" id="talk-btn">
    <button id="openChatBtn" class="inside-bar-text">
        <img src="{{ asset('svg/talk.svg') }}" alt="">
        <br>
        Talk
        <span id="mainBadge">0</span>
    </button>

    <!-- 💬 Chat Dropdown -->
    <div id="chatDropdown" class="chat-dropdown">
   <div class="chat-header">
    <p style="color:#0C5097; font-size:18px; font-weight:600; margin:0;">Users</p>

    <div class="header-actions">

        <button id="closeDropdown" class="close-btn">&times;</button>
    </div>
</div>


        <div id="userLoader"><em>Loading users...</em></div>
        <div class="user-list" id="userList"></div>

        <!-- Initially Hidden -->

<div class="chat-topbar " id="chatTopbar" style="display: none;">
    <span id="chatTopbarName" style="font-weight:600;"></span>
    <i class="bi bi-camera-video" style="color:white; font-size:16px; margin-left:auto"></i>
</div>

<div id="messages" class="messages" style="display:none;">
    <em>Select a user to start chatting...</em>
</div>





        <!-- Initially Hidden -->
        <div class="chat-input" id="chatInput" style="display:none;">
            <button id="uploadBtn">📎</button>
            <input type="file" id="fileInput" style="display:none;" accept="image/*,application/pdf,application/msword,.docx,.xlsx,.txt">
            <input type="text" id="message" placeholder="Type message...">
            <button id="sendBtn45">Send</button>
        </div>
    </div>
</li>

        <li class="inside-bar-item" id="video-btn" onclick="window.location.href='{{ route('video.authorize') }}'" style="cursor: pointer">
            <img src="{{ asset('svg/video.svg') }}" alt="">
            <p class="inside-bar-text">Video</p>
            <ul class="video-submenu" id="video-submenu">
                <div style="width: 100%; margin-left: -10px;">
                    <div
                        style="display: flex;
                    flex: auto;
                    margin: 15px;
                    height: fit-content;
                    margin-left: -10px;
                    border-bottom: 1px solid lightgray;
                    padding: 3px;
                    justify-content: space-between;
                    ">
                        <div>
                            <svg width="20" height="17" viewBox="0 0 33 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0 2C0 0.895429 0.895431 0 2 0H20.1194C21.224 0 22.1194 0.895431 22.1194 2V18.8906C22.1194 19.9951 21.224 20.8906 20.1194 20.8906H2C0.895432 20.8906 0 19.9951 0 18.8906V2Z"
                                    fill="#036AB2" />
                                <path
                                    d="M22.1864 10.822C21.6124 10.4243 21.6124 9.57568 22.1864 9.17799L30.6804 3.29314C31.3436 2.83366 32.2499 3.30831 32.2499 4.11513V15.8848C32.2499 16.6917 31.3436 17.1663 30.6804 16.7068L22.1864 10.822Z"
                                    fill="#036AB2" />
                            </svg>
                            <span
                                style="margin-left: 5px;
                                color: #036AB2;
                        font-size: 20px;
                        font-weight: bold;">Video</span>
                            <button class="btn dropdown-toggle" id="contact-detail" type="button"
                                style="
                                    height: 50px;padding: 0px;
                                    margin-top: -10px;
                                    margin-bottom: -4px;">
                                <span style="font-size: 10px;">Contacts</span>
                            </button>
                        </div>

                        <div class="contact-detail-record" id="contact-detail-record">
                            <div class="container" id="contact-container">
                                <div class="row">
                                    <div class="col-lg-12 contact-list"
                                        style="display: flex; flex-direction: column; align-items: start; gap: 5px;">
                                        <div style="width: 100%; padding-left: 10px;">
                                            <p
                                                style="font-size: 14px; margin-bottom: 0px; font-weight: bold; text-align: left;">
                                                Contacts</p>
                                        </div>
                                        <div style="width: 100%; padding-left: 10px;">
                                            <p
                                                style="font-size: 14px; margin-bottom: 0px; font-weight: bold; text-align: left;">
                                                Recents</p>
                                        </div>
                                        <div style="width: 100%; padding-left: 10px;">
                                            <p
                                                style="font-size: 14px; margin-bottom: 0px; font-weight: bold; text-align: left;">
                                                Meetings</p>
                                        </div>
                                        <div style="width: 100%; padding-left: 10px;">
                                            <p
                                                style="font-size: 14px; margin-bottom: 0px; font-weight: bold; text-align: left;">
                                                History</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <svg style="margin-right: 10px;" width="17" height="17" viewBox="0 0 17 17"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.23935 3.65672C9.23935 3.29402 8.94532 3 8.58263 3C8.21994 3 7.92591 3.29402 7.92591 3.65672V7.59667H3.65672C3.29402 7.59667 3 7.8907 3 8.25339C3 8.61608 3.29402 8.91011 3.65672 8.91011H7.92591L7.92591 13.3433C7.92591 13.706 8.21994 14 8.58263 14C8.94532 14 9.23935 13.706 9.23935 13.3433V8.91011H13.3433C13.706 8.91011 14 8.61608 14 8.25339C14 7.8907 13.706 7.59667 13.3433 7.59667L9.23935 7.59667V3.65672Z"
                                    fill="black" />
                                <mask id="path-2-inside-1_95_1215" fill="white">
                                    <rect width="17" height="17" rx="1" />
                                </mask>
                                <rect width="17" height="17" rx="1" stroke="black" stroke-width="3"
                                    mask="url(#path-2-inside-1_95_1215)" />
                            </svg>

                            <svg style="margin-right: 10px;" width="19" height="18" viewBox="0 0 19 18"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.52889 1.44C4.65799 1.44 1.52 4.41283 1.52 8.08C1.52 11.7472 4.65799 14.72 8.52889 14.72C10.4233 14.72 12.1422 14.008 13.4037 12.8509C13.426 12.8223 13.4509 12.7948 13.4783 12.7689C13.5057 12.7429 13.5346 12.7194 13.5649 12.6982C14.7862 11.5032 15.5378 9.87474 15.5378 8.08C15.5378 4.41283 12.3998 1.44 8.52889 1.44ZM15.0733 13.2617C16.3121 11.859 17.0578 10.052 17.0578 8.08C17.0578 3.61754 13.2393 0 8.52889 0C3.81851 0 0 3.61754 0 8.08C0 12.5425 3.81851 16.16 8.52889 16.16C10.6104 16.16 12.5178 15.4536 13.9985 14.28L17.7026 17.7891C17.9994 18.0703 18.4806 18.0703 18.7774 17.7891C19.0742 17.5079 19.0742 17.0521 18.7774 16.7709L15.0733 13.2617Z"
                                    fill="black" />
                            </svg>

                            <svg id="video-close" style="margin-left: auto;" width="16" height="16"
                                viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.45779 0.833283C1.99215 0.367647 1.23721 0.367647 0.771573 0.833283C0.305936 1.29892 0.305936 2.05386 0.771572 2.5195L5.82979 7.57771L0.349227 13.0583C-0.116409 13.5239 -0.116409 14.2789 0.349227 14.7445C0.814863 15.2101 1.56981 15.2101 2.03544 14.7445L7.516 9.26393L13.2074 14.9554C13.6731 15.421 14.428 15.421 14.8936 14.9554C15.3593 14.4897 15.3593 13.7348 14.8936 13.2691L9.20222 7.57771L14.4713 2.30864C14.9369 1.843 14.9369 1.08806 14.4713 0.62242C14.0057 0.156784 13.2507 0.156784 12.7851 0.62242L7.516 5.8915L2.45779 0.833283Z"
                                    fill="black" />
                            </svg>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row" style="align-items: baseline; margin-bottom: 20px;">
                            <div class="col-lg-8">
                                <div style="display: flex; align-items: center;">
                                    <div style="margin-right: 10px;">

                                        <svg width="20" height="31" viewBox="0 0 31 31" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="1" y="1" width="29" height="29" stroke="black"
                                                stroke-width="2" />
                                        </svg>

                                    </div>
                                    <div style="position: relative; display: inline-block;">
                                        <img src="./images/minisite/2.png"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 100px;"
                                            alt="">
                                        <span
                                            style="position: absolute; bottom: 0; right: 0; width: 13px; height: 13px; background: #10AA2E;; border-radius: 50%; border: 2px solid white;"></span>
                                    </div>

                                    <div style="padding-left: 5px;">
                                        <p style="font-size: 14px;margin-bottom: 0px;"><span
                                                style="font-weight: bold">Emma Johnson</span>
                                        </p>
                                        <p
                                            style="font-size: 10px;color: #707070; margin-bottom: 0px; text-align: left;">
                                            Tresmark</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">

                            </div>
                            <div class="col-lg-2">
                                <svg width="25" height="18" viewBox="0 0 35 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3 0C1.34315 0 0 1.34314 0 3V19.8906C0 21.5474 1.34315 22.8906 3 22.8906H21.1194C22.7763 22.8906 24.1194 21.5474 24.1194 19.8906V13.338L32.6941 19.1888C33.0003 19.3977 33.397 19.4201 33.7248 19.2469C34.0526 19.0737 34.2577 18.7334 34.2577 18.3627V4.52785C34.2577 4.15712 34.0526 3.81682 33.7248 3.64365C33.397 3.47048 33.0003 3.49287 32.6941 3.70182L24.1194 9.55254V3C24.1194 1.34314 22.7763 0 21.1194 0H3ZM2 3C2 2.44771 2.44771 2 3 2H21.1194C21.6717 2 22.1194 2.44772 22.1194 3V19.8906C22.1194 20.4428 21.6717 20.8906 21.1194 20.8906H3C2.44772 20.8906 2 20.4428 2 19.8906V3ZM32.2577 16.4698L24.8939 11.4453L32.2577 6.42078V16.4698Z"
                                        fill="black" />
                                </svg>
                            </div>
                        </div>
                        <div class="row" style="align-items: baseline; margin-bottom: 20px;">
                            <div class="col-lg-8">
                                <div style="display: flex; align-items: center;">
                                    <div style="margin-right: 10px;">

                                        <svg width="20" height="31" viewBox="0 0 31 31" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="1" y="1" width="29" height="29" stroke="black"
                                                stroke-opacity="0.4" stroke-width="2" />
                                        </svg>

                                    </div>
                                    <div style="position: relative; display: inline-block;">
                                        <img src="./images/minisite/2.png"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 100px;"
                                            alt="">
                                        <span
                                            style="position: absolute; bottom: 0; right: 0; width: 13px; height: 13px; background: #DE2020; border-radius: 50%; border: 2px solid white;"></span>
                                    </div>

                                    <div style="padding-left: 5px;">
                                        <p style="font-size: 14px;margin-bottom: 0px;"><span
                                                style="font-weight: bold">William Brown</span>
                                        </p>
                                        <p
                                            style="font-size: 10px;color: #707070; margin-bottom: 0px; text-align: left;">
                                            Tresmark</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">

                            </div>
                            <div class="col-lg-2">
                                <svg width="25" height="23" viewBox="0 0 35 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3 0C1.34315 0 0 1.34314 0 3V19.8906C0 21.5474 1.34315 22.8906 3 22.8906H21.1194C22.7763 22.8906 24.1194 21.5474 24.1194 19.8906V13.338L32.6941 19.1888C33.0003 19.3977 33.397 19.4201 33.7248 19.2469C34.0526 19.0737 34.2577 18.7334 34.2577 18.3627V4.52785C34.2577 4.15712 34.0526 3.81682 33.7248 3.64365C33.397 3.47048 33.0003 3.49287 32.6941 3.70182L24.1194 9.55254V3C24.1194 1.34314 22.7763 0 21.1194 0H3ZM2 3C2 2.44771 2.44771 2 3 2H21.1194C21.6717 2 22.1194 2.44772 22.1194 3V19.8906C22.1194 20.4428 21.6717 20.8906 21.1194 20.8906H3C2.44772 20.8906 2 20.4428 2 19.8906V3ZM32.2577 16.4698L24.8939 11.4453L32.2577 6.42078V16.4698Z"
                                        fill="black" fill-opacity="0.4" />
                                </svg>
                            </div>
                    </div>
                </div>
            </ul>
        </li>
        <li class="inside-bar-item" id="address-btn">
            <img src="{{ asset('svg/address.svg') }}" alt="">
            <p class="inside-bar-text">Address</p>
            <ul class="address-submenu" id="address-submenu">
                <div style="width: 100%; margin-left: -6px;">
                    <div
                        style="display: flex;
                    flex: auto;
                    margin: 15px;
                    height: fit-content;
                    margin-left: -10px;
                    border-bottom: 1px solid lightgray;
                    padding: 10px
                    ">
                        <svg width="20" height="20" viewBox="0 0 31 31" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.9156 2.48C7.59987 2.48 2.48 7.59987 2.48 13.9156C2.48 20.2312 7.59987 25.3511 13.9156 25.3511C17.0065 25.3511 19.811 24.1248 21.8691 22.1322C21.9056 22.0828 21.9461 22.0356 21.9909 21.9909C22.0356 21.9461 22.0828 21.9056 22.1322 21.8691C24.1248 19.811 25.3511 17.0065 25.3511 13.9156C25.3511 7.59987 20.2312 2.48 13.9156 2.48ZM24.5932 22.8396C26.6145 20.4238 27.8311 17.3118 27.8311 13.9156C27.8311 6.23021 21.6009 0 13.9156 0C6.23021 0 0 6.23021 0 13.9156C0 21.6009 6.23021 27.8311 13.9156 27.8311C17.3118 27.8311 20.4238 26.6145 22.8396 24.5932L28.8832 30.6368C29.3674 31.1211 30.1526 31.1211 30.6368 30.6368C31.1211 30.1526 31.1211 29.3674 30.6368 28.8832L24.5932 22.8396Z"
                                fill="black" />
                        </svg>
                        <span
                            style="margin-left: 10px;
                        font-size: 18px;
                        font-weight: bold;">Address
                            book directory</span>
                        <svg id="address-close" style="margin-left: auto;" width="16" height="16"
                            viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.45779 0.833283C1.99215 0.367647 1.23721 0.367647 0.771573 0.833283C0.305936 1.29892 0.305936 2.05386 0.771572 2.5195L5.82979 7.57771L0.349227 13.0583C-0.116409 13.5239 -0.116409 14.2789 0.349227 14.7445C0.814863 15.2101 1.56981 15.2101 2.03544 14.7445L7.516 9.26393L13.2074 14.9554C13.6731 15.421 14.428 15.421 14.8936 14.9554C15.3593 14.4897 15.3593 13.7348 14.8936 13.2691L9.20222 7.57771L14.4713 2.30864C14.9369 1.843 14.9369 1.08806 14.4713 0.62242C14.0057 0.156784 13.2507 0.156784 12.7851 0.62242L7.516 5.8915L2.45779 0.833283Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div class="container">
                        <div class="row" style="align-items: baseline;">
                            <div class="col-lg-8">
                                <div style="display: flex; align-items: center;">
                                    <div>
                                        <img src="./images/address/1.png"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 100px;"
                                            alt="">
                                    </div>
                                    <div style="padding-top: 15px; padding-left: 5px;">
                                        <p style="font-size: 14px;margin-bottom: 0px;"><span
                                                style="font-weight: bold">Walter White</span>
                                            <span style="color: #707070; font-size: 10px; padding: 1px 4px 2px 4px;">
                                                ( Tresmark )
                                            </span>
                                        </p>
                                        <p
                                            style="font-size: 10px;color: #707070; margin-bottom: 0px; text-align: left;">
                                            walter@landmark.com</p>
                                        <p style="font-size: 10px;color: #707070; text-align: left;">+92 333 687
                                            7977</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <svg width="20" height="20" viewBox="0 0 25 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 3C1 1.89543 1.89543 1 3 1H21.1194C22.224 1 23.1194 1.89543 23.1194 3V17.8906C23.1194 18.9951 22.224 19.8906 21.1194 19.8906H9.2115C8.75129 19.8906 8.30517 20.0493 7.94836 20.3399L2.63157 24.6709C1.97827 25.2031 1 24.7382 1 23.8956V3Z"
                                        stroke="black" stroke-width="2" />
                                </svg>
                            </div>
                            <div class="col-lg-2">
                                <svg width="25" height="18" viewBox="0 0 35 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3 0C1.34315 0 0 1.34314 0 3V19.8906C0 21.5474 1.34315 22.8906 3 22.8906H21.1194C22.7763 22.8906 24.1194 21.5474 24.1194 19.8906V13.338L32.6941 19.1888C33.0003 19.3977 33.397 19.4201 33.7248 19.2469C34.0526 19.0737 34.2577 18.7334 34.2577 18.3627V4.52785C34.2577 4.15712 34.0526 3.81682 33.7248 3.64365C33.397 3.47048 33.0003 3.49287 32.6941 3.70182L24.1194 9.55254V3C24.1194 1.34314 22.7763 0 21.1194 0H3ZM2 3C2 2.44771 2.44771 2 3 2H21.1194C21.6717 2 22.1194 2.44772 22.1194 3V19.8906C22.1194 20.4428 21.6717 20.8906 21.1194 20.8906H3C2.44772 20.8906 2 20.4428 2 19.8906V3ZM32.2577 16.4698L24.8939 11.4453L32.2577 6.42078V16.4698Z"
                                        fill="black" />
                                </svg>
                            </div>
                        </div>
                        <div class="row" style="align-items: baseline;">
                            <div class="col-lg-8">
                                <div style="display: flex;align-items: center;">
                                    <div>
                                        <img src="./images/address/1.png"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 100px;"
                                            alt="">
                                    </div>
                                    <div style="padding-top: 15px; padding-left: 5px;">
                                        <p style="font-size: 14px;margin-bottom: 0px;"><span
                                                style="font-weight: bold">Walter White</span>
                                            <span style="color: #707070; font-size: 10px; padding: 1px 4px 2px 4px;">
                                                ( Tresmark )
                                            </span>
                                        </p>
                                        <p
                                            style="font-size: 10px;color: #707070; margin-bottom: 0px; text-align: left;">
                                            walter@landmark.com</p>
                                        <p style="font-size: 10px;color: #707070; text-align: left;">+92 333 687
                                            7977</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <svg width="20" height="20" viewBox="0 0 25 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 3C1 1.89543 1.89543 1 3 1H21.1194C22.224 1 23.1194 1.89543 23.1194 3V17.8906C23.1194 18.9951 22.224 19.8906 21.1194 19.8906H9.2115C8.75129 19.8906 8.30517 20.0493 7.94836 20.3399L2.63157 24.6709C1.97827 25.2031 1 24.7382 1 23.8956V3Z"
                                        stroke="black" stroke-width="2" />
                                </svg>
                            </div>
                            <div class="col-lg-2">
                                <svg width="25" height="18" viewBox="0 0 35 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3 0C1.34315 0 0 1.34314 0 3V19.8906C0 21.5474 1.34315 22.8906 3 22.8906H21.1194C22.7763 22.8906 24.1194 21.5474 24.1194 19.8906V13.338L32.6941 19.1888C33.0003 19.3977 33.397 19.4201 33.7248 19.2469C34.0526 19.0737 34.2577 18.7334 34.2577 18.3627V4.52785C34.2577 4.15712 34.0526 3.81682 33.7248 3.64365C33.397 3.47048 33.0003 3.49287 32.6941 3.70182L24.1194 9.55254V3C24.1194 1.34314 22.7763 0 21.1194 0H3ZM2 3C2 2.44771 2.44771 2 3 2H21.1194C21.6717 2 22.1194 2.44772 22.1194 3V19.8906C22.1194 20.4428 21.6717 20.8906 21.1194 20.8906H3C2.44772 20.8906 2 20.4428 2 19.8906V3ZM32.2577 16.4698L24.8939 11.4453L32.2577 6.42078V16.4698Z"
                                        fill="black" />
                                </svg>
                            </div>
                        </div>
                        <div class="row" style="align-items: baseline;">
                            <div class="col-lg-8">
                                <div style="display: flex; align-items: center;">
                                    <div>
                                        <img src="./images/address/1.png"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 100px;"
                                            alt="">
                                    </div>
                                    <div style="padding-top: 15px; padding-left: 5px;">
                                        <p style="font-size: 14px;margin-bottom: 0px;"><span
                                                style="font-weight: bold">Walter White</span>
                                            <span style="color: #707070; font-size: 10px; padding: 1px 4px 2px 4px;">
                                                ( Tresmark )
                                            </span>
                                        </p>
                                        <p
                                            style="font-size: 10px;color: #707070; margin-bottom: 0px; text-align: left;">
                                            walter@landmark.com</p>
                                        <p style="font-size: 10px;color: #707070; text-align: left;">+92 333 687
                                            7977</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <svg width="20" height="20" viewBox="0 0 25 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 3C1 1.89543 1.89543 1 3 1H21.1194C22.224 1 23.1194 1.89543 23.1194 3V17.8906C23.1194 18.9951 22.224 19.8906 21.1194 19.8906H9.2115C8.75129 19.8906 8.30517 20.0493 7.94836 20.3399L2.63157 24.6709C1.97827 25.2031 1 24.7382 1 23.8956V3Z"
                                        stroke="black" stroke-width="2" />
                                </svg>
                            </div>
                            <div class="col-lg-2">
                                <svg width="25" height="18" viewBox="0 0 35 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3 0C1.34315 0 0 1.34314 0 3V19.8906C0 21.5474 1.34315 22.8906 3 22.8906H21.1194C22.7763 22.8906 24.1194 21.5474 24.1194 19.8906V13.338L32.6941 19.1888C33.0003 19.3977 33.397 19.4201 33.7248 19.2469C34.0526 19.0737 34.2577 18.7334 34.2577 18.3627V4.52785C34.2577 4.15712 34.0526 3.81682 33.7248 3.64365C33.397 3.47048 33.0003 3.49287 32.6941 3.70182L24.1194 9.55254V3C24.1194 1.34314 22.7763 0 21.1194 0H3ZM2 3C2 2.44771 2.44771 2 3 2H21.1194C21.6717 2 22.1194 2.44772 22.1194 3V19.8906C22.1194 20.4428 21.6717 20.8906 21.1194 20.8906H3C2.44772 20.8906 2 20.4428 2 19.8906V3ZM32.2577 16.4698L24.8939 11.4453L32.2577 6.42078V16.4698Z"
                                        fill="black" />
                                </svg>
                            </div>
                        </div>
                        <div class="row" style="align-items: baseline;">
                            <div class="col-lg-8">
                                <div style="display: flex;align-items: center;">
                                    <div>
                                        <img src="./images/address/1.png"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 100px;"
                                            alt="">
                                    </div>
                                    <div style="padding-top: 15px; padding-left: 5px;">
                                        <p style="font-size: 14px;margin-bottom: 0px;"><span
                                                style="font-weight: bold">Walter White</span>
                                            <span style="color: #707070; font-size: 10px; padding: 1px 4px 2px 4px;">
                                                ( Tresmark )
                                            </span>
                                        </p>
                                        <p
                                            style="font-size: 10px;color: #707070; margin-bottom: 0px; text-align: left;">
                                            walter@landmark.com</p>
                                        <p style="font-size: 10px;color: #707070; text-align: left;">+92 333 687
                                            7977</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <svg width="20" height="20" viewBox="0 0 25 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 3C1 1.89543 1.89543 1 3 1H21.1194C22.224 1 23.1194 1.89543 23.1194 3V17.8906C23.1194 18.9951 22.224 19.8906 21.1194 19.8906H9.2115C8.75129 19.8906 8.30517 20.0493 7.94836 20.3399L2.63157 24.6709C1.97827 25.2031 1 24.7382 1 23.8956V3Z"
                                        stroke="black" stroke-width="2" />
                                </svg>
                            </div>
                            <div class="col-lg-2">
                                <svg width="25" height="18" viewBox="0 0 35 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3 0C1.34315 0 0 1.34314 0 3V19.8906C0 21.5474 1.34315 22.8906 3 22.8906H21.1194C22.7763 22.8906 24.1194 21.5474 24.1194 19.8906V13.338L32.6941 19.1888C33.0003 19.3977 33.397 19.4201 33.7248 19.2469C34.0526 19.0737 34.2577 18.7334 34.2577 18.3627V4.52785C34.2577 4.15712 34.0526 3.81682 33.7248 3.64365C33.397 3.47048 33.0003 3.49287 32.6941 3.70182L24.1194 9.55254V3C24.1194 1.34314 22.7763 0 21.1194 0H3ZM2 3C2 2.44771 2.44771 2 3 2H21.1194C21.6717 2 22.1194 2.44772 22.1194 3V19.8906C22.1194 20.4428 21.6717 20.8906 21.1194 20.8906H3C2.44772 20.8906 2 20.4428 2 19.8906V3ZM32.2577 16.4698L24.8939 11.4453L32.2577 6.42078V16.4698Z"
                                        fill="black" />
                                </svg>
                            </div>
                        </div>
                        <div class="row" style="align-items: baseline;">
                            <div class="col-lg-8">
                                <div style="display: flex; align-items: center;">
                                    <div>
                                        <img src="./images/address/1.png"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 100px;"
                                            alt="">
                                    </div>
                                    <div style="padding-top: 15px; padding-left: 5px;">
                                        <p style="font-size: 14px;margin-bottom: 0px;"><span
                                                style="font-weight: bold">Walter White</span>
                                            <span style="color: #707070; font-size: 10px; padding: 1px 4px 2px 4px;">
                                                ( Tresmark )
                                            </span>
                                        </p>
                                        <p
                                            style="font-size: 10px;color: #707070; margin-bottom: 0px; text-align: left;">
                                            walter@landmark.com</p>
                                        <p style="font-size: 10px;color: #707070; text-align: left;">+92 333 687
                                            7977</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <svg width="20" height="20" viewBox="0 0 25 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 3C1 1.89543 1.89543 1 3 1H21.1194C22.224 1 23.1194 1.89543 23.1194 3V17.8906C23.1194 18.9951 22.224 19.8906 21.1194 19.8906H9.2115C8.75129 19.8906 8.30517 20.0493 7.94836 20.3399L2.63157 24.6709C1.97827 25.2031 1 24.7382 1 23.8956V3Z"
                                        stroke="black" stroke-width="2" />
                                </svg>
                            </div>
                            <div class="col-lg-2">
                                <svg width="25" height="18" viewBox="0 0 35 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3 0C1.34315 0 0 1.34314 0 3V19.8906C0 21.5474 1.34315 22.8906 3 22.8906H21.1194C22.7763 22.8906 24.1194 21.5474 24.1194 19.8906V13.338L32.6941 19.1888C33.0003 19.3977 33.397 19.4201 33.7248 19.2469C34.0526 19.0737 34.2577 18.7334 34.2577 18.3627V4.52785C34.2577 4.15712 34.0526 3.81682 33.7248 3.64365C33.397 3.47048 33.0003 3.49287 32.6941 3.70182L24.1194 9.55254V3C24.1194 1.34314 22.7763 0 21.1194 0H3ZM2 3C2 2.44771 2.44771 2 3 2H21.1194C21.6717 2 22.1194 2.44772 22.1194 3V19.8906C22.1194 20.4428 21.6717 20.8906 21.1194 20.8906H3C2.44772 20.8906 2 20.4428 2 19.8906V3ZM32.2577 16.4698L24.8939 11.4453L32.2577 6.42078V16.4698Z"
                                        fill="black" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </li>
        <a href="{{ url('/minisites') }}" style="text-decoration: none;">
    <li class="inside-bar-item" id="minisite-btn">
        <img src="{{ asset('svg/minisite-1.svg') }}" alt="">
        <p class="inside-bar-text">Minisite</p>
    </li>
</a>

        <li class="inside-bar-item" style="cursor: pointer" id="createSnap">
            <img src="{{ asset('svg/snap.svg') }}" alt="">
            <p class="inside-bar-text">Snap</p>
        </li>
        <li class="inside-bar-item" id="media-btn" style="cursor: pointer">
            <img src="{{ asset('svg/media.svg') }}" alt="">
            <p class="inside-bar-text">Media</p>
            <ul class="media-submenu" id="media-submenu">
                <div style="width: 95%;">
                    <div
                        style="display: flex;
                                flex: auto;
                                margin: 15px;
                                height: fit-content;
                                margin-left: -10px;
                                border-bottom: 1px solid lightgray;
                                padding: 10px
                                ">
                        <svg width="20" height="20" viewBox="0 0 26 26" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <mask id="path-1-inside-1_93_1117" fill="white">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.9696 4.23524C10.9696 6.5743 9.07346 8.47048 6.73441 8.47048C4.39535 8.47048 2.49916 6.5743 2.49916 4.23524C2.49916 1.89618 4.39535 0 6.73441 0C9.07346 0 10.9696 1.89618 10.9696 4.23524ZM21.6711 9.87377L25.593 19.0459C26.2571 20.5872 26.1068 22.3539 25.1545 23.7573C24.2272 25.1607 22.6609 26.0003 20.9819 26.0003H4.99323C3.25152 26.0003 1.66017 25.1106 0.745456 23.632C-0.169256 22.1535 -0.244438 20.3366 0.532441 18.7703L2.70018 14.4473C3.33923 13.1818 4.30406 12.4049 5.43179 12.2921C6.55951 12.1793 7.66218 12.7181 8.55183 13.8333L8.8275 14.1842C9.46654 14.9987 10.256 15.4122 11.0454 15.337C11.8222 15.2743 12.5365 14.7355 13.0377 13.8333L15.4184 9.56051C16.3081 7.95663 17.4734 7.1171 18.6763 7.17975C19.8918 7.2424 20.9568 8.19471 21.6711 9.87377Z" />
                            </mask>
                            <path
                                d="M25.593 19.0459L24.2138 19.6357L24.2155 19.6395L25.593 19.0459ZM21.6711 9.87377L20.2907 10.4609L20.2918 10.4635L21.6711 9.87377ZM25.1545 23.7573L23.9133 22.9151L23.9081 22.9227L23.903 22.9305L25.1545 23.7573ZM0.745456 23.632L-0.530172 24.4212H-0.530172L0.745456 23.632ZM0.532441 18.7703L-0.808434 18.0979L-0.811343 18.1038L0.532441 18.7703ZM2.70018 14.4473L1.3612 13.7712L1.35932 13.775L2.70018 14.4473ZM5.43179 12.2921L5.28253 10.7996H5.28253L5.43179 12.2921ZM8.55183 13.8333L9.73134 12.9066L9.72442 12.8979L8.55183 13.8333ZM8.8275 14.1842L10.0076 13.2583L10.007 13.2575L8.8275 14.1842ZM11.0454 15.337L10.9248 13.8418L10.914 13.8427L10.9031 13.8437L11.0454 15.337ZM13.0377 13.8333L11.7273 13.1032L11.7264 13.1049L13.0377 13.8333ZM15.4184 9.56051L16.7288 10.2906L16.7302 10.2881L15.4184 9.56051ZM18.6763 7.17975L18.5983 8.67772L18.5991 8.67776L18.6763 7.17975ZM6.73441 9.97048C9.90189 9.97048 12.4696 7.40273 12.4696 4.23524H9.46965C9.46965 5.74587 8.24504 6.97048 6.73441 6.97048V9.97048ZM0.999165 4.23524C0.999165 7.40273 3.56692 9.97048 6.73441 9.97048V6.97048C5.22377 6.97048 3.99916 5.74587 3.99916 4.23524H0.999165ZM6.73441 -1.5C3.56692 -1.5 0.999165 1.06776 0.999165 4.23524H3.99916C3.99916 2.72461 5.22377 1.5 6.73441 1.5V-1.5ZM12.4696 4.23524C12.4696 1.06775 9.90189 -1.5 6.73441 -1.5V1.5C8.24504 1.5 9.46965 2.72461 9.46965 4.23524H12.4696ZM26.9722 18.4562L23.0503 9.28403L20.2918 10.4635L24.2138 19.6357L26.9722 18.4562ZM26.3957 24.5996C27.6408 22.7647 27.8338 20.4556 26.9706 18.4524L24.2155 19.6395C24.6805 20.7187 24.5728 21.9432 23.9133 22.9151L26.3957 24.5996ZM20.9819 27.5003C23.1634 27.5003 25.2003 26.409 26.406 24.5842L23.903 22.9305C23.2541 23.9125 22.1585 24.5003 20.9819 24.5003V27.5003ZM4.99323 27.5003H20.9819V24.5003H4.99323V27.5003ZM-0.530172 24.4212C0.657284 26.3406 2.73067 27.5003 4.99323 27.5003V24.5003C3.77236 24.5003 2.66305 23.8806 2.02108 22.8429L-0.530172 24.4212ZM-0.811343 18.1038C-1.81483 20.1269 -1.72201 22.4947 -0.530172 24.4212L2.02108 22.8429C1.38349 21.8122 1.32596 20.5462 1.87622 19.4368L-0.811343 18.1038ZM1.35932 13.775L-0.808422 18.0979L1.8733 19.4427L4.04105 15.1197L1.35932 13.775ZM5.28253 10.7996C3.49782 10.978 2.15575 12.1977 1.3612 13.7712L4.03916 15.1234C4.52271 14.1658 5.1103 13.8317 5.58104 13.7847L5.28253 10.7996ZM9.72442 12.8979C8.60525 11.495 7.04287 10.6235 5.28253 10.7996L5.58104 13.7847C6.07616 13.7352 6.71912 13.9413 7.37924 14.7688L9.72442 12.8979ZM10.007 13.2575L9.73131 12.9066L7.37236 14.7601L7.64802 15.1109L10.007 13.2575ZM10.9031 13.8437C10.7805 13.8554 10.4438 13.8141 10.0076 13.2583L7.64739 15.1101C8.48933 16.1832 9.73139 16.9689 11.1876 16.8302L10.9031 13.8437ZM11.7264 13.1049C11.3814 13.726 11.0452 13.8321 10.9248 13.8418L11.1659 16.8321C12.5993 16.7165 13.6916 15.745 14.3489 14.5618L11.7264 13.1049ZM14.1081 8.83041L11.7273 13.1032L14.348 14.5634L16.7288 10.2906L14.1081 8.83041ZM18.7543 5.68178C16.7184 5.57574 15.12 7.00609 14.1067 8.83292L16.7302 10.2881C17.4961 8.90717 18.2284 8.65846 18.5983 8.67772L18.7543 5.68178ZM23.0514 9.28662C22.2357 7.36903 20.7999 5.78722 18.7535 5.68174L18.5991 8.67776C18.9836 8.69759 19.678 9.02039 20.2907 10.4609L23.0514 9.28662Z"
                                fill="black" mask="url(#path-1-inside-1_93_1117)" />
                        </svg>
                        <span
                            style="margin-left: 10px;
                        font-size: 18px;
                        font-weight: bold;">Media</span>
                        <svg id="media-close" style="margin-left: auto; cursor: pointer;" width="16"
                            height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.45779 0.833283C1.99215 0.367647 1.23721 0.367647 0.771573 0.833283C0.305936 1.29892 0.305936 2.05386 0.771572 2.5195L5.82979 7.57771L0.349227 13.0583C-0.116409 13.5239 -0.116409 14.2789 0.349227 14.7445C0.814863 15.2101 1.56981 15.2101 2.03544 14.7445L7.516 9.26393L13.2074 14.9554C13.6731 15.421 14.428 15.421 14.8936 14.9554C15.3593 14.4897 15.3593 13.7348 14.8936 13.2691L9.20222 7.57771L14.4713 2.30864C14.9369 1.843 14.9369 1.08806 14.4713 0.62242C14.0057 0.156784 13.2507 0.156784 12.7851 0.62242L7.516 5.8915L2.45779 0.833283Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div>
                        <form id="uploadForm" action="{{ route('media.store') }}" method="POST"
                            enctype="multipart/form-data"
                            style="display: flex; flex-direction: column; align-items: center; padding: 10px; background: linear-gradient(to bottom, #f8f9fa, #ffffff); border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); max-width: 400px; margin: 16px auto;">
                            @csrf
                            <div style="width: 100%; text-align: center;">
                                <button type="button" onclick="document.getElementById('mediaInput').click();"
                                    style="background: linear-gradient(135deg, #2197D7, #1976D2);
                                               width: 220px;
                                               height: 48px;
                                               border-radius: 24px;
                                               border: none;
                                               color: #FFFFFF;
                                               font-size: 16px;
                                               font-weight: 500;
                                               cursor: pointer;
                                               transition: all 0.3s ease;
                                               box-shadow: 0 2px 4px rgba(33, 151, 215, 0.2);
                                               display: flex;
                                               align-items: center;
                                               justify-content: center;
                                               margin: 0 auto;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(33, 151, 215, 0.3)';"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(33, 151, 215, 0.2)';">
                                    Upload Media
                                </button>
                            </div>

                            <input type="file" id="mediaInput" name="media" accept="image/*,video/*,audio/*"
                                style="display: none;" onchange="submitForm(event)">

                            <div id="loader"
                                style="display: none;
                                        text-align: center;
                                        margin-top: 20px;
                                        padding: 20px;
                                        background: rgba(255, 255, 255, 0.9);
                                        border-radius: 8px;
                                        width: 100%;">
                                <div
                                    style="border: 3px solid #f3f3f3;
                                            border-top: 3px solid #2197D7;
                                            border-radius: 50%;
                                            width: 40px;
                                            height: 40px;
                                            animation: spin 1s linear infinite;
                                            margin: 0 auto;">
                                </div>
                                <p
                                    style="margin-top: 15px;
                                          color: #2197D7;
                                          font-weight: 500;">
                                    Uploading...</p>
                            </div>
                        </form>
                        <div id="mediaContainer"
                            style="display: flex; flex-wrap: wrap; justify-content: center; margin-top: 10px;"></div>

                        <div id="successMessage" style="display: none; color: green; text-align: center;">
                            Media uploaded successfully!
                        </div>
                    </div>

                    <div
                        style="display: flex; justify-content: space-between; margin-top: 20px; margin-bottom:10px; font-size: 13px;">
                        <div id="imageTab"
                            style="border-bottom: 4px solid #036AB2; padding-bottom: 3px; cursor: pointer;"
                            onclick="toggleMedia('image')">Images</div>
                        <div id="videoTab" style="cursor: pointer;" onclick="toggleMedia('video')">Videos</div>
                        <div id="audioTab" style="cursor: pointer;" onclick="toggleMedia('audio')">Audio</div>
                    </div>

                    <div style="margin-left: -20px; display: flex; justify-content: space-between;">
                        <!-- Images Section -->
                        <div id="imageSection" style="margin-bottom: 10px; text-align: center; width: 100%;">
                            <div id="imageContainer"
                                style="display: grid; grid-template-columns: repeat(auto-fill, minmax(155px, 1fr)); gap: 10px;">
                                {{--  @forelse ($media->where('type', 'image') as $image)
                                    <div class="media-container"
                                        style="position: relative; width: 155px; height: 100px;">
                                        <img src="{{ asset($image->path) }}" class="image-fluid"
                                            style="object-fit: cover; width: 100%; height: 100%; border-radius: 6px;">
                                        <button class="delete-media" data-id="{{ $image->id }}"
                                            style="position: absolute; bottom: 2px; right: 2px; background: red; color: white;
                                                   border: none; padding: 2px; border-radius: 50%; cursor: pointer;">
                                            🗑️
                                        </button>
                                    </div>
                                @empty
                                    <p style="grid-column: span 2; font-size: 14px; font-weight: bold; color: gray;">No
                                        images found</p>
                                @endforelse  --}}
                            </div>
                        </div>

                        <!-- VIDEO SECTION -->
                        <div id="videoSection" style="display: none; width: 100%; text-align: center;">
                            <div id="videoContainer"
                                style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 10px;">
                                {{--  @forelse ($media->where('type', 'video') as $video)
                                    <div class="media-container"
                                        style="position: relative; width: 150px; height: 120px;">
                                        <video width="100%" height="100%" controls
                                            style="border-radius: 6px; object-fit: cover;">
                                            <source src="{{ asset($video->path) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <button class="delete-media" data-id="{{ $video->id }}"
                                            style="position: absolute; top: 2px; right: 2px; background: red; color: white;
                                                   border: none; padding: 1px; border-radius: 50%; cursor: pointer;">
                                            🗑️
                                        </button>
                                    </div>
                                @empty
                                    <p style="grid-column: span 2; font-size: 14px; font-weight: bold; color: gray;">No
                                        videos found</p>
                                @endforelse  --}}
                            </div>
                        </div>

                        <!-- AUDIO SECTION -->
                        <div id="audioSection" style="display: none; width: 100%; text-align: center;">
                            <div id="audioContainer" style="display: grid; gap: 10px;">
                                {{--  @forelse ($media->where('type', 'audio') as $audio)
                                    <div class="media-container" style="position: relative; display: inline-block;">
                                        <p style="font-size: 12px; font-weight: bold; color: gray; margin-bottom:3px">
                                            {{ $audio->user->name ?? 'Unknown' }} |
                                            {{ \Carbon\Carbon::parse($audio->created_at)->format('d-M-Y h:i A') }}
                                        </p>
                                        <audio src="{{ asset($audio->path) }}" controls preload="metadata"
                                            style="width: 330px; border-radius: 6px;" controlslist="nodownload"
                                            type="audio/mp3">
                                        </audio>
                                        <button class="delete-media" data-id="{{ $audio->id }}"
                                            style="position:absolute; top:57px; right:0px; background: red; color: white; border: none; padding: 2px; border-radius: 50%; cursor: pointer;">
                                            🗑️
                                        </button>
                                    </div>
                                @empty
                                    <p style="grid-column: span 2; font-size: 14px; font-weight: bold; color: gray;">No
                                        audios found</p>
                                @endforelse  --}}
                            </div>
                        </div>

                    </div>
                </div>
            </ul>
        </li>
        {{--  <li class="inside-bar-item" id="app-btn">
            <img src="{{ asset('svg/app.svg') }}" alt="">
            <p class="inside-bar-text">App</p>
            <ul class="app-submenu" id="app-submenu">
                <li>
                    <img src="./images/google-calender.png" style="width: 70px; height: 70px;" alt=""
                        srcset="">
                    <p style="font-size: 12px; width: 100px; margin: 2px;">Google Calender</p>
                </li>
                <li>
                    <img src="./images/dropbox.png" style="width: 60px; height: 60px; margin-bottom: 12px;"
                        alt="" srcset="">
                    <p style="font-size: 12px; width: 100px;">Dropbox</p>
                </li>
            </ul>
        </li>  --}}
        <li class="inside-bar-item" id="more-btn" style="display:none">
            <img src="{{ asset('svg/more.svg') }}" alt="">
            <div class="more-wrapper">
                <p class="inside-bar-text">More</p>
                <ul class="more-submenu" id="more-submenu">
                    <li>
                        <img src="{{ asset('svg/invite-user.svg') }}" alt="">
                        <p style="font-size: 12px; width: 70px;">Invite User</p>
                    </li>
                    <li>
                        <img src="{{ asset('svg/plugins.svg') }}" alt="">
                        <p style="font-size: 12px; width: 70px;">Plugins</p>
                    </li>
                    <li>
                        <img src="{{ asset('svg/slack.svg') }}" alt="">
                        <p style="font-size: 12px; width: 70px;">Slack</p>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>
<!-- Chatify Modal -->
<div class="modal fade" id="chatifyModal" tabindex="-1" aria-labelledby="chatifyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chatifyModalLabel">Chat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="height: 600px; padding:0;">
        {{-- <iframe src="{{ route('chatify') }}" style="width:100%; height:100%; border:none;"></iframe> --}}
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // 🔥 Firebase Config
    const firebaseConfig = {
        apiKey: "AIzaSyCPhDUFImI8o_8OsD9oNLN6uBTEyOWjQG4",
        authDomain: "unit-1c26a.firebaseapp.com",
        databaseURL: "https://unit-1c26a-default-rtdb.firebaseio.com",
        projectId: "unit-1c26a",
        storageBucket: "unit-1c26a.appspot.com",
        messagingSenderId: "365981941063",
        appId: "1:365981941063:web:0af4eee5ba1542042a2062"
    };

    firebase.initializeApp(firebaseConfig);
    const db = firebase.database();

    const sender_id = {{ auth()->id() ?? 1 }};
    let receiver_id = null;
    const messagesDiv = document.getElementById("messages");
    const chatInput = document.querySelector(".chat-input");
    chatInput.style.display = "none"; // hide chat input initially

    // 🟢 Track Online Status
    const userStatusRef = db.ref(`/status/${sender_id}`);
    const connectedRef = db.ref(".info/connected");
    connectedRef.on("value", snap => {
        if (!snap.val()) return;
        userStatusRef.onDisconnect().set(false);
        userStatusRef.set(true);
    });

    // 🟢 Dropdown Elements
    const chatDropdown = document.getElementById("chatDropdown");
    const openBtn = document.getElementById("openChatBtn");
    const closeBtn = document.getElementById("closeDropdown");

    // 🟢 Toggle Dropdown
    openBtn.addEventListener("click", () => {
        chatDropdown.style.display = chatDropdown.style.display === "block" ? "none" : "block";
        loadUsers();
    });
    closeBtn.addEventListener("click", () => chatDropdown.style.display = "none");

    // 📨 Send Message
    document.getElementById("sendBtn45").addEventListener("click", sendMessage);
    document.getElementById("message").addEventListener("keypress", e => {
        if (e.key === "Enter") sendMessage();
    });

    function sendMessage() {
        const message = document.getElementById("message").value.trim();
        if (!message || !receiver_id) {
            alert("Please select a user and type a message!");
            return;
        }

        const newMsgRef = db.ref("messages").push();
        newMsgRef.set({
            sender_id,
            receiver_id,
            message,
            type: "text",
            read: false,
            delivered: false,
            timestamp: Date.now()
        }).then(() => document.getElementById("message").value = "")
          .catch(err => alert("Failed to send message!"));
    }

    // 📎 File Upload
    document.getElementById("uploadBtn").addEventListener("click", () => {
        document.getElementById("fileInput").click();
    });

fileInput.addEventListener("change", function(e) {
    const file = e.target.files[0];
    if (!file || !receiver_id) {
        alert("Select a user first!");
        return;
    }

    const formData = new FormData();
    formData.append("file", file);
    formData.append("sender_id", sender_id);
    formData.append("receiver_id", receiver_id);

    // Temporary "Uploading..." message
    const tempKey = "temp_" + Date.now();
    renderMessage({ sender_id, receiver_id, message: "Uploading file...", key: tempKey, type: "file", local: true });

    fetch("/chat/send", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        // Remove temp message
        document.querySelector(`[data-key='${tempKey}']`)?.remove();

        if (!data.success) {
            alert("Upload failed!");
        }
        // **Do NOT call renderMessage here for the uploaded file**
        // Firebase will push it and render automatically
    })
    .catch(err => {
        document.querySelector(`[data-key='${tempKey}']`)?.remove();
        alert("Error uploading file");
    });

    fileInput.value = ""; // reset input
});


    // 🟣 Listen Firebase for new messages
db.ref("messages").on("child_added", snapshot => {
    const msg = snapshot.val();
    const key = snapshot.key;

    if ((msg.sender_id == sender_id && msg.receiver_id == receiver_id) ||
        (msg.sender_id == receiver_id && msg.receiver_id == sender_id)) {
        renderMessage({ ...msg, key });
    }

    // Mark messages as read/delivered if I am the receiver
    if (msg.receiver_id == sender_id && !msg.read) {
        db.ref("messages/" + key).update({ read: true, delivered: true });
    }

    // Update badges
    if (msg.receiver_id == sender_id && !msg.read) {
        const badge = document.getElementById("badge-" + msg.sender_id);
        const userDiv = document.querySelector(`.user[data-id='${msg.sender_id}']`);
        if (badge) {
            badge.textContent = (parseInt(badge.textContent) || 0) + 1;
            badge.style.display = "inline-block";
            userDiv.classList.add("has-unread");
            updateMainBadge();
        }
    }
});


    // ✅ AJAX Load Users
    function loadUsers() {
        const loader = document.getElementById("userLoader");
        loader.style.display = "block";

        fetch("{{ route('chat.users') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(res => res.json())
        .then(users => {
            const userList = document.getElementById("userList");
            userList.innerHTML = "";
            loader.style.display = "none";

            if (!Array.isArray(users) || users.length === 0) {
                userList.innerHTML = "<em>No users found</em>";
                return;
            }

            users.forEach(user => {
                const userDiv = document.createElement("div");
                userDiv.className = "user";
                userDiv.setAttribute("data-id", user.id);
                userDiv.innerHTML = `
                    <span class="name">${user.name}</span>
                    <span class="badge" id="badge-${user.id}">0</span>
                `;
            // Inside user click event
userDiv.addEventListener("click", function() {
    document.querySelectorAll(".user").forEach(u => u.classList.remove("active"));
    this.classList.add("active");

    receiver_id = this.getAttribute("data-id");
    const userName = this.querySelector(".name").textContent;

    // Show messages and top bar
    messagesDiv.style.display = "block";                // show messages div
    chatInput.style.display = "flex";                  // show input
    document.getElementById("chatTopbar").style.display = "flex"; // show top bar
    document.getElementById("chatTopbarName").textContent = userName; // set user name

    messagesDiv.innerHTML = "<em>Loading chat...</em>";
    clearUnreadBadge(receiver_id);
    loadMessages();
});


                userList.appendChild(userDiv);
            });

            updateUserOnlineStatus();
        })
        .catch(err => loader.innerHTML = "<em>Error loading users</em>");
    }

    // 🟢 Update online indicators
    function updateUserOnlineStatus() {
        db.ref("status").once("value", snapshot => {
            const statusData = snapshot.val() || {};
            document.querySelectorAll(".user").forEach(u => {
                const id = u.getAttribute("data-id");
                u.classList.toggle("online", !!statusData[id]);
            });
        });
    }

    // 🟢 Load Messages
function loadMessages() {
    db.ref("messages").off("value"); // remove old listener
    db.ref("messages").on("value", snapshot => {
        messagesDiv.innerHTML = ""; // clear messages

        let lastMessageKey = null; // store the last message key

        snapshot.forEach(childSnap => {
            const data = childSnap.val();
            const key = childSnap.key;

            if ((data.sender_id == sender_id && data.receiver_id == receiver_id) ||
                (data.sender_id == receiver_id && data.receiver_id == sender_id)) {
                renderMessage({ ...data, key });
                lastMessageKey = key; // update last message
            }

            // Mark unread as seen if I am receiver
            if (data.receiver_id == sender_id && !data.read) {
                db.ref("messages/" + key).update({ read: true, delivered: true });
            }
        });

        // Scroll to last message
        if (lastMessageKey) {
            const lastMsgDiv = messagesDiv.querySelector(`[data-key='${lastMessageKey}']`);
            if (lastMsgDiv) lastMsgDiv.scrollIntoView({ behavior: "smooth" });
        }


    });
}



    // 🟢 Render Message
function renderMessage(msg) {
    const isMe = msg.sender_id == sender_id;
    const msgClass = isMe ? "message me" : "message";
    let content = "";

    if (msg.type === "file") {
        if (msg.filetype && msg.filetype.startsWith("image/")) {
            content = `<img src="${msg.message}" class="chat-image">`;
        } else {
            content = `<a href="${msg.message}" target="_blank">${msg.filename || 'Download file'}</a>`;
        }
    } else {
        content = `<div class="text">${msg.message}</div>`;
    }

    const html = `<div class="${msgClass}" data-key="${msg.key}">${content}</div>`;
    messagesDiv.insertAdjacentHTML("beforeend", html);

    // Scroll to bottom
    messagesDiv.lastElementChild?.scrollIntoView({ behavior: "smooth" });
}



    // 🟢 Helpers
    function clearUnreadBadge(id) {
        const badge = document.getElementById("badge-" + id);
        const userDiv = document.querySelector(`.user[data-id='${id}']`);
        if (badge) {
            badge.textContent = "0";
            badge.style.display = "none";
            userDiv.classList.remove("has-unread");
            updateMainBadge();
        }
    }

    function updateMainBadge() {
        let totalUnread = 0;
        document.querySelectorAll(".badge").forEach(b => totalUnread += parseInt(b.textContent) || 0);
        const mainBadge = document.getElementById("mainBadge");
        if (totalUnread > 0) {
            mainBadge.textContent = totalUnread;
            mainBadge.style.display = "inline-block";
        } else {
            mainBadge.style.display = "none";
        }
    }

});
</script>
