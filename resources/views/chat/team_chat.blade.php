<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel + Firebase Group Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database-compat.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 30px; }

        /* Team Buttons Container */
        #teamButtonsContainer {
            display: flex; 
            flex-wrap: wrap; 
            gap: 10px; 
            margin-bottom: 20px;
        }

        .team {
            position: relative; 
            padding: 10px 20px; 
            background: #007bff; 
            color: white; 
            border: none; 
            border-radius: 25px; 
            cursor: pointer; 
            white-space: nowrap; 
            transition: all 0.3s; 
        }
        .team:hover { background: #0056b3; }
        .team.active { background: #28a745; }

        .badge { 
            position: absolute; 
            top: -5px; 
            right: -5px; 
            background: red; 
            color: #fff; 
            border-radius: 50%; 
            font-size: 12px; 
            padding: 2px 6px; 
            display: none; 
        }
        .team.has-unread .badge { display: inline-block; }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0;
            width: 100%; height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 12px;
            width: fit-content;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            position: relative;
        }

        .close { color: #aaa; float: right; font-size: 24px; font-weight: bold; cursor: pointer; }
        .close:hover { color: black; }

        .chat-box { background: #fff; padding: 20px; border-radius: 10px; width: 520px; }

        .messages { 
            height: 320px; 
            overflow-y: auto; 
            border: 1px solid #ddd; 
            padding: 10px; 
            margin-bottom: 10px; 
            background: #fafafa;
        }

        .message { display: flex; flex-direction: column; margin-bottom: 8px; }
        .message.me { align-items: flex-end; }
        .status { font-size: 10px; margin-top: 2px; color: #555; }
        img.chat-image { max-width: 180px; border-radius: 6px; display: block; margin: 5px 0; }

        #fileInput { display:none; }
    </style>
</head>
<body>

    <!-- All Teams as Buttons -->
    <div id="teamButtonsContainer"></div>

    <!-- Chat Modal -->
    <div id="chatModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>

            <div class="chat-box">
                <h3>Laravel + Firebase Group Chat</h3>

                <div id="messages" class="messages"><em>Select a team to start chatting...</em></div>

                <div>
                    <input type="file" id="fileInput" accept="image/*,application/pdf,application/msword,.docx,.xlsx,.txt">
                    <input type="text" id="message" placeholder="Type message..." style="width:65%; padding:6px;">
                    <button id="uploadBtn" style="padding:6px 12px;">📎</button>
                    <button id="sendBtn" style="padding:6px 12px;">Send</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Firebase config
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

        // Online status
        const userStatusRef = db.ref(`/status/${sender_id}`);
        const connectedRef = db.ref(".info/connected");
        connectedRef.on("value", snapshot => {
            if (!snapshot.val()) return;
            userStatusRef.onDisconnect().set(false);
            userStatusRef.set(true);
        });

        // Modal open/close
        const modal = document.getElementById("chatModal");
        const closeModal = document.getElementById("closeModal");
        closeModal.onclick = () => modal.style.display = "none";
        window.onclick = e => { if(e.target == modal) modal.style.display = "none"; }

        // Load Teams
        function loadTeams() {
            fetch("{{ route('chat.teams') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(teams => {
                const container = document.getElementById("teamButtonsContainer");
                container.innerHTML = "";

                teams.forEach(team => {
                    const btn = document.createElement("button");
                    btn.className = "team";
                    btn.setAttribute("data-id", team.id);
                    btn.innerHTML = `${team.team_name} <span class="badge" id="badge-${team.id}">0</span>`;

                    btn.addEventListener("click", function() {
                        document.querySelectorAll(".team").forEach(t => t.classList.remove("active"));
                        this.classList.add("active");

                        currentTeamId = this.getAttribute("data-id");
                        messagesDiv.innerHTML = "<em>Loading chat...</em>";
                        clearUnreadBadge(currentTeamId);

                        modal.style.display = "block";
                        loadGroupMessages();
                    });
                    container.appendChild(btn);
                });

                updateTeamOnlineStatus();
            })
            .catch(console.error);
        }

        function updateTeamOnlineStatus() {
            db.ref("status").once("value", snapshot => {
                const statusData = snapshot.val() || {};
            });
        }

        // Load Group Messages
        function loadGroupMessages() {
            db.ref("group_messages/" + currentTeamId).off();
            const ref = db.ref("group_messages/" + currentTeamId);
            messagesDiv.innerHTML = "";

            ref.on("child_added", snapshot => {
                const data = snapshot.val();
                if (!data || !data.message) return;
                const key = snapshot.key;
                renderMessage({ ...data, key });

                if (!data.read_by || !data.read_by[sender_id]) {
                    db.ref(`group_messages/${currentTeamId}/${key}/read_by`).update({ [sender_id]: true });
                }
            });
        }

        // Send Text Message
        document.getElementById("sendBtn").addEventListener("click", sendMessage);
        document.getElementById("message").addEventListener("keypress", e => { if(e.key==="Enter") sendMessage(); });

        function sendMessage() {
            const message = document.getElementById("message").value.trim();
            if(!message || !currentTeamId) return alert("Select team and type a message!");

            const msgData = { sender_id, message, timestamp: Date.now(), delivered: false, read_by:{[sender_id]:true} };
            const tempKey = "temp_" + Date.now();
            renderMessage({ ...msgData, key: tempKey, local:true });

            fetch("/chat/send-group-message", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ sender_id, team_id: currentTeamId, message })
            }).then(() => {
                document.querySelector(`[data-key='${tempKey}']`)?.remove();
                document.getElementById("message").value = "";
            }).catch(console.error);
        }

        // File Upload
        document.getElementById("uploadBtn").addEventListener("click", () => document.getElementById("fileInput").click());
        document.getElementById("fileInput").addEventListener("change", function(e) {
            const file = e.target.files[0];
            if(!file || !currentTeamId) return alert("Select team first!");

            const formData = new FormData();
            formData.append("file", file);
            formData.append("sender_id", sender_id);
            formData.append("team_id", currentTeamId);

            const tempKey = "temp_" + Date.now();
            renderMessage({ sender_id, message:"Uploading file...", key:tempKey, type:"file", local:true });

            fetch("/chat/send-group-file", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content },
                body: formData
            })
            .then(res=>res.json())
            .then(data=>{ if(data.success) document.querySelector(`[data-key='${tempKey}']`)?.remove(); else alert("Upload failed!") })
            .catch(()=>alert("Error uploading file"));
        });

        // Render Message
        // Render Message
function renderMessage(msg){
    const isMe = msg.sender_id == sender_id;
    const senderLabel = isMe ? "Me" : (msg.sender_name || `User ID: ${msg.sender_id}`);
    let content = "";

    if(msg.type==="file"){
        if(msg.message.match(/\.(jpeg|jpg|gif|png|webp)$/i)) content = `<img src="${msg.message}" class="chat-image" alt="Image">`;
        else content = `<a href="${msg.message}" target="_blank">${msg.filename||'Download file'}</a>`;
    } else content = `<div class="text">${msg.message}</div>`;

    const html = `<div class="message ${isMe?'me':''}" data-key="${msg.key}">
        <strong>${senderLabel}</strong>
        ${content}
        <div class="status">${msg.local?'<small>Sending...</small>':''}</div>
    </div>`;
    messagesDiv.insertAdjacentHTML("beforeend", html);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}


        function clearUnreadBadge(id){
            const badge = document.getElementById("badge-"+id);
            const teamDiv = document.querySelector(`.team[data-id='${id}']`);
            if(badge){ badge.textContent="0"; badge.style.display="none"; teamDiv.classList.remove("has-unread"); }
        }

        // Realtime unread
        db.ref("group_messages").on("child_added", snapshot=>handleNewMessages(snapshot));
        db.ref("group_messages").on("child_changed", snapshot=>handleNewMessages(snapshot));

        function handleNewMessages(snapshot){
            const teamId = snapshot.key;
            if(teamId===currentTeamId) return;

            snapshot.forEach(msgSnap=>{
                const msg=msgSnap.val();
                if(!msg||!msg.message) return;
                if(msg.sender_id!==sender_id && (!msg.read_by||!msg.read_by[sender_id])){
                    const badge=document.getElementById("badge-"+teamId);
                    const teamDiv=document.querySelector(`.team[data-id='${teamId}']`);
                    if(badge && teamDiv){
                        const count = parseInt(badge.textContent)||0;
                        badge.textContent = count+1;
                        badge.style.display="inline-block";
                        teamDiv.classList.add("has-unread");
                    }
                }
            });
        }

        document.addEventListener("DOMContentLoaded", loadTeams);
    </script>
</body>
</html>
