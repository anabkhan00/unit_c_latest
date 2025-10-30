<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel + Firebase Chat (Image/File Upload via Laravel Storage)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database-compat.js"></script>

    <!-- Font Awesome for ticks -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 30px; }
        .chat-box { background: #fff; padding: 20px; border-radius: 10px; width: 480px; margin: auto; }

        .user-list {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }
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

        .user {
            position: relative;
            padding: 8px 15px;
            background: #f0f0f0;
            border-radius: 20px;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.3s;
        }

        .user:hover { background: #e2e2e2; }
        .user.active { background: #007bff; color: #fff; }

        .online::before {
            content: "";
            position: absolute;
            left: 6px;
            top: 50%;
            transform: translateY(-50%);
            width: 10px;
            height: 10px;
            background: #28a745;
            border-radius: 50%;
            box-shadow: 0 0 0 2px #fff;
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

        .user.has-unread .badge { display: inline-block; }

        .messages {
            height: 320px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }

        .message { margin-bottom: 8px; }
        .message.me { text-align: right; color: #007bff; }

        .tick { font-size: 12px; margin-left: 5px; }
        .tick.read { color: #0b93f6; }
        .tick.delivered { color: #999; }

        img.chat-image {
            max-width: 180px;
            border-radius: 6px;
            display: block;
            margin: 5px 0;
        }
    </style>
</head>
<body>

<div class="chat-box">
    <h3>Laravel + Firebase Chat</h3>

    <!-- ✅ User List -->
    <div class="user-list" id="userList">
        <div class="row">
            @foreach ($users as $user)
            @if ($user->id !== auth()->id())
                <div class="row">
                    <div class="user" data-id="{{ $user->id }}">
                    <span class="name">{{ $user->name }}</span>
                    <span class="badge" id="badge-{{ $user->id }}">0</span>
                </div>
                </div>
            @endif
        @endforeach
        </div>
    </div>

    <div id="messages" class="messages"><em>Select a user to start chatting...</em></div>

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

    const sender_id = {{ auth()->id() ?? 1 }};
    let receiver_id = null;
    const messagesDiv = document.getElementById("messages");

    // 🟢 Track Online Status
    const userStatusRef = db.ref(`/status/${sender_id}`);
    const connectedRef = db.ref(".info/connected");
    connectedRef.on("value", snapshot => {
        if (!snapshot.val()) return;
        userStatusRef.onDisconnect().set(false);
        userStatusRef.set(true);
    });

    db.ref("status").on("value", snapshot => {
        const statusData = snapshot.val() || {};
        document.querySelectorAll(".user").forEach(u => {
            const id = u.getAttribute("data-id");
            u.classList.toggle("online", !!statusData[id]);
        });
    });

    // 📨 Send Text Message
    document.getElementById("sendBtn").addEventListener("click", sendMessage);
    document.getElementById("message").addEventListener("keypress", e => {
        if (e.key === "Enter") sendMessage();
    });

    function sendMessage() {
        const message = document.getElementById("message").value.trim();
        if (!message || !receiver_id) {
            alert("Please select a user and type a message!");
            return;
        }

        fetch("/chat/send", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                sender_id,
                receiver_id,
                message
            })
        })
        .then(res => res.json())
        .then(() => document.getElementById("message").value = "")
        .catch(console.error);
    }

    // 📎 File Upload via Laravel Storage
    document.getElementById("uploadBtn").addEventListener("click", () => {
        document.getElementById("fileInput").click();
    });

    document.getElementById("fileInput").addEventListener("change", function(e) {
        const file = e.target.files[0];
        if (!file || !receiver_id) {
            alert("Please select a user before sending a file!");
            return;
        }

        const formData = new FormData();
        formData.append("file", file);
        formData.append("sender_id", sender_id);
        formData.append("receiver_id", receiver_id);

        const tempKey = "temp_" + Date.now();
        renderMessage({
            sender_id,
            receiver_id,
            message: "Uploading file...",
            key: tempKey,
            type: "file",
            local: true
        });

        fetch("/chat/send", {
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

    // 🟣 Listen for new messages
    db.ref("messages").on("child_added", snapshot => {
        const msg = snapshot.val();
        const key = snapshot.key;

        if (
            (msg.sender_id == sender_id && msg.receiver_id == receiver_id) ||
            (msg.sender_id == receiver_id && msg.receiver_id == sender_id)
        ) {
            renderMessage({ ...msg, key });
        }

        // Update unread count
        if (msg.receiver_id == sender_id && !msg.read) {
            const badge = document.getElementById("badge-" + msg.sender_id);
            const userDiv = document.querySelector(`.user[data-id='${msg.sender_id}']`);
            if (badge) {
                badge.textContent = (parseInt(badge.textContent) || 0) + 1;
                badge.style.display = "inline-block";
                userDiv.classList.add("has-unread");
            }
        }

        if (receiver_id == msg.sender_id) {
            db.ref("messages/" + key).update({ read: true, delivered: true });
            clearUnreadBadge(msg.sender_id);
        }
    });

    // 👤 User selection
    document.querySelectorAll(".user").forEach(userDiv => {
        userDiv.addEventListener("click", function() {
            document.querySelectorAll(".user").forEach(u => u.classList.remove("active"));
            this.classList.add("active");

            receiver_id = this.getAttribute("data-id");
            messagesDiv.innerHTML = "<em>Loading chat...</em>";

            clearUnreadBadge(receiver_id);
            loadMessages();
        });
    });

    function loadMessages() {
        db.ref("messages").off("value");
        db.ref("messages").on("value", snapshot => {
            messagesDiv.innerHTML = "";
            snapshot.forEach(childSnap => {
                const data = childSnap.val();
                const key = childSnap.key;

                if (
                    (data.sender_id == sender_id && data.receiver_id == receiver_id) ||
                    (data.sender_id == receiver_id && data.receiver_id == sender_id)
                ) {
                    renderMessage({ ...data, key });
                }

                if (data.receiver_id == sender_id && !data.read) {
                    db.ref("messages/" + key).update({ read: true, delivered: true });
                }
            });
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        });
    }

    function renderMessage(msg) {
        const isMe = msg.sender_id == sender_id;
        const msgClass = isMe ? "message me" : "message";
        const tickHtml = getTickHtml(msg);
        const statusText = getStatusText(msg);

        let content = "";
        if (msg.type === "file") {
            if (msg.filetype && msg.filetype.startsWith("image/")) {
                content = `<img src="${msg.message}" class="chat-image" alt="Image">`;
            } else {
                content = `<a href="${msg.message}" target="_blank">${msg.filename || 'Download file'}</a>`;
            }
        } else {
            content = `<div class="text">${msg.message}</div>`;
        }

        const html = `
            <div class="${msgClass}" data-key="${msg.key}">
                ${content}
                <div class="status">${isMe ? `${tickHtml} ${statusText}` : ""}</div>
            </div>
        `;
        messagesDiv.insertAdjacentHTML("beforeend", html);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    function getTickHtml(msg) {
        if (!msg.delivered) return `<i class='fas fa-clock tick'></i>`;
        if (msg.delivered && !msg.read) return `<i class='fas fa-check-double tick delivered'></i>`;
        if (msg.read) return `<i class='fas fa-check-double tick read'></i>`;
        return `<i class='fas fa-check tick delivered'></i>`;
    }

    function getStatusText(msg) {
        if (!msg.delivered) return "<small>Sending...</small>";
        if (msg.delivered && !msg.read) return "<small>Delivered</small>";
        if (msg.read) return "<small>Seen</small>";
        return "";
    }

    function clearUnreadBadge(id) {
        const badge = document.getElementById("badge-" + id);
        const userDiv = document.querySelector(`.user[data-id='${id}']`);
        if (badge) {
            badge.textContent = "0";
            badge.style.display = "none";
            userDiv.classList.remove("has-unread");
        }
    }
</script>

</body>
</html>
