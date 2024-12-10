<?php

// Determine the selected form (login or signup)
$formSelection = $_POST['form_selection'] ?? 'login'; // Default to 'login' if not set
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Sign-Up</title>
    <link rel="stylesheet" href="stylewelcome.css">
</head>
<body>

<div class=" containerOfIntro">

<div class="intro">

    <div class="intro-text">
        <h3>Welcome to the University Room Booking System!</h3>
        <p>This platform is exclusively designed for our university students to simplify the process of reserving study rooms, meeting spaces. Whether you're preparing for exams, or collaborating on a group project, our system is here to ensure you have access to the spaces you need. Happy booking, and we’re here to support your academic journey!</p>
    </div>
</div>

<div class="center-svg">
<svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 width="800px" height="800px" viewBox="0 0 31.938 31.938"
	 xml:space="preserve">
<g>
	<g>
		<polygon points="0.903,10.8 1.346,10.8 1.346,7.041 8.847,7.041 8.847,10.8 9.289,10.8 9.289,7.041 10.076,7.041 10.076,6.249 
			0,6.249 0,7.041 0.903,7.041 		"/>
		<path d="M1.695,5.433v0.64h6.272h0.114c0.428,0,0.82,0,1.23,0c0-0.374-0.301-0.675-0.672-0.675c-0.234,0-0.432,0.128-0.553,0.311
			l0.46-3.142h-7.29l0.447,2.866H1.695z M5.146,4.16c0.231,0,0.419,0.178,0.419,0.396c0,0.22-0.188,0.398-0.419,0.398
			c-0.232,0-0.419-0.179-0.419-0.398C4.728,4.337,4.914,4.16,5.146,4.16z"/>
		<polygon points="11.872,10.8 12.314,10.8 12.314,7.041 19.814,7.041 19.814,10.8 20.258,10.8 20.258,7.041 21.045,7.041 
			21.045,6.249 10.969,6.249 10.969,7.041 11.872,7.041 		"/>
		<path d="M12.664,5.433v0.64h6.271h0.114c0.429,0,0.82,0,1.231,0c0-0.374-0.303-0.675-0.674-0.675
			c-0.233,0-0.432,0.128-0.551,0.311l0.459-3.142h-7.291l0.447,2.866H12.664z M16.115,4.16c0.23,0,0.419,0.178,0.419,0.396
			c0,0.22-0.188,0.398-0.419,0.398c-0.232,0-0.419-0.179-0.419-0.398C15.696,4.337,15.883,4.16,16.115,4.16z"/>
		<polygon points="22.688,10.8 23.128,10.8 23.128,7.041 30.63,7.041 30.63,10.8 31.07,10.8 31.07,7.041 31.857,7.041 31.857,6.249 
			21.782,6.249 21.782,7.041 22.688,7.041 		"/>
		<path d="M23.479,5.433v0.64h6.271h0.113c0.429,0,0.82,0,1.232,0c0-0.374-0.303-0.675-0.674-0.675
			c-0.234,0-0.431,0.128-0.552,0.311l0.458-3.142h-7.29l0.446,2.866H23.479z M26.93,4.16c0.23,0,0.418,0.178,0.418,0.396
			c0,0.22-0.188,0.398-0.418,0.398c-0.232,0-0.42-0.179-0.42-0.398C26.51,4.337,26.695,4.16,26.93,4.16z"/>
		<polygon points="0.078,16.45 0.981,16.45 0.981,20.211 1.424,20.211 1.424,16.45 8.925,16.45 8.925,20.211 9.367,20.211 
			9.367,16.45 10.154,16.45 10.154,15.658 0.078,15.658 		"/>
		<path d="M1.773,15.481h6.272H8.16c0.428,0,0.82,0,1.23,0c0-0.373-0.301-0.674-0.672-0.674c-0.234,0-0.432,0.127-0.552,0.31
			l0.457-3.142h-7.29l0.447,2.866H1.773V15.481z M5.225,13.569c0.231,0,0.419,0.179,0.419,0.396c0,0.22-0.188,0.397-0.419,0.397
			c-0.232,0-0.419-0.178-0.419-0.397C4.806,13.749,4.992,13.569,5.225,13.569z"/>
		<polygon points="11.047,16.45 11.95,16.45 11.95,20.211 12.393,20.211 12.393,16.45 19.895,16.45 19.895,20.211 20.336,20.211 
			20.336,16.45 21.123,16.45 21.123,15.658 11.047,15.658 		"/>
		<path d="M12.743,15.481h6.271h0.114c0.429,0,0.82,0,1.231,0c0-0.373-0.303-0.674-0.674-0.674c-0.233,0-0.432,0.127-0.552,0.31
			l0.457-3.142h-7.29l0.447,2.866h-0.007v0.64H12.743z M16.193,13.569c0.23,0,0.418,0.179,0.418,0.396
			c0,0.22-0.188,0.397-0.418,0.397c-0.232,0-0.419-0.178-0.419-0.397C15.774,13.749,15.961,13.569,16.193,13.569z"/>
		<polygon points="21.859,15.658 21.859,16.45 22.766,16.45 22.766,20.211 23.206,20.211 23.206,16.45 30.708,16.45 30.708,20.211 
			31.148,20.211 31.148,16.45 31.938,16.45 31.938,15.658 		"/>
		<path d="M23.557,15.481h6.271h0.113c0.429,0,0.82,0,1.231,0c0-0.373-0.302-0.674-0.673-0.674c-0.234,0-0.432,0.127-0.552,0.31
			l0.456-3.142h-7.289l0.447,2.866h-0.008v0.64H23.557z M27.007,13.569c0.231,0,0.419,0.179,0.419,0.396
			c0,0.22-0.188,0.397-0.419,0.397s-0.419-0.178-0.419-0.397C26.588,13.749,26.773,13.569,27.007,13.569z"/>
		<polygon points="0.078,25.61 0.981,25.61 0.981,29.371 1.424,29.371 1.424,25.61 8.925,25.61 8.925,29.371 9.367,29.371 
			9.367,25.61 10.154,25.61 10.154,24.817 0.078,24.817 		"/>
		<path d="M1.334,21.135l0.447,2.867H1.773v0.64h6.272H8.16c0.428,0,0.82,0,1.23,0c0-0.374-0.301-0.675-0.672-0.675
			c-0.234,0-0.432,0.127-0.552,0.31l0.457-3.142H1.334z M5.225,23.522c-0.232,0-0.419-0.179-0.419-0.397
			c0-0.218,0.187-0.396,0.419-0.396c0.231,0,0.419,0.178,0.419,0.396C5.644,23.344,5.456,23.522,5.225,23.522z"/>
		<polygon points="11.047,25.61 11.95,25.61 11.95,29.371 12.393,29.371 12.393,25.61 19.895,25.61 19.895,29.371 20.336,29.371 
			20.336,25.61 21.123,25.61 21.123,24.817 11.047,24.817 		"/>
		<path d="M12.303,21.135l0.447,2.867h-0.007v0.64h6.271h0.114c0.429,0,0.82,0,1.231,0c0-0.374-0.303-0.675-0.674-0.675
			c-0.233,0-0.432,0.127-0.552,0.31l0.457-3.142H12.303z M16.193,23.522c-0.232,0-0.419-0.179-0.419-0.397
			c0-0.218,0.187-0.396,0.419-0.396c0.23,0,0.418,0.178,0.418,0.396C16.611,23.344,16.425,23.522,16.193,23.522z"/>
		<polygon points="21.859,25.61 22.766,25.61 22.766,29.371 23.206,29.371 23.206,25.61 30.708,25.61 30.708,29.371 31.148,29.371 
			31.148,25.61 31.938,25.61 31.938,24.817 21.859,24.817 		"/>
		<path d="M23.116,21.135l0.446,2.867h-0.006v0.64h6.271h0.114c0.428,0,0.82,0,1.23,0c0-0.374-0.302-0.675-0.673-0.675
			c-0.233,0-0.431,0.127-0.552,0.31l0.457-3.142H23.116z M27.007,23.522c-0.231,0-0.419-0.179-0.419-0.397
			c0-0.218,0.188-0.396,0.419-0.396s0.419,0.178,0.419,0.396C27.426,23.344,27.238,23.522,27.007,23.522z"/>
	</g>
</g>
</svg>
   

    </div>

</div>   

</div>


    <!-- Form Selection Buttons -->
    <div class="button-container">
        <form method="POST" action="welcomepage.php">
            <input type="hidden" name="form_selection" value="login">
            <button type="submit" class="form-button">Login</button>
        </form>
        <form method="POST" action="welcomepage.php">
            <input type="hidden" name="form_selection" value="signup">
            <button type="submit" class="form-button">Sign Up</button>
        </form>
    </div>

	
   
</body>
</html>
