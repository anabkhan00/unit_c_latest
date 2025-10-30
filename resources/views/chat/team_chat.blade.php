<!DOCTYPE html>
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
</html>
