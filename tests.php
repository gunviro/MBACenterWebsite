<?php if(!isset($_SESSION)) session_start();

define('DOCROOT', realpath(dirname(__FILE__)).'/');

//if(file_exists(DOCROOT . "managers/coursManager.php")) echo "existe"; else echo "existe pas";

require_once(DOCROOT . "managers/coursManager.php");
require_once(DOCROOT . "managers/userManager.php");

if(isset($_SESSION['user']))
{
	?>
		<input type="hidden" id="session_id_user" value="<?php echo $_SESSION['id_user']; ?>"/>
		<input type="hidden" id="session_type" value="2"/>
	<?php
}
else
{
	if(isset($_SESSION['employe']))
	{
		?>
		<input type="hidden" id="session_id_employe" value="<?php echo $_SESSION['id_employe']; ?>"/>
		<input type="hidden" id="session_type" value="1"/><?php
		if(isset($_GET['id_user']))
		{
			?><input type="hidden" id="profil_user_from_employe" value="<?php echo $_GET['id_user']; ?>"/><?php
		}
	}
	else
	{	
		//echo $_SESSION['nom'];
	    header('Location: http://mbacentereurope.eu/index.php');
		//header('Location: http://localhost/mbacenter/mbacenter/index.php');
	}
}

?>


<!DOCTYPE html>

<html lang="en-US" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Theme Starz">

    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/selectize.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/vanillabox/vanillabox.css" type="text/css">

    <link rel="stylesheet" href="assets/css/style.css" type="text/css">

    <title>profil</title>

</head>

<body class="page-sub-page page-my-account">


		<link href="nivo-lightbox/nivo-lightbox.css" rel="stylesheet" type="text/css" />
		<link href="nivo-lightbox/themes/default/default.css" rel="stylesheet" type="text/css" />

		<a class="lightbox" href="http://wikipedia.com" data-lightbox-type="iframe" data-lightbox-gallery="gallery2">Iframe</a>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script type="text/javascript" src="nivo-lightbox/nivo-lightbox.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
    			$('.lightbox').nivoLightbox({ effect: 'fade' });
			});
		</script>
		
<!-- Wrapper -->
<div class="wrapper">
<!-- Header -->
<?php include('header.php'); ?>
<!-- end Header -->

<!-- Breadcrumb -->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">My Profile</li>
    </ol>
</div>
<!-- end Breadcrumb -->

<!-- Page Content -->
<div id="page-content">
    <div class="container">
		<?php if(isset($_GET['id_user'])) {?>
        <header><h1>User Account</h1></header>
		<?php } else { ?>
		 <header><h1>My Account</h1></header>
		 <?php }?>
        <div class="row">
            <div class="col-md-8">
                <section id="my-account">
				<?php if(isset($_SESSION['employe']))
				{
					if(isset($_GET['id_user']))
					{
					?>
					<ul class="nav nav-tabs" id="tabs">
							<li class="active"><a href="#tab-profile" data-toggle="tab">Personal info</a></li>        
							<li><a href="#education" data-toggle="tab">Education</a></li>
							<li><a href="#work" data-toggle="tab">Work History</a></li>
							<li><a href="#school" data-toggle="tab">School orientation</a></li>
							<li><a href="#tab-change-password" data-toggle="tab">Change Password</a></li>
							<li><a href="#tab-hangout" data-toggle="tab">Hangout</a></li>			
						</ul><!-- /#my-profile-tabs -->
					<?php
					}
					else
					{?>
						<ul class="nav nav-tabs" id="tabs">
							<li class="active"><a href="#tab-profile" data-toggle="tab">Personal info</a></li>
							<li><a href="#tab-change-password" data-toggle="tab">Change Password</a></li>
							<li><a href="#tab-hangout" data-toggle="tab">Hangout</a></li>			
						</ul>
					<?php 
					}
				}
				if(isset($_SESSION['user']))
				{
				?>
                    <ul class="nav nav-tabs" id="tabs">
                        <li class="active"><a href="#tab-profile" data-toggle="tab">Personal info</a></li>        
						<li><a href="#education" data-toggle="tab">Education</a></li>
						<li><a href="#work" data-toggle="tab">Work History</a></li>
						<li><a href="#school" data-toggle="tab">School orientation</a></li>
                        <li><a href="#tab-change-password" data-toggle="tab">Change Password</a></li>
						<li><a href="#tab-hangout" data-toggle="tab">Hangout</a></li>			
                    </ul><!-- /#my-profile-tabs -->
				<?php 
				}?>
				
                    <div class="tab-content my-account-tab-content">
                        <div class="tab-pane active" id="tab-profile">
                            <section id="my-profile">
                                <header><h3>My Profile</h3></header>
                                <div class="my-profile">
                                    <figure class="profile-avatar">
                                        <div class="image-wrapper"><img id='img_profile' src="<?php if(isset($_GET['id_user'])){echo "photos_user/".$_GET['id_user']."user.jpg";}?>"></div>
                                    </figure>
                                    <article>
                                        <div class="table-responsive">
                                            <table class="my-profile-table">
                                                <tbody>
                                                <tr>
												<form id='form_personal_info'>
                                                    <td class="title">Name</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="name" name="name">
                                                        </div><!-- /input-group -->
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                        <div class="input-group">
                                                            
                                                        </div><!-- /input-group -->
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title">Surname</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="surname" name="surname" >
                                                        </div><!-- /input-group -->
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
                                                </tr>

                                                
                                                <tr>
                                                    <td class="title">Adresses</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="adress" name="adress" >
                                                        </div><!-- /input-group -->
                                                    </td>
                                                </tr>
                                                
                                                
                                                 <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                
                                                <td class="title">Phone</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="gsm" name="gsm">
                                                        </div><!-- /input-group -->
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
                                                </tr>                                         
                                                
                                                <td class="title">Gender</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <INPUT type= "radio" id="genre" name="genre" value="1"> Male
															<INPUT type= "radio" id="genre" name="genre" value="0"> Female
                                                        </div><!-- /input-group -->
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                
                                                 <tr>
                                                    <td class="title">Ethnicity</td>
                                                    <td>
														<div class="controls">
														  <select id="location" name="location" class="input-xlarge">
														    <option value="Prefer not to answer">Prefer not to answer</option>
															<option value="African">African</option>
															<option value="Asian">Asian</option>
															<option value="Black or african american">Black or african american</option>
															<option value="Cocasian or white">Cocasian or white</option>
															<option value="Latino or ispanic">Latino or ispanic</option>
															<option value="Middle eastern" >Middle eastern</option>
															<option value="Native american">Native american</option>
															<option value="Pacific islander">Pacific islander</option>
															<option value="Other">Other</option>					
														  </select>
													 </div>
												  
												 </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title">Birth date</td>
                                                    <td>
														<input type="date" id='date_annif' name="anniversaire" value="JJJJ-MM-AA">
													</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
                                                </tr>

                                                <td class="title">Military Status</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <INPUT type= "radio" id="military" name="military" value=1> Serned
															<INPUT type= "radio" id="military" name="military" value=0> Not Serned
															
                                                        </div><!-- /input-group -->
                                                    </td>
                                                </tr>
                                                
												<?php
												
												if(isset($_SESSION['employe']))
												{
													if(isset($_GET['id_user']))
													{
														?> 
													<tr>
														<td class="title bio">Comments</td>
														<td>
															<div class="input-group">
																<textarea id="comments"></textarea>
															</div><!-- /input-group -->
														</td>
                                                    </tr><?php
													}
												} ?>
												<?php
												if(isset($_SESSION['employe']))
												{
													if(isset($_GET['id_user']))
													{
														?> 

													<tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
													</tr>	
													<tr>
														<td class="title bio">Message To Send</td>
														<td>
															<div class="input-group">
																<textarea id="sms_text"></textarea>
															</div><!-- /input-group -->
														</td>
														
                                                    </tr><?php
													}
												} ?>
													<?php
												if(isset($_SESSION['employe']))
												{
													if(isset($_GET['id_user']))
													{
														?> 
													<tr>
														<td class="title">Cellular</td>
														<td>
															<div class="input-group">
																<input type="text" id="gsm"> </input>
															</div><!-- /input-group -->
														</td>
														
													</tr><?php
													}
												} ?>
                                                    <tr>
													
												<!-- fichier chargement photo -->
													<!--<link rel="stylesheet" href="style.css"/>-->
													<body>
													<div class="main">
													<!--<h1>Ajax Image Upload</h1><br/>-->
													<hr>
													<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
														<!--<div id="image_preview"><img id="previewing" src="noimage.png" /></div>
														<hr  id="line">
														<div id="selectImage">-->
														<label>Select Your Image</label><br/>
															<input type="file" name="file" id="file" required />
															<input class="foto" type="submit" value="Upload" class="btn submit" />
														</div>
													</form>
													</div>
													
													<div id="message"></div>
												
										        </td>
												
                                                </tr>
                                                <hr>
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="button" class="btn pull-right" id="btn_save_personal_info">Save Changes</button>
										<?php
										if(isset($_SESSION['employe']))
										{
											if(isset($_GET['id_user']))
											{
												?> <p> </p>
												<button type="button" class="btn pull-right" id="btn_sms">Send Message</button>
												<?php
											}
										} ?>
										</form>
                                    </article>
								
                                </div><!-- /.my-profile -->
                            </section><!-- /#my-profile -->
                        </div><!-- /tab-pane -->

                        <div class="tab-pane" id="education">
                            <section id="my-profile">
                                <header><h3>Education</h3></header>
                                <div class="my-profile">
                                    <figure class="profile-avatar">
                                        
                                    </figure>
                                    <article>
                                        <div class="table-responsive">
										<form id='form_education'>
                                            <table class="my-profile-table">
                                                <tbody>
                                                <tr>
                                                    <td class="title">Highest grade obtained</td>
                                                    <td>
                                                        <div class="controls">
														  <select id="high_grade" name="high_grade" class="input-xsmall">
														    <option></option>
															<option value="High scool">High school</option>
															<option value="BA">BA</option>
															<option value="BS">BS</option>
															<option value="MS">MS</option>
															<option value="PhD">PhD</option>
														</select>
													 </div>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                       
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title">Area of study</td>
                                                    <td>
                                                        <div class="controls">
														  <select id="area_study" name="area_study" class="input-xsmall">
														    <option></option>
															<option value="Universitiy">University</option>
															<option value="College">College</option>
															<option value="Other">Other</option>
															
														</select>
													 </div>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
                                                </tr>   
                                                <tr>
                                                    <td class="title">witch test are you planning</td>
                                                    <td>
                                                        <input type="checkbox" name="gmat" value=1 checked> GMAT
														<input type="checkbox" name="gre" value=2>GRE<br/>
														<input type="checkbox" name="toefl" value=3> TOEFL
														<input type="checkbox" name="lsat" value=4>LSAT
														<input type="checkbox" name="mcat" value=5>MCAT
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                
                                                <td class="title bio">Have you taken one of those tests ?</td>
                                                    <td>
                                                    <div class="rowg">
                                                        <div class="inputs"><h6>GMAT</h6>
                                                            <input type="text" class="formu" id="gmat_score" name="gmat_score" placeholder="score" >
                                                        </div><!-- /input-group -->
                                                        
                                                        <div class="inputs"><h6>GRE</h6>
                                                            <input type="text" class="formu" id="gre_score" name="gre_score"placeholder="score" >
                                                        </div>
                                                        
                                                        <div class="inputs"><h6>TOEFL</h6>
                                                            <input type="text" class="formu" id="toefl_score" name="toefl_score" placeholder="score" >
                                                        </div>
                                                        
                                                        <div class="inputs"><h6>LSAT</h6>
                                                            <input type="text" class="formu" id="lsat_score" name="lsat_score" placeholder="score" >
                                                        </div>
                                                        
                                                        <div class="inputs"><h6>MCAT</h6>
                                                            <input type="text" class="formu" id="mcat_score" name="mcat_score" placeholder="score" >
                                                        </div>
                                                        </div><!-- /input-group -->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
                                                </tr>           
                                                <td class="title"> </td>
                                                    <td>
                                                        <div class="input-group">
                                                        <h6>Are you interested in admissions consulting ? <small>(CV, Essays, Letters...)</small> </h6>
                                                            <input type="radio" name="admission" id="yes" value=1> Yes
															<input type="radio" name="admission" id="no" value=0>No<br/>
                                                        </div><!-- /input-group -->
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
                                                </tr>
												<?php
												if(isset($_SESSION['employe']))
												{
													if(isset($_GET['id_user']))
													{
														?> 
													<tr>
														<td class="title bio">Comments</td>
														<td>
															<div class="input-group">
																<textarea id="comments"></textarea>
															</div><!-- /input-group -->
														</td>
                                                    </tr><?php
													}
												} ?>
												<?php
												if(isset($_SESSION['employe']))
												{
													if(isset($_GET['id_user']))
													{
														?> 

													<tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
													</tr>	
													
													<tr>
														<td class="title">Cellular</td>
														<td>
															<div class="input-group">
																<input type="text" id="gsm"> </input>
															</div><!-- /input-group -->
														</td>
														
													</tr><?php
													}
												} ?>
                                                    <tr>
												<!-- fichier chargement photo -->
													<!--<link rel="stylesheet" href="style.css"/>-->
													<body>
													<div class="main">
													<!--<h1>Ajax Image Upload</h1><br/>-->
													
													</div>
													
													<div id="message"></div>
												
										        </td>
												
                                                </tr>
                                                <hr>
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="button" class="btn pull-right" id="btn_save_education">Save Changes</button>
										<?php
										if(isset($_SESSION['employe']))
										{
											if(isset($_GET['id_user']))
											{
												?> <p> </p>
												<button type="button" class="btn pull-right" id="btn_sms">Send Message</button>
												<?php
											}
										} ?>
										</form>
                                    </article>
								
                                </div><!-- /.my-profile -->
                            </section><!-- /#my-profile -->
                        </div><!-- /tab-pane -->

                         <div class="tab-pane" id="work">
                            <section id="my-profile">
                                <header><h3>Work History</h3></header>
                                <div class="my-profile">
                                    <figure class="profile-avatar">
                                        
                                    </figure>
                                    <article>
									<form id='form_work_history'>
                                        <div class="table-responsive">
                                            <table class="my-profile-table">
                                                <tbody>
                                                <tr>
                                                    <td class="title">Years of working experience</td>
                                                    <td>
                                                        <div class="input-group">
																<div class="rowg">
																	<input type="date" name="annee_deb" id="annee_deb"> to <input type="date" id="annee_fin" name="annee_fin">
																</div>
															</div><!-- /input-group -->
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                       
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title">Current job position</td>
                                                    <td>
                                                        <div class="input-group">
                                                        	<input type="text" class="form-control" id="current_job" name="current_job">
													    </div>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
                                                </tr>

                                                
                                                                                                                                                
												<?php
												
												if(isset($_SESSION['employe']))
												{
													if(isset($_GET['id_user']))
													{
														?> 
													<tr>
														<td class="title bio">Comments</td>
														<td>
															<div class="input-group">
																<textarea id="comments"></textarea>
															</div><!-- /input-group -->
														</td>
                                                    </tr><?php
													}
												} ?>
												<?php
												if(isset($_SESSION['employe']))
												{
													if(isset($_GET['id_user']))
													{
														?> 
														
														
														
													<tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
													</tr>	
													
													<tr>
														<td class="title">Cellular</td>
														<td>
															<div class="input-group">
																<input type="text" id="gsm"> </input>
															</div><!-- /input-group -->
														</td>
														
													</tr><?php
													}
												} ?>
                                                    <tr>
												<!-- fichier chargement photo -->
													<!--<link rel="stylesheet" href="style.css"/>-->
													<body>
													<div class="main">
													<!--<h1>Ajax Image Upload</h1><br/>-->
													
													</div>
													
													<div id="message"></div>
												
										        </td>	
                                                </tr>
                                                <hr>
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="button" class="btn pull-right" id="btn_work_history">Save Changes</button>
										<?php
										if(isset($_SESSION['employe']))
										{
											if(isset($_GET['id_user']))
											{
												?> <p> </p>
												<button type="button" class="btn pull-right" id="btn_sms">Send Message</button>
												<?php
											}
										} ?>
										</form>
                                    </article>
								
                                </div><!-- /.my-profile -->
                            </section><!-- /#my-profile -->
                        </div><!-- /tab-pane -->

                          <div class="tab-pane" id="school">
                            <section id="my-profile">
                                <header><h3>School orientation</h3></header>
                                <div class="my-profile">
                                    <figure class="profile-avatar">
                                    
                                    </figure>
                                    <article>
									<form id='form_school_orientation'>
                                        <div class="table-responsive">
                                            <table class="my-profile-table">
                                                <tbody>
                                                <tr>
                                                    <td class="title">I want to work in the following industry : </td>
                                                    <td>
                                                        <div class="input-group">
																<div class="rowg">
																	<div class="controls">
														  <select id="work_industry" name="work_industry" class="input-xlarge">
														    <option value="College">College</option>
															<option value="Graduate School">Graduate School</option>
															<option value="Business School">Business School</option>
															<option value="Law School">Law School</option>
															<option value="Medical School">Medical School</option>
														 </select>
													 </div>
																</div>
															</div><!-- /input-group -->
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title"></td>
                                                    <td>
                                                       
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title">Which program are you appllying to </td>
                                                    <td>
                                                        <div class="input-group">
													
                                                        <input type="checkbox" name="MBA" id="MBA" value="MBA"checked> MBA
														<input type="checkbox" name="EMBA" id="EMBA" value="EMBA">EMBA<br/>
														<input type="checkbox" name="MS" id="MS" value="M.S."> M.S.
														<input type="checkbox" name="PhD" id="PhD" value="PhD">PhD
														
                                                        </div>												   
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title"></td>
                                                    <td></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="title bio">which 5 schools are you appliying to </td>
                                                    <td>
													<?php $userManager = new UserManager();
														  $result = $userManager->selectApplyiedSchool();
													?>
														<select id="applyied_school_1" name="applyied school_1" class="input-xlarge">
														    <option value="0">Choose a University</option>
															<?php
																for($i=0;$i<count($result);$i++)
																{?>
																   <option value="<?php echo $result[$i]['id_ecole']; ?>"><?php echo $result[$i]['ecole_nom'];?></option>
														  <?php }?>
															
														 </select>
														 
														 <select id="applyied_school_2" name="applyied school_2" class="input-xlarge">
														    <option value="0">Choose a University</option>
																<?php
																for($i=0;$i<count($result);$i++)
																{?>
																   <option value="<?php echo $result[$i]['id_ecole']; ?>"><?php echo $result[$i]['ecole_nom'];?></option>
														  <?php }?>
														 </select>
														 
														 <select id="applyied_school_3" name="applyied school_2" class="input-xlarge">
														    <option value="0">Choose a University</option>
																<?php
																for($i=0;$i<count($result);$i++)
																{?>
																   <option value="<?php echo $result[$i]['id_ecole']; ?>"><?php echo $result[$i]['ecole_nom'];?></option>
														  <?php }?>
														 </select>
														 
														 <select id="applyied_school_4" name="applyied school_3" class="input-xlarge">
														    <option value="0">Choose a University</option>
																<?php
																for($i=0;$i<count($result);$i++)
																{?>
																   <option value="<?php echo $result[$i]['id_ecole']; ?>"><?php echo $result[$i]['ecole_nom'];?></option>
														  <?php }?>
														 </select>
														 
														 <select id="applyied_school_5" name="applyied school_4" class="input-xlarge">
														    <option value="0">Choose a University</option>
																<?php
																for($i=0;$i<count($result);$i++)
																{?>
																   <option value="<?php echo $result[$i]['id_ecole']; ?>"><?php echo $result[$i]['ecole_nom'];?></option>
														  <?php }?>
														 </select>
														 
	                                                </td>
                                                </tr>                                                                                              
												<?php
												
												if(isset($_SESSION['employe']))
												{
													if(isset($_GET['id_user']))
													{
														?> 
													<tr>
														<td class="title bio">Comments</td>
														<td>
															<div class="input-group">
																<textarea id="comments"></textarea>
															</div><!-- /input-group -->
														</td>
                                                    </tr><?php
													}
												} ?>
												<?php
												if(isset($_SESSION['employe']))
												{
													if(isset($_GET['id_user']))
													{
														?> 	
													<tr>
                                                    <td class="title"></td>
                                                    <td>
                                                    </td>
													</tr>	
													
													<tr>
														<td class="title">Cellular</td>
														<td>
															<div class="input-group">
																<input type="text" id="gsm"> </input>
															</div><!-- /input-group -->
														</td>
														
													</tr><?php
													}
												} ?>
                                                    <tr>
												<!-- fichier chargement photo -->
													<!--<link rel="stylesheet" href="style.css"/>-->
													<body>
													<div class="main">
													<!--<h1>Ajax Image Upload</h1><br/>-->
													
													</div>
													
													<div id="message"></div>
												
										        </td>
												
                                                </tr>
                                                <hr>
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="button" class="btn pull-right" id="btn_save_school_orientation">Save Changes</button>
										<?php
										if(isset($_SESSION['employe']))
										{
											if(isset($_GET['id_user']))
											{
												?> <p> </p>
												<button type="button" class="btn pull-right" id="btn_sms">Send Message</button>
												<?php
											}
										} ?>
										</form>
                                    </article>
								
                                </div><!-- /.my-profile -->
                            </section><!-- /#my-profile -->
                        </div><!-- /tab-pane -->
                        <div class="tab-pane" id="tab-change-password">
						<?php if(!isset($_GET['id_user']))
						{?>
                            <section id="password">
                                <header><h3>Change Password</h3></header>
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-4">
                                        <p>
                                        </p>
                                        <form role="form" class="clearfix" id="form_password" ><!--action="course-joined.html"-->
                                            <div class="form-group">
                                                <label for="current-password">Current Password</label>
                                                <input type="password" class="form-control" id="current_password">
												<label id="current_pass">This field is required.</label>
												<label id="current_pass_error">This is not the good password.</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="new-password" >New Password</label>
                                                <input type="password" class="form-control" id="new_password">
												<label id="new_pass">This field is required.</label>
											
                                            </div>
                                            <div class="form-group">
                                                <label for="repeat-new-password">Repeat New Password</label>
                                                <input type="password" class="form-control" id="repeat_new_password">
												<label id="repeat_new_pass">This field is required.</label>
												<label id="repeat_pass_error">This two password don't match.</label>
                                            </div>
                                            <button type="button" class="btn pull-right" id='btn_change_password' >Change Password</button>
                                        </form>
                                    </div>
                                </div>
                            </section><?php } ?>
                        </div>
						<div class="tab-pane" id="tab-hangout">
						<?php if(!isset($_GET['id_user']))
						{?>
                            <section id="hangout">
                            <a href="#" onClick="window.open('http://www.tanitechnologies.tn/tests/gmat/', 'Full GMAT Test', ',type=fullWindow,fullscreen,scrollbars=yes');">
	<img border="0" align="center"  src="assets/img/practice-tests.png"/>
</a>
                                <header><h3>Start Hangout</h3></header>
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-4">
                                        <p>
											<a href="https://plus.google.com/hangouts/_?gid=172555099126" style="text-decoration:none;">
											  <img src="https://ssl.gstatic.com/s2/oz/images/stars/hangout/1/gplus-hangout-60x230-normal.png"
												alt="Start a Hangout"
												style="border:0;width:230px;height:60px;"/>
											</a>
                                        </p>
                                       <?php    
											require_once($_SERVER['DOCUMENT_ROOT']."/managers/userManager.php");
											$userManager = new UserManager();
											$result = $userManager->listeCoursByUser();
											$auj = date("Ymd");
											for($i=0;$i<count($result);$i++)
											{
												//echo $result[$i]['nom'];
												if(0==$userManager->nbJours($auj,$result[$i]['date_cours']))
												{
													?>
													<span>
														<p> <?php echo $result[$i]['nom'];?> </p> <input type="checkbox" name="users_cours" value="<?php echo $result[$i]['email'];?>"/>
													</span>
													<?php
												}
											}
									   ?>
                                    </div>
                                </div>
                            </section><?php } ?>
                        </div>
                    </div><!-- /.tab-content -->
                </section>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div>
<!-- end Page Content -->

<!-- Footer -->
<?php include('footer.php'); ?>
<!-- end Footer -->
</div>
<!-- end Wrapper -->

<script type="text/javascript" src="assets/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/selectize.min.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="assets/js/jQuery.equalHeights.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.vanillabox-0.1.5.min.js"></script>
<script type="text/javascript" src="assets/js/countdown.js"></script>
<script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="assets/js/retina-1.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<?php
if(isset($_SESSION['user']))
{
	?>
		<script type="text/javascript" src="assets/js/traitement_divers_profil.js"></script>
	<?php
}
else
{
	if(isset($_SESSION['employe']))
	{
		if(isset($_GET['id_user']))
		{
			?><script type="text/javascript" src="assets/js/traitement_profil_user_from_employe.js"></script><?php
		}
		else
		{
			?>
				<script type="text/javascript" src="assets/js/traitement_divers_profil.js"></script>
			<?php
		}
	}
}
?>
</body>
</html>