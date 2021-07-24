<?php
    include_once 'database.php';
    session_start();
    if(!(isset($_SESSION['email'])))
    {
        header("location:index.php");
    }
    else
    {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        include_once 'database.php';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="preconnect" href="https://fonts.gstatic.com" />
		<link
			href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>

		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
			integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
			crossorigin="anonymous"
		/>
	
		<link rel="stylesheet" href="css/hamburgers.css" />
		<link rel="stylesheet" href="css/student_home.css" />

		<title>Quizzer</title>
	</head>
<body>
    <nav
			class="
				navbar navbar-expand-lg navbar-dark
				navcolor
				fixed-top
				py-0 py-md-1 py-lg-2
			"
		>
			<!-- Title and Logo -->
			<a class="navbar-brand" href="#">
				<img
					src="image/atom.svg"
					width="30"
					height="30"
					class="d-inline-block align-top"
					alt=""
					loading="lazy"
				/>
				<span id="brand">Quizzer</span>
			</a>

			

			<button
				class="hamburger hamburger--emphatic is-valid navbar-toggler"
				type="button"
				data-toggle="collapse"
				data-target="#expandme"
			>
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>
			<!-- Categories -->
			<div class="collapse navbar-collapse" id="expandme">
				<div class="navbar-nav">
					<a class="nav-item nav-link active" href="welcome.php?q=3">Home</a>
					<a class="nav-item nav-link" href="welcome.php?q=2">History</a>
				</div>
			</div>
		</nav>

        <?php 
                if(isset($_SESSION['key']))
                {

                if(@$_GET['q']==1 && @$_GET['approved']==1) 
                {
                    
                    $uid = $_POST['uid'];
                    $result = mysqli_query($con,"SELECT * FROM quiz where eid = '$uid' ORDER BY date DESC") or die('Error');
                    echo  '<div
			class="
				col-sm-8
				container-fluid
				row
				mx-auto
				justify-content-center
				text-center
				parent2
			"
		>
			<div class="cardn lboard">
				<nav class="ladder-nav">
					<div class="ladder-title">
						<h3>History</h3>
					</div>
				</nav>
				<table id="rankings" class="leaderboard-results" width="100%">
					<thead>
						<tr>
							<th>S.N.</th>
							<th>Topic</th>
							<th>Total Questions</th>
							<th>Marks</th>
							<th>Action</th>
						</tr>
					</thead>';
                    $c=1;
                    while($row = mysqli_fetch_array($result)) {
                        $title = $row['title'];
                        $total = $row['total'];
                        $sahi = $row['sahi'];
                        $eid = $row['eid'];
                    $q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
                    $rowcount=mysqli_num_rows($q12);	
                    if($rowcount == 0){
                        echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td><b><a href="welcome.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="btn sub1" style="color:black;margin:0px;background:#1de9b6"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
                    }
                    else
                    {
                    echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td><b><a href="update.php?q=quizre&step=25&eid='.$eid.'&n=1&t='.$total.'" class><span><b>Resthttart</b></span></a></b></td></tr>';
                    }
                    }
                    $c=0;
                    echo '</table></div></div>';
                }}?>

<!-- HOME PAGE -->
                <?php if(@$_GET['q']==3) 
                {
                   
                    echo '<div class="parent">
			<div class="child child1">
				<h2>Enter your quiz code:</h2>
				<br/>
				<form action="welcome.php?q=1&approved=1" name="form" method="POST">
				<div class="input-group input-group-lg">
					<input type="text" name="uid" class="form-control" />
					
					<input type="submit" value="start quiz" class="btn1">
				</div>
				</form>
			</div>

			<div class="child child3">
				<img
					class="buddy_image"
					src="image/undraw_online_test_gba7.svg"
					alt=""
				/>
			</div>
		</div>';
                }?>

                <?php
                    if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) 
                    {

                        $eid=@$_GET['eid'];
                        $sn=@$_GET['n'];
                        $total=@$_GET['t'];
                        $q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
                        echo '<div class="panel" style="margin:5%">';
                        while($row=mysqli_fetch_array($q) )
                        {
                            $qns=$row['qns'];
                            $qid=$row['qid'];
                            echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br /><br />'.$qns.'</b><br /><br />';
                        }
                        $q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
                        echo '<form action="update.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
                        <br />';

                        while($row=mysqli_fetch_array($q) )
                        {
                            $option=$row['option'];
                            $optionid=$row['optionid'];
                            echo'<input type="radio" name="ans" value="'.$optionid.'">&nbsp;'.$option.'<br /><br />';
                        }
                        
                        echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
                    }

                    if(@$_GET['q']== 'result' && @$_GET['eid']) 
                    {
                        $eid=@$_GET['eid'];
                        $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " );
                        echo  '<div class="panel">
                        <center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

                        while($row=mysqli_fetch_array($q) )
                        {
                            $s=$row['score'];
                            $w=$row['wrong'];
                            $r=$row['sahi'];
                            $qa=$row['level'];
                            echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>'.$qa.'</td></tr>
                                <tr style="color:#99cc32"><td>right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
                                <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
                                <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
                        }
                        
                    }
                ?>

<?php
                    if(@$_GET['q']== 2) 
                    {
                        $q=mysqli_query($con,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
                        echo  '<div class="panel title">
                        <table class="table table-striped title1" >
                        <tr style="color:black;"><td><center><b>S.N.</b></center></td><td><center><b>Quiz</b></center></td><td><center><b>Question Solved</b></center></td><td><center><b>Right</b></center></td><td><center><b>Wrong<b></center></td><td><center><b>Score</b></center></td>';
                        $c=0;
                        while($row=mysqli_fetch_array($q) )
                        {
                        $eid=$row['eid'];
                        $s=$row['score'];
                        $w=$row['wrong'];
                        $r=$row['sahi'];
                        $qa=$row['level'];
                        $q23=mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');

                        while($row=mysqli_fetch_array($q23) )
                        {  $title=$row['title'];  }
                        $c++;
                        echo '<tr><td><center>'.$c.'</center></td><td><center>'.$title.'</center></td><td><center>'.$qa.'</center></td><td><center>'.$r.'</center></td><td><center>'.$w.'</center></td><td><center>'.$s.'</center></td></tr>';
                        }
                        echo'</table></div>';
                    }

                   
                ?>

<script>
			// Look for .hamburger
			var hamburger = document.querySelector(".hamburger");
			// On click
			hamburger.addEventListener("click", function () {
				// Toggle class "is-active"
				hamburger.classList.toggle("is-active");
				// Do something else, like open/close menu
			});
			var svg = document.querySelector(".navbar-brand");
			var brand = document.querySelector("#brand");

			console.log(scroll);
			var scr = window.addEventListener("scroll", function () {
				var scroll = window.scrollY;
				if (scroll != 0) {
					brand.classList.add("disappear");
				} else {
					brand.classList.remove("disappear");
				}
			});
			$(window).scroll(function () {
				var scrollTop = $(this).scrollTop();
				$("#brand").css({
					opacity: function () {
						var elementHeight = $(this).height();
						return 1 - (elementHeight - scrollTop) / elementHeight;
						// adding transition here
					},
				});
			});
		</script>

		<script
			script
			src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
			integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
			crossorigin="anonymous"
		></script>
		<script
			script
			src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
			integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
			crossorigin="anonymous"
		></script>
		<script
			script
			src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
			integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
			crossorigin="anonymous"
		></script>
</body>
</html>