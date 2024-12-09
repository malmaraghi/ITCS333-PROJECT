<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* General reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Full height of the viewport */
    background: linear-gradient(45deg, #181365, #3a2f8a, #181365, #0f0e3d);
    background-size: 400% 400%;
    animation: gradientMotion 8s ease infinite;
    font-family: Arial, sans-serif;
    color: white;
    text-align: center;
}

/* Keyframes for background motion effect */
@keyframes gradientMotion {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

   h2{
    text-align: center;
    font-size: 1.5rem;
    
   }
    </style>
</head>
<body>

<h2>[ERROR:409] User with this email already exists</h2>

</body>
</html>