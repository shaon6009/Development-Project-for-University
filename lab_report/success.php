<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Registration Successful</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            background: linear-gradient(135deg, #43cea2, #185a9d);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            text-align: center;
            background: rgba(0,0,0,0.4);
            padding: 3rem;
            border-radius: 20px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 8px 30px rgba(0,0,0,0.4);
        }
        h1 {
            font-weight: 700;
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        /* Animations for confetti */
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background-color: #FFC107;
            opacity: 0.8;
            animation-name: confettiFall;
            animation-duration: 3s;
            animation-iteration-count: infinite;
            animation-timing-function: ease-in;
            border-radius: 2px;
        }

        @keyframes confettiFall {
            0% {
                transform: translateY(-50px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body>

<div class="container animate__animated animate__bounceInDown">
    <h1 class="animate__animated animate__rubberBand"> Congratulations! At last you did it</h1>
    <p class="animate__animated animate__fadeIn">Your registration was successful.</p>
    <a href="register.php" class="btn btn-light btn-lg animate__animated animate__pulse animate__infinite">Register Another User</a>
</div>

<script>
    for (let i = 0; i < 20; i++) {
        let confetti = document.createElement('div');
        confetti.classList.add('confetti');
        confetti.style.left = Math.random() * window.innerWidth + 'px';
        confetti.style.backgroundColor = `hsl(${Math.random() * 360}, 70%, 60%)`;
        confetti.style.width = (5 + Math.random() * 10) + 'px';
        confetti.style.height = confetti.style.width;
        confetti.style.animationDelay = (Math.random() * 3) + 's';
        confetti.style.animationDuration = (2 + Math.random() * 3) + 's';
        document.body.appendChild(confetti);
    }
</script>

</body>
</html>
