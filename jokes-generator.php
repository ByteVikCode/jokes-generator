<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jokes Generator</title>
    <style>
        :root{
            --primary-color: #4A90E2;
            --secondary-color: #2C3E50;
            --background-color: url('https://4kwallpapers.com/images/wallpapers/baymax-disney-series-tv-series-2022-series-animation-1920x1080-8093.jpg');
            --text-color: #F8F8F8;
            --chatbox-color: url('https://e0.pxfuel.com/wallpapers/233/473/desktop-wallpaper-baymax-17.jpg');
            --btn-hover: #357ABD;
            --message-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        body {
            font-family: 'Arial', sans-serif;
            background: var(--background-color) no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: flex-end; /* Changed to align to the right */
            height: 100vh;
            margin: 0;
            color: var(--text-color);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .container {
            display: flex;
            flex-direction: column;
            background: var(--secondary-color);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            height: 80vh;
            width: 40vw;
            max-width: 500px;
            padding: 30px;
            animation: slideIn 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
            margin-right: 5vw; /* Add margin to the right */
        }

        @keyframes slideIn {
            from { transform: translateX(50px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .avatar-container {
            position: relative;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar {
            background-color: var(--primary-color);
            padding: 10px;
            width: 60px;
            border-radius: 50%;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
            animation: pulse 2s infinite;
            transition: transform 0.3s ease;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .header h3 {
            margin-left: 15px;
            font-size: 24px;
            font-weight: 600;
            color: var(--primary-color);
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .chat {
            background: var(--chatbox-color) no-repeat center center;
            background-size: cover;
            height: 100%;
            padding: 20px;
            border-radius: 15px;
            overflow-y: auto;
            box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.3);
            scrollbar-width: thin;
            scrollbar-color: var(--primary-color) rgba(0,0,0,0.2);
        }

        .chat::-webkit-scrollbar {
            width: 6px;
        }

        .chat::-webkit-scrollbar-thumb {
            background-color: var(--primary-color);
            border-radius: 10px;
        }

        .message {
            font-size: 16px;
            line-height: 24px;
            width: fit-content;
            max-width: 80%;
            padding: 15px;
            border-radius: 18px;
            margin: 15px 10px;
            box-shadow: var(--message-shadow);
            animation: fadeInUp 0.5s ease-out;
            transition: transform 0.2s ease;
        }

        .message:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }

        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .message.joke {
            background-color: var(--primary-color);
            color: #fff;
            border-top-left-radius: 4px;
            position: relative;
        }

        .message.joke::before {
            content: '🤖';
            position: absolute;
            top: -25px;
            left: 5px;
            font-size: 20px;
        }

        .message.response {
            background-color: #ECF0F1;
            color: #2C3E50;
            border-top-right-radius: 4px;
            margin-left: auto;
            position: relative;
        }

        .message.response::before {
            content: '😃';
            position: absolute;
            top: -25px;
            right: 5px;
            font-size: 20px;
        }

        .btn {
            background: var(--primary-color);
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 25px;
            padding: 14px 30px;
            margin-top: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            background: var(--btn-hover);
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        /* Empty state */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 100%;
            color: rgba(255, 255, 255, 0.8);
            animation: fadeIn 1s ease-in-out;
        }

        .para{
            color:rgb(2, 18, 35);
            font-weight: bold;
        }

        .empty-state svg {
            width: 50%;
            height: auto;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .empty-state p {
            font-size: 16px;
            line-height: 1.5;
            text-shadow: 0 1px 3px rgba(0,0,0,0.5);
        }

        /* Loading animation for joke */
        .thinking {
            display: flex;
            align-items: center;
        }

        .thinking span {
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            margin: 0 3px;
            animation: blink 1.4s infinite;
        }

        .thinking span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .thinking span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes blink {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 0.8; }
        }

        /* Responsive media queries */
        @media (max-width: 768px) {
            .container {
                width: 80%;
                height: 75vh;
                margin-right: 3vw;
            }
        }

        @media (max-width: 480px) {
            .container {
                width: 90%;
                height: 80vh;
                padding: 20px;
                margin-right: 5%;
            }
            
            body {
                justify-content: center; /* Center on mobile */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="avatar-container">
                <img src="https://cdn.pixabay.com/photo/2017/01/31/20/53/robot-2027195_640.png" alt="Robot Avatar" class="avatar">
            </div>
            <h3>Baymax</h3>
        </div>
        <div id="_chat" class="chat">
            <div class="empty-state" id="emptyState">
                <p class="para">I'm Baymax, your joke assistant.<br>Click the button below to hear a joke!</p>
            </div>
        </div>
        <button id="jokeBtn" class="btn">Tell me a joke</button>
    </div>
    
    <script>
        const chat = document.getElementById("_chat");
        const jokeBtn = document.getElementById("jokeBtn");
        const emptyState = document.getElementById("emptyState");

        jokeBtn.addEventListener("click", generateJoke);

        async function generateJoke() {
            // Remove empty state if it exists
            if (emptyState && emptyState.parentNode === chat) {
                chat.removeChild(emptyState);
            }
            
            jokeBtn.disabled = true;
            jokeBtn.innerHTML = "Getting a joke...";
            jokeBtn.style.opacity = "0.7";

            const message = createMessageElement("Hey Baymax, tell me a joke!");
            appendMessage(message);

            // Scroll to new message
            setTimeout(() => {
                chat.scrollTop = chat.scrollHeight;
            }, 100);

            const joke = createMessageElement("", "joke");
            joke.innerHTML = `<div class="thinking"><span></span><span></span><span></span></div>`;
            appendMessage(joke);

            try {
                const res = await fetch("https://icanhazdadjoke.com", {
                    headers: { Accept: "application/json" },
                });

                if (res.ok) {
                    const data = await res.json();
                    
                    // Add slight delay for better UX
                    setTimeout(() => {
                        joke.innerHTML = data.joke;
                        
                        jokeBtn.disabled = false;
                        jokeBtn.innerHTML = "Another joke!";
                        jokeBtn.style.opacity = "1";
                        
                        // Scroll to show full joke
                        chat.scrollTop = chat.scrollHeight;
                    }, 1000);
                } else {
                    joke.innerHTML = "Sorry, my joke generator needs a tune-up. Try again later!";
                    jokeBtn.disabled = false;
                    jokeBtn.innerHTML = "Try again";
                    jokeBtn.style.opacity = "1";
                }
            } catch (error) {
                joke.innerHTML = "Oops! My circuits got crossed. Please try again!";
                jokeBtn.disabled = false;
                jokeBtn.innerHTML = "Try again";
                jokeBtn.style.opacity = "1";
            }
        }

        function createMessageElement(content, type = "response") {
            const element = document.createElement("div");
            element.classList.add("message", type);
            if (content) {
                element.innerHTML = content;
            }
            return element;
        }

        function appendMessage(element) {
            chat.appendChild(element);
            chat.scrollTop = chat.scrollHeight;
        }
    </script>
</body>
</html>