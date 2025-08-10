<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Soft Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <title>Assistant4U</title>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('frontend/css/font-awesome.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <style>
        .navbar-default a.navbar-brand h1 {
            color: #444;
        }

        .navbar-default .navbar-nav>li>a {
            color: #444;
        }

        @media (max-width: 767px) {
            .navbar-default .navbar-nav>li>a {
                font-size: 14px;
                color: #fff;
                padding: 7px 0;
            }
        }

        .carousel .item {
            background: url({{ asset('frontend/images/carousel/babysitter_banner.jpg') }}) no-repeat center;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            -ms-background-size: cover;
        }

        .carousel .item.item3 {
            background: url({{ asset('frontend/images/carousel/mechanic_banner_2.jpg') }}) no-repeat center;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            -ms-background-size: cover;
        }

        .carousel .item.item2 {
            background: url({{ asset('frontend/images/carousel/carpenter_banner.jpg') }}) no-repeat center;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            -ms-background-size: cover;
        }

        .carousel .item.item4 {
            background: url({{ asset('frontend/images/carousel/electrician_banner.jpg') }}) no-repeat center;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            -ms-background-size: cover;
        }

        .carousel .item.item5 {
            background: url({{ asset('frontend/images/carousel/plumber_banner.jpg') }}) no-repeat center;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            -ms-background-size: cover;
        }

        .servi-shadow {
            border: none;
            border-radius: 5px;
            padding-top: 15px;
        }

        .servi-shadow a:hover {
            cursor: default;
        }

        .services-grids-w3l h4 {
            color: #444;
            white-space: nowrap;
        }

        .mkl_footer {
            background: url({{ asset('frontend/images/carousel/labours_banner.jpg') }}) no-repeat center;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            -ms-background-size: cover;
            text-align: center;
        }

        .botttom-nav-allah ul li a:hover {
            color: red;
        }

        .contact-title {
            color: #fff;
            font-size: 3em;
            margin-bottom: 2em;
        }

        .dropdown-menu .fa {
            width: 17px;
            text-align: center;
        }
        #toTop {
            width: 48px;
            height: 48px;
            background: url("{{ asset('frontend/images/arrow-up.png') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="modal fade" id="register-modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="register-modal-id">Register</h4>
                </div>
                <div class="modal-body">
                    <div class="box-content">
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="active"><a href="#">Home</a></li>
                            <li role="presentation"><a href="#">Profile</a></li>
                            <li role="presentation"><a href="#">Messages</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer ">
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="messageModal" role="dialog" style="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Response Message</h4>
                </div>
                <div class="modal-body">
                    <div class="box-content">
                        <center>
                            <div style="width:400px;text-align:center;border-radius:10px;" class="tclear" id="tvalid">
                                <?php echo "You are not Approved By Admin!!! "; ?>
                            </div>
                        </center>
                        <button class="btn btn-danger" class="close" data-dismiss="modal" aria-hidden="true"
                            style="border-radius:15px;line-height: 10px;">Ok</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer ">
            </div>
        </div>
    </div> --}}

    {{-- <div class="modal fade" id="user" role="dialog" style="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">User Registration</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" name="myForm" onsubmit="return validateForm();"
                        action="" enctype="multipart/form-data">
                        <div class="box-content">
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" value="" style="width:450px;"
                                    required pattern="[a-zA-Z\s]+">
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Address</label>
                                <textarea type="text" class="form-control" name="addr" style="width:450px;"
                                    required></textarea>
                            </div>

                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Aadhaar no</label>

                                <input type="text" name="aadhar" class="form-control" value="" style="width:450px;"
                                    minlength="12" maxlength="12" required>
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">State</label>
                                <?PHP
								$query = mysql_query("SELECT * FROM tbl_state");

								?>
                                <Select name="state" class="form-control" value="" id="state" onchange="sh(this.value)"
                                    style="width:450px;" required>
                                    <option value="">--Select--</option>
                                    <?php
									while ($res = mysql_fetch_array($query)) {
									?>
                                    <option value="<?php echo $res['s_id']; ?>">
                                        <?php echo $res['s_name']; ?>
                                    </option>
                                    <?php
									}
									?>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">District</label>
                                <Select name="district" class="form-control" id="district" onchange="shu(this.value)"
                                    style="width:450px;" required>
                                    <option value="">--Select--</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Location</label>
                                <Select name="location" class="form-control" id="location" value="" style="width:450px;"
                                    required>
                                    <option value="">--Select--</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Phone number</label>
                                <input type="text" name="phone" class="form-control" value="" style="width:450px;"
                                    maxlength="10" minlength="10" required>
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Email ID</label>
                                <input type="email" name="mail" class="form-control" value="" style="width:450px;"
                                    required id="email">
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Photo</label>
                                <input type="file" name="file" class="form-control" value="" style="width:450px;"
                                    accept="images/*" required>
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" value="" style="width:450px;"
                                    required>
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" value=""
                                    style="width:450px;" required>
                            </div>
                            <button name="save" type="submit" class="btn btn-success"><span
                                    class="glyphicon glyphicon-ok-sign"></span> Submit</button>
                            <button type="reset" class="btn btn-default pull-right" data-dismiss="modal"><span
                                    class="glyphicon glyphicon-remove"></span> No</button>
                        </div>
                </div>
            </div>
            </form>
            <div class="modal-footer ">
            </div>
        </div>
    </div>
    <div class="modal fade" id="staff" role="dialog" style="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Staff Registration</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" name="myForm1" onsubmit="return validateForm1();"
                        action="" enctype="multipart/form-data">
                        <div class="box-content">
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" value="" style="width:450px;"
                                    required pattern="[a-zA-Z\s]+">
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Address</label>
                                <textarea type="text" class="form-control" name="addr" style="width:450px;"
                                    required></textarea>
                            </div>

                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Aadhar No</label>
                                <input type="text" name="aadhar" class="form-control" value="" style="width:450px;"
                                    minlength="12" maxlength="12" required>
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="" style="width:450px;"
                                    minlength="10" maxlength="10" required>
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Email Id</label>
                                <input type="email" name="mail" class="form-control" value="" style="width:450px;"
                                    required id="email">
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">State</label>
                                <?PHP
								$query = mysql_query("SELECT * FROM tbl_state");

								?>
                                <Select name="state" class="form-control" value="" id="state" onchange="shi(this.value)"
                                    style="width:450px;" required>
                                    <option value="" selected hidden disabled>--Select--</option>
                                    <?php
									while ($res = mysql_fetch_array($query)) {
									?>
                                    <option value="<?php echo $res['s_id']; ?>">
                                        <?php echo $res['s_name']; ?>
                                    </option>
                                    <?php
									}
									?>
                                </select>
                            </div>

                            <div class="form-group" style="margin-left:130px;">
                                <label for="">District</label>
                                <Select name="district" class="form-control" id="districtw" style="width:450px;"
                                    onchange="shl(this.value)" required>
                                    <option value="" selected hidden disabled>--Select--</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Location</label>
                                <Select name="location" class="form-control" value="" id="location1"
                                    style="width:450px;" required>
                                    <option value="" selected hidden disabled>--Select--</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Category</label>
                                <Select name="category" id="category" class="form-control" onchange="test()" value=""
                                    style="width:450px;" required>
                                    <option value="">--Select--</option>
                                    <option value="Taxi">Taxi</option>
                                    <option value="She Taxi">She Taxi</option>
                                    <option value="Auto">Auto</option>

                                    <option value="JCB Operator">JCB Operator</option>

                                    <option value="Electrician">Electrician</option>
                                    <option value="Plumbers">Plumbers</option>
                                    <option value="Painter">Painter</option>
                                    <option value="Maison">Maison</option>
                                    <option value="Welders">Welders</option>
                                    <option value="House Keeper">House Keeper</option>
                                    <option value="Home Nurse">Home Nurse</option>
                                    <option value="Baby caretakers">Baby caretakers</option>
                                    <option value="Vehicle Mechanics">Vehicle Mechanics</option>
                                </select>
                            </div>
                            <div class="form-group" id="licence" style="margin-left:130px;display:none;">
                                <label for="">Enter Vehicle No</label>
                                <input type="text" name="licence" class="form-control" value="" style="width:450px;">
                            </div>
                            <div class="form-group" id="vehicle" style="margin-left:130px;display:none;">
                                <label for="">Vehicle Photo</label>
                                <input type="file" name="files1" class="form-control" value="" style="width:450px;"
                                    accept="image/*">
                            </div>

                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Staff Photo</label>
                                <input type="file" name="files" class="form-control" value="" style="width:450px;"
                                    required accept="images/*">
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Experience ( year )</label>
                                <Select name="Experience" class="form-control" style="width:450px;" required>
                                    <option value="" selected hidden disabled>--Select--</option>
                                    <?php
									for ($i = 0; $i <= 25; $i++) {
									?>
                                    <option value="<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </option>
                                    <?php
									}
									?>


                                </select>
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Expected salary</label>
                                <input type="text" name="salary" class="form-control" value="" style="width:450px;"
                                    required>
                            </div>

                            <div class="form-group" style="margin-left:130px;">
                                <label for="">User Name</label>
                                <input type="text" name="username" class="form-control" value="" style="width:450px;"
                                    required>
                            </div>
                            <div class="form-group" style="margin-left:130px;">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" value=""
                                    style="width:450px;" required>
                            </div>
                            <button name="sure" type="submit" class="btn btn-success"><span
                                    class="glyphicon glyphicon-ok-sign"></span> Submit</button>
                            <button type="reset" class="btn btn-default pull-right" data-dismiss="modal"><span
                                    class="glyphicon glyphicon-remove"></span> No</button>
                        </div>
                </div>
            </div>
            </form>
            <div class="modal-footer ">
            </div>
        </div>
    </div>
    <div class="modal fade" id="login" role="dialog" style="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Login</h4>
                </div>
                <div class="modal-body">
                    <form name="billing" method="post" action="">
                        <div class="box-content">
                            <div class="form-group" style="width: 400px; margin-left:auto; margin-right:auto;">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" value="" style="" required>
                            </div>
                            <div class="form-group" style="width: 400px; margin-left:auto; margin-right:auto;">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" style=""></textarea>
                            </div><br>
                            <div class="form-group" style="width: 400px; margin-left:auto; margin-right:auto;">
                                <button name="login" type="submit" class="btn btn-success"><span
                                        class="glyphicon glyphicon-ok-sign" style="color: #fff;"></span> Submit</button>
                                <button type="reset" class="btn btn-default pull-right" data-dismiss="modal"><span
                                        class="glyphicon glyphicon-remove"></span> Cancel</button>
                            </div>
                        </div>
                </div>
            </div>
            </form>
            <div class="modal-footer ">
            </div>
        </div>
    </div> --}}
    <!-- header -->
    <!--<div class="header-top" style="background: #000">
		
	</div>-->
    <div class="header">
        <div class="content white">
            <nav class="navbar navbar-default">
                <div class="container" style="">
                    <div class="navbar-header animated rotateInUpRight">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href='index.php'>
                            <h1 style="padding-top: 5px;">
                                <img src="{{ asset('logo.png') }}" style="height: 40px"> ASSISTANT4U
                                <label>
                                    <h1 class="animated rotateIn"> </h1>
                                </label>
                            </h1>
                        </a>
                    </div>
                    <!--/.navbar-header-->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <nav class="link-effect-2" id="link-effect-2">
                            <ul class="nav navbar-nav">
                                <li class="active">
                                    <a href='index.php' class="effect-3">Home</a>
                                </li>
                                <li>
                                    <a href='#about' class="effect-3">About</a>
                                </li>
                                <li>
                                    <a href='#services' class="effect-3">Services</a>
                                </li>
                                <li>
                                    <a href='#contactus' class="effect-3">Contact</a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle effect-3" data-toggle="dropdown">Sign up
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('signup-page') }}">Customer portal</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('signup-page-staff') }}">Staff portal</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="{{ route('signin-page') }}" class="effect-3">Sign in</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!--/.navbar-collapse-->
                    <!--/.navbar-->
                </div>
            </nav>
        </div>
    </div>
    <!-- banner -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
            <li data-target="#myCarousel" data-slide-to="2" class=""></li>
            <li data-target="#myCarousel" data-slide-to="3" class=""></li>
            <li data-target="#myCarousel" data-slide-to="4" class=""></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="container">
                    <div class="carousel-caption">

                    </div>
                </div>
            </div>
            <div class="item item2">
                <div class="container">
                    <div class="carousel-caption">

                    </div>
                </div>
            </div>
            <div class="item item3">
                <div class="container">
                    <div class="carousel-caption">

                    </div>
                </div>
            </div>
            <div class="item item4">
                <div class="container">
                    <div class="carousel-caption">

                    </div>
                </div>
            </div>


            <div class="item item5">
                <div class="container">
                    <div class="carousel-caption">

                    </div>
                </div>
            </div>











        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="fa fa-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="fa fa-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <!-- The Modal -->
    </div>
    <!--//banner -->
    <!-- about -->
    <div class="banner-bottom-w3l" id="about">
        <div class="container">
            <div class="title-div">
                <h3 class="tittle" style="color: gray;">
                    <span>W</span>elcome
                </h3>
                <div class="tittle-style">

                </div>
            </div>
            <div class="welcome-sub-wthree">
                <div class="col-md-6 banner_bottom_left">
                    <h4 style="color: gray;">
                        <span>About</span>
                        Us
                    </h4>
                    <p>Assistant 4 U ready to help where ever u are....</p>
                    <p>Assistant 4 U helps to find Labours that needed in your daily life. We aim at resolving issues
                        like communication gap, unavailability for the customers while at the same time increasing
                        demand, hours, days and value of employability for the daily wage earnes...</p>



                </div>
                <!-- Stats-->
                <div class="col-md-6 stats-info-agile" style="border: none;">

                </div>
                <!-- //Stats -->
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //about -->
    <!-- services -->
    <div class="services" id="services" style="background: lightgray;">
        <div class="container">
            <div class="title-div">
                <h3 class="tittle" style="color: #ff003b;">
                    <span>Our</span>
                    Services
                </h3>
                <div class="tittle-style">

                </div>
            </div>
            <br>
            <div class="services-moksrow">
                <div class="col-xs-6 col-md-4 services-grids-w3l" style="margin-bottom: 25px;">
                    <div class="servi-shadow">
                        <a data-toggle="modal" data-target="#" href="#">
                            <img src="{{ asset('frontend/images/services/plumber.png') }}" style="height: 80px" />
                        </a>
                        <h4>Plumber</h4>
                        <p></p>
                    </div>
                </div>
                <div class="col-xs-6 col-md-4 services-grids-w3l" style="margin-bottom: 25px; margin-top: 0">
                    <div class="servi-shadow">
                        <a data-toggle="modal" data-target="#" href="#">
                            <img src="{{ asset('frontend/images/services/electrician.png') }}" style="height: 80px" />
                        </a>
                        <h4>Electrician</h4>
                        <p></p>
                    </div>
                </div>
                {{-- <div class="col-xs-6 col-md-4 services-grids-w3l" style="margin-bottom: 25px;">
                    <div class="servi-shadow">
                        <a data-toggle="modal" data-target="#" href="#">
                            <img src="{{ asset('frontend/images/services/builder.png') }}" style="height: 80px" />
                        </a>
                        <h4>Mason</h4>
                        <p></p>
                    </div>
                </div> --}}
                <div class="col-xs-6 col-md-4 services-grids-w3l" style="margin-bottom: 25px;">
                    <div class="servi-shadow">
                        <a data-toggle="modal" data-target="#" href="#">
                            <img src="{{ asset('frontend/images/services/carpenter.png') }}" style="height: 80px" />
                        </a>
                        <h4>Carpenter</h4>
                        <p></p>
                    </div>
                </div>
                {{-- <div class="col-xs-6 col-md-4 services-grids-w3l" style="margin-bottom: 25px;">
                    <div class="servi-shadow">
                        <a data-toggle="modal" data-target="#" href="#">
                            <img src="{{ asset('frontend/images/services/nursing.png') }}" style="height: 80px" />
                        </a>
                        <h4>Home Nurse</h4>
                        <p></p>
                    </div>
                </div> --}}
                {{-- <div class="col-xs-6 col-md-4 services-grids-w3l" style="margin-bottom: 25px;">
                    <div class="servi-shadow">
                        <a data-toggle="modal" data-target="#" href="#">
                            <img src="{{ asset('frontend/images/services/maintenance.png') }}" style="height: 80px" />
                        </a>
                        <h4>House Keeping</h4>
                        <p></p>
                    </div>
                </div> --}}
                {{-- <div class="col-xs-6 col-md-4 services-grids-w3l" style="margin-bottom: 25px;">
                    <div class="servi-shadow">
                        <a data-toggle="modal" data-target="#" href="#">
                            <img src="{{ asset('frontend/images/services/welder.png') }}" style="height: 80px" />
                        </a>
                        <h4>Welder</h4>
                        <p></p>
                    </div>
                </div> --}}
                {{-- <div class="col-xs-6 col-md-4 services-grids-w3l" style="margin-bottom: 25px;">
                    <div class="servi-shadow">
                        <a data-toggle="modal" data-target="#" href="#">
                            <img src="{{ asset('frontend/images/services/excavator.png') }}" style="height: 80px" />
                        </a>
                        <h4>JCB Operator</h4>
                        <p></p>
                    </div>
                </div> --}}
                <div class="col-xs-6 col-md-4 services-grids-w3l" style="margin-bottom: 25px;">
                    <div class="servi-shadow">
                        <a data-toggle="modal" data-target="#" href="#">
                            <img src="{{ asset('frontend/images/services/painter.png') }}" style="height: 80px" />
                        </a>
                        <h4>Painter</h4>
                        <p></p>
                    </div>
                </div><br>
                <div class="col-xs-6 col-md-4 services-grids-w3l" style="margin-bottom: 25px;">
                    <div class="servi-shadow">
                        <a data-toggle="modal" data-target="#" href="#">
                            <img src="{{ asset('frontend/images/services/mechanic.png') }}" style="height: 80px" />
                        </a>
                        <h4>Mechanic</h4>
                        <p></p>
                    </div>
                </div><br>
                {{-- <div class="col-xs-6 col-md-4 services-grids-w3l" style="margin-bottom: 25px;">
                    <div class="servi-shadow">
                        <a data-toggle="modal" data-target="#" href="#">
                            <img src="{{ asset('frontend/images/services/taxi.png') }}" style="height: 80px" />
                        </a>
                        <h4>Taxi</h4>
                        <p></p>
                    </div>
                </div><br> --}}
                <div class="col-xs-6 col-md-4 services-grids-w3l" style="margin-bottom: 25px;">
                    <div class="servi-shadow">
                        <a data-toggle="modal" data-target="#" href="#">
                            <img src="{{ asset('frontend/images/services/baby.png') }}" style="height: 80px" />
                        </a>
                        <h4>Baby Sitter</h4>
                        <p></p>
                    </div>
                </div>
                <div class="col-xs-12 services-grids-w3l" style="">
                    <h3>And more...</h3>
                </div>

            </div>
        </div>
    </div>
    </div>

    </div>

    <!-- //testimonials -->
    <!-- footer -->
    <div class="mkl_footer" id="contactus">

        <div class="sub-footer">
            <div class="container">
                <div class="title-div">
                    <h3 class="tittle">

                    </h3>
                    <h3 class="tittle" style="color: #fff;">
                        Contact
                    </h3>
                    <div class="tittle-style">

                    </div>
                </div>
                <div class="mkls_footer_grid">
                    <div class="col-xs-6 mkls_footer_grid_left" style="">
                        <h4>Mail Us:</h4>
                        <p>
                            <span>Phone : </span>+1 905-555-0199
                        </p>
                        <p>
                            <span>Email : </span>
                            <a href="#" style="color: lightgray">teamassistant4u@gmail.com</a>
                        </p>
                        <p>
                            <span>Visit : </span>
                            <a href="#" style="color: lightgray">www.assistant4u.com</a>
                        </p>
                    </div>
                    <div class="col-xs-6 mkls_footer_grid_left" style="">
                        <h4>Office Address:</h4>
                        <p>A4U Corp Suite 400, 123 Bay Street Toronto, ON M5J 2N8 Canada</p>
                        <p>Opening hours : 9am - 7pm</p>
                        <p>Sunday <span>(closed)</span></p>
                    </div>

                    <div class="clearfix"> </div>
                </div>
                <div class="botttom-nav-allah">
                    <ul>
                        <li>
                            <a href='index.php'>Home</a>
                        </li>
                        <li>
                            <a href='#about'>About</a>
                        </li>
                        <li>
                            <a href='#services'>Services</a>
                        </li>
                        <li>
                            <a href='#contactus'>Contact</a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
        <div class="footer-copy-right">
            <div class="container">
                <div class="allah-copy">
                    <p>© {{ date('Y') }} Assistant4U. All rights reserved | Design by
                        <a href="#">Team Assistant4U</a>
                    </p>
                </div>
                <div class="footercopy-social">
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/">
                                <span class="fa fa-facebook"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com">
                                <span class="fa fa-twitter"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.rss.com">
                                <span class="fa fa-rss"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.vk.com">
                                <span class="fa fa-vk"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('frontend/js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('frontend/js/numscroller-1.0.js') }}"></script>

    <script>
        $(window).load(function () {
            $("#flexiselDemo1").flexisel({
                visibleItems: 1,
                animationSpeed: 1000,
                autoPlay: false,
                autoPlaySpeed: 3000,
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: {
                    portrait: {
                        changePoint: 480,
                        visibleItems: 1
                    },
                    landscape: {
                        changePoint: 640,
                        visibleItems: 1
                    },
                    tablet: {
                        changePoint: 768,
                        visibleItems: 1
                    }
                }
            });

        });
    </script>
    <script src="{{ asset('frontend/js/jquery.flexisel.js') }}"></script>
    <!-- //Flexslider-js for-testimonials -->
    <!-- smooth scrolling -->
    <script src="{{ asset('frontend/js/SmoothScroll.min.js') }}"></script>
    <script src="{{ asset('frontend/js/move-top.js') }}"></script>
    <script src="{{ asset('frontend/js/easing.js') }}"></script>
    <!-- here stars scrolling icon -->
    <script>
        $(document).ready(function () {
            /*
                var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
                };
            */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <!-- //here ends scrolling icon -->
    <!-- smooth scrolling -->
    <!-- //js-files -->
    <script type="text/javascript">
        function sh(st) {

            var x = new XMLHttpRequest();
            x.onreadystatechange = function () {

                if (x.readyState == 4 && x.status == 200) {

                    document.getElementById('district').innerHTML = x.responseText;
                }
            };

            x.open("GET", "getDistrict.php?c=" + st, true);

            x.send();

        }

        function shi(st) {

            var x = new XMLHttpRequest();
            x.onreadystatechange = function () {

                if (x.readyState == 4 && x.status == 200) {

                    document.getElementById('districtw').innerHTML = x.responseText;
                }
            };

            x.open("GET", "getDistrict.php?c=" + st, true);

            x.send();

        }

        function shl(st) {

            var x = new XMLHttpRequest();
            x.onreadystatechange = function () {

                if (x.readyState == 4 && x.status == 200) {

                    document.getElementById('location1').innerHTML = x.responseText;

                }
            };

            x.open("GET", "get_location.php?c=" + st, true);

            x.send();

        }

        function shu(st) {

            var x = new XMLHttpRequest();
            x.onreadystatechange = function () {

                if (x.readyState == 4 && x.status == 200) {

                    document.getElementById('location').innerHTML = x.responseText;

                }
            };

            x.open("GET", "get_location.php?c=" + st, true);

            x.send();

        }
    </script>
    <script>
        function test() {
            var category = document.getElementById('category').value;
            if (category == 'She Taxi' || category == 'Taxi' || category == 'JCB Operator' || category == 'Auto') {
                $("#licence").show();
                $("#vehicle").show();
            } else {
                $("#licence").hide();
                $("#vehicle").hide();
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#category').on('change', function () {
                var category = $(this).val();
                if (category) {
                    if (category == 'She Taxi' || category == 'Taxi' || category == 'Auto') {
                        $("#vehicle").show();
                    } else {
                        $("#vehicle").hide();
                    }
                }
            });
        });
    </script>
    <script>
        document.getElementById("email").onfocusout = function fun() {
            var email = $("#email").val();
            var nemail = email.split('@');
            if (nemail[1] == 'gmail.com' || nemail[1] == 'yahoo.com' || nemail[1] == 'hotmail.com') {

            } else {
                alert("enter valid email");
                document.getElementById('email').value = '';
            }

        }

        function f1() {

        }
    </script>
</body>

</html>