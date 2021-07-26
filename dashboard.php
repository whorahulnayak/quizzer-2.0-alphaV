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
<html>
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
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
		<title>Quizzer</title>
        <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"  type="text/javascript"></script>
</head>

<body>
    
    <!-- new navbar comes here -->
    <nav
			class="
				navbar navbar-expand-lg navbar-dark
				navcolor
				fixed-top
				py-0 py-md-1 py-lg-2
			"
		>
			<!-- Title and Logo -->
			<a class="navbar-brand" href="dashboard.php?q=0">
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
                <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a class="nav-item nav-link active" href="dashboard.php?q=0">Home</a></li>
					<li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a class="nav-item nav-link" href="dashboard.php?q=1">Users</a></li>
                
                    <li <?php if(@$_GET['q']==4) echo'class="active"'; ?>><a class="nav-item nav-link active" href="dashboard.php?q=4">Add Quiz</a></li>
					<li <?php if(@$_GET['q']==5) echo'class="active"'; ?>><a class="nav-item nav-link" href="dashboard.php?q=5">My Quizes</a></li>


                
                    <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5) echo'active"'; ?>">
				    <a href="logout1.php?q=dashboard.php" class="nav-item nav-link ">
					<i class="fas fa-sign-out-alt"></i>Log out</a>
				</div>
			</div>
		</nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

<!-- Home Page -->
                <?php if(@$_GET['q']==0)
                {
                   echo "<h1 class='home-header'> HELLO Admin!!
					</h1>";
					
                }
                ?>

<!-- Users -->
                <?php 
                    if(@$_GET['q']==1) 
                    {
                        $result = mysqli_query($con,"SELECT * FROM user") or die('Error');
                        // echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
                        // <tr><td><center><b>S.N.</b></center></td><td><center><b>Name</b></center></td><td><center><b>Email</b></center></td><td><center><b>Action</b></center></td></tr>';
                        echo '<div class=" col-sm-8 container-fluid row mx-auto justify-content-center text-center parent2 ">
							<div class="cardnadmin lboard">
								<nav class="ladder-nav">
									<div class="ladder-title">
										<h2 class="h2-title">Users</h2>
									</div>
								</nav>
								<table id="rankings" class="leaderboard-results text-center table">
									<thead class="thead-light">
										<tr>
											<th scope="col">S.N.</th>
											<th scope="col">Name</th>
											<th scope="col">Email</th>
											<th scope="col">Action</th>
								
										</tr>
									</thead>';
                         $c=1;
                        while($row = mysqli_fetch_array($result)) 
                        {
                            $name = $row['name'];
                            $email = $row['email'];
                            echo '<tr>
                            <td>'.$c++.'</td>
                            <td>'.$name.'</td>
                            <td>'.$email.'</td>
                            <td><a title="Delete User" href="update.php?demail='.$email.'"><b><i class="fas fa-trash"></i></b></a></td>
                            </tr>';
                        }
                        $c=0;
                        echo '</table></div></div>';
                    }
                ?>

<!-- Add quiz -->
                <?php
                    if(@$_GET['q']==4 && !(@$_GET['step']) ) 
                    {
                        echo '<div class="row"><span class="title1" style="margin-left:40%;font-size:30px;color:#fff;"><b>Enter Quiz Details</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6">   
                        <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="name"></label>  
                                    <div class="col-md-12">
                                        <input id="name" name="name" placeholder="Enter Quiz title" class="form-control input-md" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="total"></label>  
                                    <div class="col-md-12">
                                        <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="right"></label>  
                                    <div class="col-md-12">
                                        <input id="right" name="right" placeholder="Enter marks on right answer" class="form-control input-md" min="0" type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="wrong"></label>  
                                    <div class="col-md-12">
                                        <input id="wrong" name="wrong" placeholder="Enter minus marks on wrong answer without sign" class="form-control input-md" min="0" type="number">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for=""></label>
                                    <div class="col-md-12"> 
                                        <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
                                    </div>
                                </div>

                            </fieldset>
                        </form></div>';
                    }
                ?>

<!-- After adding quiz -->
                <?php
                    if(@$_GET['q']==4 && (@$_GET['step'])==2 ) 
                    {
                        echo ' 
                        <div class="row">
                        <span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].'&ch=4 "  method="POST">
                        <fieldset>
                        ';
                
                        for($i=1;$i<=@$_GET['n'];$i++)
                        {
                            echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
                                        <div class="col-md-12">
                                            <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'1"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'2"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'3"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'4"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <br />
                                    <b>Correct answer</b>:<br />
                                    <select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md" >
                                    <option value="a">Select answer for question '.$i.'</option>
                                    <option value="a"> option a</option>
                                    <option value="b"> option b</option>
                                    <option value="c"> option c</option>
                                    <option value="d"> option d</option> </select><br /><br />'; 
                        }
                        echo '<div class="form-group">
                                <label class="col-md-12 control-label" for=""></label>
                                <div class="col-md-12"> 
                                    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
                                </div>
                              </div>

                        </fieldset>
                        </form></div>';
                    }
                ?>

<!-- My Quizzes -->
<?php 
                    if(@$_GET['q']==5) 
                    {
                        $email = $_SESSION['email'];
                        $result = mysqli_query($con,"SELECT * FROM quiz WHERE owned= '$email' ORDER BY date DESC") or die('Error');
                    echo '<div
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
                        <div class="cardnadmin lboard">
                            <nav class="ladder-nav">
                                <div class="ladder-title">
                                    <h2 class="h2-title">My Quizes</h2>
                                </div>
                            </nav>
                            <table id="rankings" class="leaderboard-results text-center table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">S.N.</th>
                                        <th scope="col">Topic</th>
                                        <th scope="col">Total Questions</th>
                                        <th scope="col">Marks</th>
                                        <th scope="col">Quiz ID</th>
                                        <th scope="col">View Scores</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>';
                        $c=1;
                        while($row = mysqli_fetch_array($result)) {
                            $title = $row['title'];
                            $total = $row['total'];
                            $sahi = $row['sahi'];
                            $eid = $row['eid'];

                            echo '<tr><td>'.$c++.'</td>
                            <td>'.$title.'</td>
                            <td>'.$total.'</td>
                            <td>'.$sahi*$total.'</td>
                            <td>'.$eid.'</td>
                            <td><a href="dashboard.php?q=6&eid='.$eid.'" class="btn sub1"><b>View scores</b></a></center></td>
                            <td><a href="update.php?q=rmquiz&eid='.$eid.'" class="btn sub2"><b>Remove</b></a></td></tr>';
                        }
                        $c=0;
                        echo '</table></div></div>';
                    }
                ?>

<!-- View Scores -->
                <?php 
                    if(@$_GET['q']==6) 
                    {
                        $eid = $_GET['eid'];
                        $result = mysqli_query($con,"SELECT * FROM history WHERE eid= '$eid' ORDER BY date DESC") or die('Error');
                        echo '<div
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
                        <div class="cardnadmin lboard">
                            <nav class="ladder-nav">
                                <div class="ladder-title">
                                    <h2 class="h2-title">Performance</h2>
                                </div>
                            </nav>
                            <table id="rankings" class="leaderboard-results text-center table" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">S.N.</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Total Score</th>
                                       
                                    </tr>
                                </thead>';
                        $c=1;

                        while($row = mysqli_fetch_array($result)) {
                            $email = $row['email'];
                            $total = $row['score'];

                            echo '<tr><td><center>'.$c++.'</center></td><td><center>'.$email.'</center></td><td><center>'.$total.'</center></td>';  
                      }
                        $c=0;
                        echo '</table>

                        <form method="GET" action="export.php">
                        <center><b><a href="dashboard.php?q=7&eid='.$eid.'" class="pull-right btn sub1" style="margin:0px;background:green;color:black"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Download</b></span></a></b></center>
                        </form>

                        </div></div>';
                    }
                ?>

<!-- Download Score -->
                <?php 
                    if(@$_GET['q']==7) 
                    {
                        $eid = $_GET['eid'];
                    //trying to download with quiz name
                    $result = mysqli_query($con,"SELECT title FROM quiz WHERE eid= '$eid' ORDER BY date DESC") or die('Error');
                    if(mysqli_num_rows($result) > 0)
                    {
                        $row = mysqli_fetch_array($result);
                        $qname = $row['title'];
                    }
                    //new modif
                    $result = mysqli_query($con,"SELECT * FROM history WHERE eid= '$eid' ORDER BY date DESC") or die('Error');
                    $c=1;
                    if(mysqli_num_rows($result) > 0)
                    {
                     $output .= '
                      <table class="table" bordered="1">  
                                       <tr>  
                                            <th>Sn</th>  
                                            <th>Email</th>  
                                            <th>Total</th> 
                                       </tr>
                     ';
                     while($row = mysqli_fetch_array($result))
                     {
                      $output .= '
                       <tr>  
                          <td>'.$c.'</td>  
                          <td>'.$row["email"].'</td>  
                         <td>'.$row["score"].'</td>  
                    
                       </tr>
                      ';
                      $c++;
                     }
                     $c=0;
                     $output .= '</table>';
                     $fn = $qname;
                     header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                    header("Content-Disposition: attachment; filename=$fn.xls");  //File name extension was wrong
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("Cache-Control: private",false);
                     echo $output;
                    }
                   }
                ?>
            </div>
        </div>
    </div>
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
