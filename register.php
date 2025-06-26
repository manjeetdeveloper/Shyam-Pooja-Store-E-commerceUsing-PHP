<?php
// Database connection ko include karo
include 'connection.php';
// Session start karo
session_start();

// Agar form submit hua hai toh
if(isset($_POST['submit'])){
   // Form data ko secure tarike se get karo
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
   $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
   
   // Database mein check karo ki user already exists toh nahi hai
   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('Query failed');

   // Agar user already exists hai toh
   if(mysqli_num_rows($select) > 0){
      $message[] = 'User already exists!';
   }else{
      // Password aur confirm password match karte hai ya nahi check karo
      if($password != $cpassword){
         $message[] = 'Passwords do not match!';
      }else{
         // Password ko hash karo secure storage ke liye
         $hashed_password = password_hash($password, PASSWORD_DEFAULT);
         
         // User ko database mein insert karo
         $insert = mysqli_query($conn, "INSERT INTO `users` (name, email, password) 
            VALUES ('$name', '$email', '$hashed_password')") 
            or die('Insert failed: ' . mysqli_error($conn));

         // Agar insert successful hua toh
         if($insert){
            $message[] = "Registration successful! Please login.";
            // 3 seconds baad login page pe redirect karo
            header("refresh:3;url=login.php");
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            min-width: 100vw;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Jost', sans-serif;
            background: #0a1026;
            overflow: hidden;
        }
        .solar-bg {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            z-index: 0;
            pointer-events: none;
        }
        .form-box {
            background: rgba(255,255,255,0.18);
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.37), 0 0 40px 0 #ffd70033;
            border-radius: 24px;
            padding: 48px 36px 36px 36px;
            width: 370px;
            display: flex;
            flex-direction: column;
            /* align-items: center; */
            backdrop-filter: blur(12px);
            border: 1.5px solid rgba(255,255,255,0.25);
            position: relative;
            transition: box-shadow 0.4s, transform 0.3s;
            z-index: 1;
            margin: 0 auto;
            align-items: flex-start;
        }
        .form-box:hover, .form-box:focus-within {
            box-shadow: 0 16px 48px 0 #573b8a55, 0 0 80px 0 #ffd70055;
            transform: translateY(-6px) scale(1.025);
        }
        .form-box::before {
            content: '';
            position: absolute;
            top: -30px; left: -30px; right: -30px; bottom: -30px;
            z-index: -1;
            background: none;
        }
        .form-box h2 {
            color: #fff;
            margin-bottom: 32px;
            font-size: 2.2em;
            font-weight: bold;
            letter-spacing: 1px;
            text-shadow: 0 2px 8px #573b8a44;
            
        }
        .form-group {
            position: relative;
            width: 100%;
            margin-bottom: 24px;
        }
        .form-group input {
            width: 100%;
            padding: 18px 38px 18px 38px;
            border: none;
            border-radius: 10px;
            background: #e0dedecc;
            font-size: 1em;
            outline: none;
            transition: box-shadow 0.2s, background 0.2s;
            box-shadow: 0 2px 8px #573b8a11;
        }
        .form-group input:focus {
            box-shadow: 0 0 0 3px #573b8a55;
            background: #fff;
        }
        .form-group label {
            position: absolute;
            left: 38px;
            top: 18px;
            color: #888;
            font-size: 1em;
            pointer-events: none;
            background: transparent;
            transition: 0.2s cubic-bezier(.4,0,.2,1);
            padding: 0 4px;
        }
        .form-group input:focus + label,
        .form-group input:not(:placeholder-shown) + label {
            top: -10px;
            left: 34px;
            font-size: 0.85em;
            color: #573b8a;
            background: #fff8;
            border-radius: 4px;
            padding: 0 6px;
        }
        .form-group .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%) scale(1);
            color: #573b8a;
            font-size: 1.2em;
            pointer-events: none;
            transition: color 0.2s, transform 0.3s;
        }
        .form-group input:focus ~ .input-icon {
            color: #ffd700;
            transform: translateY(-50%) scale(1.2) rotate(-8deg);
        }
        .form-box .btn {
            width: 100%;
            padding: 16px 0;
            margin: 18px 0 10px 0;
            background: linear-gradient(90deg, #573b8a 60%, #ffd700 100%);
            color: #fff;
            font-size: 1.15em;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 2px 8px #573b8a22;
            transition: background 0.2s, transform 0.1s;
            position: relative;
            overflow: hidden;
        }
        .form-box .btn:active {
            transform: scale(0.97);
        }
        .form-box .btn::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            width: 0;
            height: 0;
            background: rgba(255,255,255,0.3);
            border-radius: 100%;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
            z-index: 1;
        }
        .form-box .btn:active::after {
            width: 200%;
            height: 200%;
        }
        .form-box p {
            color: #fff;
            margin-top: 10px;
            font-size: 1em;
        }
        .form-box a {
            color: #ffd700;
            text-decoration: underline;
            font-weight: 500;
        }
        .message {
            background: #ffddddcc;
            color: #a94442;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 7px;
            text-align: center;
            width: 100%;
            box-shadow: 0 2px 8px #573b8a11;
            animation: fadeIn 0.8s;
            font-size: 1.05em;
            position: relative;
        }
        .message.success {
            background: #d4ffd4cc;
            color: #2e7d32;
            animation: popSuccess 0.7s;
        }
        .message.error {
            animation: shake 0.4s;
        }
        @keyframes popSuccess {
            0% {transform: scale(0.8); opacity: 0;}
            60% {transform: scale(1.1); opacity: 1;}
            100% {transform: scale(1);}
        }
        @keyframes shake {
            0%, 100% {transform: translateX(0);}
            20%, 60% {transform: translateX(-8px);}
            40%, 80% {transform: translateX(8px);}
        }
        .checkmark {
            display: inline-block;
            width: 22px;
            height: 22px;
            margin-right: 6px;
            vertical-align: middle;
        }
        .checkmark svg {
            display: block;
        }
    </style>
</head>
<body>
    <canvas class="solar-bg"></canvas>
    <div class="form-box fade-in">
        <h2>Register Now</h2>
        <?php if (isset($message)) {
            foreach ($message as $msg) {
                $isSuccess = strpos($msg, 'success') !== false || strpos($msg, 'Successful') !== false;
                $isError = strpos($msg, 'not match') !== false || strpos($msg, 'exists') !== false || strpos($msg, 'failed') !== false;
                echo '<div class="message '.($isSuccess ? 'success' : ($isError ? 'error' : '')).'">';
                if($isSuccess) {
                    echo '<span class="checkmark"><svg viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 10 18 4 12"/></svg></span>';
                }
                echo '<span>' . $msg . '</span></div>';
            }
        } ?>
        <form action="" method="post" autocomplete="off">
            <div class="form-group">
                <input type="text" name="name" id="name" placeholder=" " required>
                <label for="name">Enter your name</label>
                <span class="input-icon"><i class="fa fa-user"></i></span>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder=" " required>
                <label for="email">Enter your email</label>
                <span class="input-icon"><i class="fa fa-envelope"></i></span>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password">Enter your password</label>
                <span class="input-icon"><i class="fa fa-lock"></i></span>
            </div>
            <div class="form-group">
                <input type="password" name="cpassword" id="cpassword" placeholder=" " required>
                <label for="cpassword">Confirm your password</label>
                <span class="input-icon"><i class="fa fa-lock"></i></span>
            </div>
            <button type="submit" name="submit" class="btn">Register Now</button>
            <p>Already have an account? <a href="login.php">Login now</a></p>
        </form>
    </div>
    <script>
        // Fade-in effect for form
        document.querySelector('.form-box').classList.add('fade-in');
        // Solar system animation
        const canvas = document.querySelector('.solar-bg');
        const ctx = canvas.getContext('2d');
        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();
        // Solar system parameters
        const sun = { x: () => canvas.width/2, y: () => canvas.height/2, r: 38, color: '#FFD700' };
        const planets = [
            { r: 6, orbit: 60, speed: 0.018, color: '#b5b5b5' }, // Mercury
            { r: 8, orbit: 90, speed: 0.014, color: '#e6c28b' }, // Venus
            { r: 9, orbit: 120, speed: 0.012, color: '#3fa9f5' }, // Earth
            { r: 7, orbit: 150, speed: 0.010, color: '#e07b53' }, // Mars
            { r: 16, orbit: 190, speed: 0.008, color: '#e3b04b' }, // Jupiter
            { r: 13, orbit: 230, speed: 0.006, color: '#e5e2c6', ring: true }, // Saturn
            { r: 11, orbit: 270, speed: 0.004, color: '#7ad1e6' }, // Uranus
            { r: 10, orbit: 310, speed: 0.003, color: '#4b6cb7' }  // Neptune
        ];
        let t = 0;
        function drawSolarSystem() {
            ctx.clearRect(0,0,canvas.width,canvas.height);
            // Draw orbits
            ctx.save();
            ctx.strokeStyle = 'rgba(255,255,255,0.08)';
            ctx.lineWidth = 1.2;
            planets.forEach(p => {
                ctx.beginPath();
                ctx.arc(sun.x(), sun.y(), p.orbit, 0, 2*Math.PI);
                ctx.stroke();
            });
            ctx.restore();
            // Draw sun
            ctx.save();
            let grad = ctx.createRadialGradient(sun.x(), sun.y(), sun.r*0.5, sun.x(), sun.y(), sun.r);
            grad.addColorStop(0, '#fffbe6');
            grad.addColorStop(0.5, sun.color);
            grad.addColorStop(1, '#ff9900');
            ctx.beginPath();
            ctx.arc(sun.x(), sun.y(), sun.r, 0, 2*Math.PI);
            ctx.fillStyle = grad;
            ctx.shadowColor = '#FFD700';
            ctx.shadowBlur = 40;
            ctx.fill();
            ctx.restore();
            // Draw planets
            planets.forEach((p, i) => {
                let angle = t * p.speed + i;
                let px = sun.x() + Math.cos(angle) * p.orbit;
                let py = sun.y() + Math.sin(angle) * p.orbit;
                ctx.save();
                ctx.beginPath();
                ctx.arc(px, py, p.r, 0, 2*Math.PI);
                ctx.fillStyle = p.color;
                ctx.shadowColor = p.color;
                ctx.shadowBlur = 12;
                ctx.fill();
                // Saturn ring
                if(p.ring){
                    ctx.beginPath();
                    ctx.ellipse(px, py, p.r+7, p.r+2, angle, 0, 2*Math.PI);
                    ctx.strokeStyle = '#e5e2c6cc';
                    ctx.lineWidth = 2.5;
                    ctx.stroke();
                }
                ctx.restore();
            });
            t += 0.8;
            requestAnimationFrame(drawSolarSystem);
        }
        drawSolarSystem();
        // Button ripple effect
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e){
                const ripple = document.createElement('span');
                ripple.className = 'ripple';
                ripple.style.left = (e.offsetX) + 'px';
                ripple.style.top = (e.offsetY) + 'px';
                this.appendChild(ripple);
                setTimeout(()=>ripple.remove(), 600);
            });
        });
    </script>
    <style>
        .btn .ripple {
            position: absolute;
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s linear;
            background: rgba(255,255,255,0.5);
            pointer-events: none;
            z-index: 2;
        }
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</body>
</html>
