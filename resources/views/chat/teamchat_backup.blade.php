{{--  <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel + Firebase Group Chat (Text & File Upload)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database-compat.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body { font-family: Arial; background: #f4f6f8; padding: 30px; }
        .chat-box { background: #fff; padding: 20px; border-radius: 12px; width: 520px; margin: auto; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }

        .team-list {
            display: flex;
            overflow-x: auto; 
            gap: 10px;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 8px;
        }

        .team {
            background: #f0f0f0;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
            white-space: nowrap;
            position: relative;
        }

        .team:hover { background: #e2e2e2; }
        .team.active { background: #007bff; color: #fff; }
.message {
    display: flex;
    flex-direction: column; /* stack content vertically */
    margin-bottom: 8px;
}

.message.me {
    align-items: flex-end; /* push content to the right */
}

.message img.chat-image {
    max-width: 180px;
    border-radius: 6px;
    margin: 5px 0;
}

.status {
    font-size: 10px;
    margin-top: 2px;
    color: #555;
}
        .badge {
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

        .team.has-unread .badge { display: inline-block; }

        .messages {
            height: 320px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background: #fafafa;
        }

        .message { margin-bottom: 8px; }
        .message.me { text-align: right; color: #007bff; }

        .status small { font-size: 10px; color: #777; }

        .tick { font-size: 12px; margin-left: 5px; }
        .tick.read { color: #0b93f6; }
        .tick.delivered { color: #999; }

        img.chat-image { max-width: 180px; border-radius: 6px; display: block; margin: 5px 0; }

        .loading { text-align: center; color: #555; font-style: italic; padding: 10px; }
    </style>
</head>
<body>

<div class="chat-box">
    <h3>Laravel + Firebase Group Chat</h3>

    <!-- ✅ Team List -->
    <div class="team-list" id="teamList">
        @foreach ($teams as $team)
            <div class="team" data-id="{{ $team->id }}">
                <span class="name">{{ $team->team_name }}</span>
                <span class="badge" id="badge-{{ $team->id }}">0</span>
            </div>
        @endforeach
    </div>

    <div id="messages" class="messages"><em>Select a team to start chatting...</em></div>

    <div>
        <input type="file" id="fileInput" style="display:none;" accept="image/*,application/pdf,application/msword,.docx,.xlsx,.txt">
        <input type="text" id="message" placeholder="Type message..." style="width:65%; padding:6px;">
        <button id="uploadBtn" style="padding:6px 12px;">📎</button>
        <button id="sendBtn" style="padding:6px 12px;">Send</button>
    </div>
</div>

<script>
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

    const sender_id = {{ auth()->id() }};
    let currentTeamId = null;
    const messagesDiv = document.getElementById("messages");

    // 👥 Select team
    document.querySelectorAll(".team").forEach(teamDiv => {
        teamDiv.addEventListener("click", function() {
            document.querySelectorAll(".team").forEach(t => t.classList.remove("active"));
            this.classList.add("active");
            currentTeamId = this.getAttribute("data-id");
            messagesDiv.innerHTML = `<div class="loading">Loading messages...</div>`;
            clearUnreadBadge(currentTeamId);
            loadGroupMessages();
        });
    });

    // 🔁 Load group messages
    function loadGroupMessages() {
        db.ref("group_messages/" + currentTeamId).off();
        const ref = db.ref("group_messages/" + currentTeamId);
        messagesDiv.innerHTML = "";

        ref.on("child_added", snapshot => {
            const data = snapshot.val();
            if (!data || !data.message) return;
            const key = snapshot.key;
            renderMessage({ ...data, key });

            // Mark as read
            if (!data.read_by || !data.read_by[sender_id]) {
                db.ref(`group_messages/${currentTeamId}/${key}/read_by`).update({ [sender_id]: true });
            }
        });
    }

    // 🟢 Send Text Message
    document.getElementById("sendBtn").addEventListener("click", sendMessage);
    document.getElementById("message").addEventListener("keypress", e => { if(e.key==='Enter') sendMessage(); });

    function sendMessage() {
        const message = document.getElementById("message").value.trim();
        if (!message || !currentTeamId) return alert("Select a team first!");

        const msgData = {
            sender_id,
            message,
            timestamp: Date.now(),
            delivered: false,
            read_by: { [sender_id]: true }
        };

        const tempKey = "temp_" + Date.now();
        renderMessage({ ...msgData, key: tempKey, local: true });

        fetch("/chat/send-group-message", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ sender_id, team_id: currentTeamId, message })
        })
        .then(res => res.json())
        .then(() => {
            document.querySelector(`[data-key='${tempKey}']`)?.remove();
            document.getElementById("message").value = "";
        });
    }

    // 📎 File Upload
    document.getElementById("uploadBtn").addEventListener("click", () => document.getElementById("fileInput").click());

    document.getElementById("fileInput").addEventListener("change", function(e) {
        const file = e.target.files[0];
        if (!file || !currentTeamId) return alert("Select a team first!");

        const formData = new FormData();
        formData.append("file", file);
        formData.append("sender_id", sender_id);
        formData.append("team_id", currentTeamId);

        const tempKey = "temp_" + Date.now();
        renderMessage({ sender_id, message: "Uploading file...", key: tempKey, type: "file", local: true });

        fetch("/chat/send-group-file", {
            method: "POST",
            headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) document.querySelector(`[data-key='${tempKey}']`)?.remove();
            else alert("Upload failed!");
        }).catch(err => { console.error(err); alert("Error uploading file"); });
    });

    // 🧩 Render Message (text or file)
    function renderMessage(msg) {
    const isMe = msg.sender_id == sender_id;
    const msgClass = isMe ? "message me" : "message";
    let content = "";

    if(msg.type==="file") {
        // Check if it's an image
        if(msg.message.match(/\.(jpeg|jpg|gif|png|webp)$/i)) {
            content = `<img src="${msg.message}" class="chat-image">`;
            // Optionally show filename below image
            if(msg.filename) content += `<div><small>${msg.filename}</small></div>`;
        } else {
            content = `<a href="${msg.message}" target="_blank">${msg.filename || 'Download file'}</a>`;
        }
    } else {
        content = `<div class="text">${msg.message}</div>`;
    }

    const html = `<div class="${msgClass}" data-key="${msg.key}">
                    ${content}
                    ${isMe ? `<div class="status">${msg.local?'<small>Sending...</small>':'<small>Sent</small>'}</div>` : ""}
                </div>`;
    messagesDiv.insertAdjacentHTML("beforeend", html);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}


    // 🔔 Realtime unread badge update
    db.ref("group_messages").on("child_added", snapshot => handleNewMessages(snapshot));
    db.ref("group_messages").on("child_changed", snapshot => handleNewMessages(snapshot));

    function handleNewMessages(snapshot) {
        const teamId = snapshot.key;
        if(teamId===currentTeamId) return;

        snapshot.forEach(msgSnap=>{
            const msg = msgSnap.val();
            if(!msg || !msg.message) return;
            if(msg.sender_id!==sender_id && (!msg.read_by || !msg.read_by[sender_id])){
                const badge = document.getElementById("badge-" + teamId);
                const teamDiv = document.querySelector(`.team[data-id='${teamId}']`);
                if(badge && teamDiv){
                    const count = parseInt(badge.textContent) || 0;
                    badge.textContent = count + 1;
                    badge.style.display = "inline-block";
                    teamDiv.classList.add("has-unread");
                }
            }
        });
    }

    function clearUnreadBadge(id) {
        const badge = document.getElementById("badge-" + id);
        const teamDiv = document.querySelector(`.team[data-id='${id}']`);
        if(badge) { badge.textContent="0"; badge.style.display="none"; teamDiv.classList.remove("has-unread"); }
    }
</script>

</body>
</html>  --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel + Firebase Group Chat (Modal Version)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database-compat.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 30px; }

        /* 🔘 Chat open button */
        #openChatBtn {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            position: relative; 
        }
        #openChatBtn:hover { background: #0056b3; }

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
        .chat-box { background: #fff; padding: 20px; border-radius: 10px; width: 520px; margin: auto; }
        
        .team-list { 
            display: flex; 
            overflow-x: auto; 
            gap: 10px; 
            margin-bottom: 15px; 
            padding-bottom: 5px; 
            border-bottom: 1px solid #ddd; 
        }

        .team { 
            position: relative; 
            padding: 8px 15px; 
            background: #f0f0f0; 
            border-radius: 20px; 
            cursor: pointer; 
            white-space: nowrap; 
            transition: all 0.3s; 
        }
        .team:hover { background: #e2e2e2; }
        .team.active { background: #007bff; color: #fff; }

        .message { display: flex; flex-direction: column; margin-bottom: 8px; }
        .message.me { align-items: flex-end; }
        .message img.chat-image { max-width: 180px; border-radius: 6px; margin: 5px 0; }
        .status { font-size: 10px; margin-top: 2px; color: #555; }

        .badge { 
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
        .team.has-unread .badge { display: inline-block; }

        .messages { 
            height: 320px; 
            overflow-y: auto; 
            border: 1px solid #ddd; 
            padding: 10px; 
            margin-bottom: 10px; 
            background: #fafafa;
        }

        .tick { font-size: 12px; margin-left: 5px; }
        .tick.read { color: #0b93f6; }
        .tick.delivered { color: #999; }

        img.chat-image { max-width: 180px; border-radius: 6px; display: block; margin: 5px 0; }

        /* Loader */
        #teamLoader {
            width: 100%;
            text-align: center;
            padding: 10px;
            display: none;
        }

        .loading { text-align: center; color: #555; font-style: italic; padding: 10px; }
    </style>
</head>
<body>

    <!-- 🔘 Open Chat Button -->
    <button id="openChatBtn">
        💬 Open Group Chat
        <span id="mainBadge">0</span>
    </button>

    <!-- 💬 Modal -->
    <div id="chatModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>

            <!-- ✅ Chat Box -->
            <div class="chat-box">
                <h3>Laravel + Firebase Group Chat</h3>

                <div id="teamLoader"><em>Loading teams...</em></div>
                <div class="team-list" id="teamList"></div>

                <div id="messages" class="messages"><em>Select a team to start chatting...</em></div>

                <div>
                    <input type="file" id="fileInput" style="display:none;" accept="image/*,application/pdf,application/msword,.docx,.xlsx,.txt">
                    <input type="text" id="message" placeholder="Type message..." style="width:65%; padding:6px;">
                    <button id="uploadBtn" style="padding:6px 12px;">📎</button>
                    <button id="sendBtn" style="padding:6px 12px;">Send</button>
                </div>
            </div>
        </div>
    </div>

    <script>
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

        const sender_id = {{ auth()->id() }};
        let currentTeamId = null;
        const messagesDiv = document.getElementById("messages");

        // 🟢 Track Online Status (same as single chat)
        const userStatusRef = db.ref(`/status/${sender_id}`);
        const connectedRef = db.ref(".info/connected");
        connectedRef.on("value", snapshot => {
            if (!snapshot.val()) return;
            userStatusRef.onDisconnect().set(false);
            userStatusRef.set(true);
        });

        // 🟣 Modal open/close logic (same as single chat)
        const modal = document.getElementById("chatModal");
        const btn = document.getElementById("openChatBtn");
        const span = document.getElementById("closeModal");

        btn.onclick = function() {
            modal.style.display = "block";
            loadTeams(); // 🟢 Load teams when modal opens
        }

        span.onclick = function() { modal.style.display = "none"; }
        window.onclick = function(event) {
            if (event.target == modal) modal.style.display = "none";
        }

        // ✅ AJAX load teams (similar to loadUsers in single chat)
        function loadTeams() {
            const loader = document.getElementById("teamLoader");
            loader.style.display = "block";

            fetch("{{ route('chat.teams') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(teams => {
                const teamList = document.getElementById("teamList");
                teamList.innerHTML = "";
                loader.style.display = "none";

                teams.forEach(team => {
                    const teamDiv = document.createElement("div");
                    teamDiv.className = "team";
                    teamDiv.setAttribute("data-id", team.id);
                    teamDiv.innerHTML = `
                        <span class="name">${team.team_name}</span>
                        <span class="badge" id="badge-${team.id}">0</span>
                    `;
                    teamDiv.addEventListener("click", function() {
                        document.querySelectorAll(".team").forEach(t => t.classList.remove("active"));
                        this.classList.add("active");
                        currentTeamId = this.getAttribute("data-id");
                        messagesDiv.innerHTML = "<em>Loading chat...</em>";
                        clearUnreadBadge(currentTeamId);
                        loadGroupMessages();
                    });
                    teamList.appendChild(teamDiv);
                });

                updateTeamOnlineStatus();
            })
            .catch(err => {
                console.error("Error loading teams:", err);
                loader.innerHTML = "<em>Error loading teams</em>";
            });
        }

        // 🟢 Refresh online indicators (similar to single chat)
        function updateTeamOnlineStatus() {
            db.ref("status").once("value", snapshot => {
                const statusData = snapshot.val() || {};
                // You might want to show team member online status differently
                // This is kept for consistency with single chat structure
                document.querySelectorAll(".team").forEach(t => {
                    // Team online status logic can be customized here
                });
            });
        }

        // 🔁 Load group messages
        function loadGroupMessages() {
            db.ref("group_messages/" + currentTeamId).off();
            const ref = db.ref("group_messages/" + currentTeamId);
            messagesDiv.innerHTML = "";

            ref.on("child_added", snapshot => {
                const data = snapshot.val();
                if (!data || !data.message) return;
                const key = snapshot.key;
                renderMessage({ ...data, key });

                // Mark as read
                if (!data.read_by || !data.read_by[sender_id]) {
                    db.ref(`group_messages/${currentTeamId}/${key}/read_by`).update({ [sender_id]: true });
                }
            });
        }

        // 🟢 Send Text Message (same alert pattern)
        document.getElementById("sendBtn").addEventListener("click", sendMessage);
        document.getElementById("message").addEventListener("keypress", e => {
            if (e.key === "Enter") sendMessage();
        });

        function sendMessage() {
            const message = document.getElementById("message").value.trim();
            if (!message || !currentTeamId) {
                alert("Please select a team and type a message!");
                return;
            }

            const msgData = {
                sender_id,
                message,
                timestamp: Date.now(),
                delivered: false,
                read_by: { [sender_id]: true }
            };

            const tempKey = "temp_" + Date.now();
            renderMessage({ ...msgData, key: tempKey, local: true });

            fetch("/chat/send-group-message", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ sender_id, team_id: currentTeamId, message })
            })
            .then(res => res.json())
            .then(() => {
                document.querySelector(`[data-key='${tempKey}']`)?.remove();
                document.getElementById("message").value = "";
            })
            .catch(console.error);
        }

        // 📎 File Upload (same alert pattern)
        document.getElementById("uploadBtn").addEventListener("click", () => {
            document.getElementById("fileInput").click();
        });

        document.getElementById("fileInput").addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (!file || !currentTeamId) {
                alert("Please select a team before sending a file!");
                return;
            }

            const formData = new FormData();
            formData.append("file", file);
            formData.append("sender_id", sender_id);
            formData.append("team_id", currentTeamId);

            const tempKey = "temp_" + Date.now();
            renderMessage({ sender_id, message: "Uploading file...", key: tempKey, type: "file", local: true });

            fetch("/chat/send-group-file", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.querySelector(`[data-key='${tempKey}']`)?.remove();
                } else {
                    alert("Upload failed!");
                }
            })
            .catch(err => {
                console.error("Error:", err);
                alert("Error uploading file");
            });
        });

        // 🧩 Render Message (text or file)
        function renderMessage(msg) {
            const isMe = msg.sender_id == sender_id;
            const msgClass = isMe ? "message me" : "message";
            const statusText = getStatusText(msg);

            let content = "";
            if (msg.type === "file") {
                if (msg.message.match(/\.(jpeg|jpg|gif|png|webp)$/i)) {
                    content = `<img src="${msg.message}" class="chat-image" alt="Image">`;
                    if (msg.filename) content += `<div><small>${msg.filename}</small></div>`;
                } else {
                    content = `<a href="${msg.message}" target="_blank">${msg.filename || 'Download file'}</a>`;
                }
            } else {
                content = `<div class="text">${msg.message}</div>`;
            }

            const html = `
                <div class="${msgClass}" data-key="${msg.key}">
                    ${content}
                    <div class="status">${isMe ? `${statusText}` : ""}</div>
                </div>
            `;
            messagesDiv.insertAdjacentHTML("beforeend", html);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }

        function getStatusText(msg) {
            if (msg.local) return "<small>Sending...</small>";
            if (msg.delivered && !msg.read) return "<small>Delivered</small>";
            if (msg.read) return "<small>Seen</small>";
            return "<small>Sent</small>";
        }

        // 🔔 Realtime unread badge update
        db.ref("group_messages").on("child_added", snapshot => handleNewMessages(snapshot));
        db.ref("group_messages").on("child_changed", snapshot => handleNewMessages(snapshot));

        function handleNewMessages(snapshot) {
            const teamId = snapshot.key;
            if (teamId === currentTeamId) return;

            snapshot.forEach(msgSnap => {
                const msg = msgSnap.val();
                if (!msg || !msg.message) return;
                if (msg.sender_id !== sender_id && (!msg.read_by || !msg.read_by[sender_id])) {
                    const badge = document.getElementById("badge-" + teamId);
                    const teamDiv = document.querySelector(`.team[data-id='${teamId}']`);
                    if (badge && teamDiv) {
                        const count = parseInt(badge.textContent) || 0;
                        badge.textContent = count + 1;
                        badge.style.display = "inline-block";
                        teamDiv.classList.add("has-unread");
                        updateMainBadge();
                    }
                }
            });
        }

        function clearUnreadBadge(id) {
            const badge = document.getElementById("badge-" + id);
            const teamDiv = document.querySelector(`.team[data-id='${id}']`);
            if (badge) {
                badge.textContent = "0";
                badge.style.display = "none";
                teamDiv.classList.remove("has-unread");
                updateMainBadge();
            }
        }

        function updateMainBadge() {
            let totalUnread = 0;
            document.querySelectorAll(".badge").forEach(b => {
                totalUnread += parseInt(b.textContent) || 0;
            });

            const mainBadge = document.getElementById("mainBadge");
            if (totalUnread > 0) {
                mainBadge.textContent = totalUnread;
                mainBadge.style.display = "inline-block";
            } else {
                mainBadge.style.display = "none";
            }
        }

        // Load teams on page load
        document.addEventListener("DOMContentLoaded", function() {
            loadTeams();
        });
    </script>
</body>
</html>