<?php
error_reporting(false);
$pageTitle='Main page';
  include 'init.php';
  $bodybackground = '';
  include $tpl.'header.php';
  
?>

    <!-- home section -->

    <section class="home-full" id="home">
        <!-- navbar  bg-light-->

        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light navabarfull">
            <a class="navbar-brand logo" href="#">eCommerce</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse links" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item  active">
                        <a class="nav-link navlink " href="#home">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item nav-item1">
                        <a class="nav-link navlink" href="#about">About</a>
                    </li>
                    <li class="nav-item nav-item1">
                        <a class="nav-link navlink" href="#ourfeatures">Our Features</a>
                    </li>
                    <li class="nav-item nav-item1">
                        <a class="nav-link" href="#contactus">Contact us</a>
                    </li>
                    <li class="nav-item nav-item1 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-expanded="false">
                            Product
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="login.php">Laptops</a>
                            <a class="dropdown-item" href="login.php">Tablets</a>
                            <a class="dropdown-item" href="login.php">Phones</a>
                        </div>
                    </li>
                    <li class="nav-item nav-item1">
                        <a class="nav-link" href="register.php">Create account</a>
                    </li>
                    <li class="nav-item nav-item1">
                        <form action="" method="POST">
                        <input type="submit" class="btn btn-info log-in " name="loog"  value="Log in">
                        </form>
                        <?php
                       if(isset($_POST['loog']) || isset($_POST['log2'])){
                          header('Location: login.php ');
                       }
                       if(isset($_POST['acc'])){
                        header('Location: register.php ');
                       }
                       ?>
                    </li>
                </ul>

            </div>
        </nav>

        <!--  Home content -->
        <div class="home">
            <div class="home-content">
                <h1 class="title-home">Welcome To Our Site</h1>
                <p class="home-desc">
                    Tüm uluslararası markalardan elektronik cihazlarının (bilgisayar, akıllı cihaz ve tablet gibi)
                     internet üzerinden rekabetçi fiyatlarla satışına yönelik bir web sitesidir.
                </p>
                <div class="btns">
                    <form action="" method="POST">
                    <input type="submit" class="btn btn-first btn1 " name="acc" value="new account"/>
                    <input type="submit" class="btn btn-secound btn1" name="log2" value="Login"/>
                    </form>
                    <?php
                     

                    ?>
                </div>
            </div>
        </div>

    </section>
    <!-- end home section -->

    <!-- About Section -->
    <section class="about" id="about">

        <div class="container">
            <h2 class="title text-center mt-4">About</h2>
            <span class="line mb-5"></span>
            <div class="row">

                <div class="col-md-5 col-12">
                    <div class="about-cont">
                        İnternet üzerinden bilgisayar, tablet,
                         mobil cihaz gibi elektronik cihazların ve tüm uluslararası markaların satışına yönelik bir web sitesi.
                         <br><br>
                         Müşterilerin kullanması kolay olacak güzel tasarlanmış ve etkili bir web sitesi.
                         <br><br>
                         Müşterinin maruz kalabileceği herhangi bir sorunu çözmek için eksiksiz ve uzman bir ekip.
                         Bizimle her an iletişim kurma imkanı.

                    </div>

                </div>
                <div class="col-md-7 col-12">
                    <div class="about-img">
                        <img src="layout/images/eticaret2.jpg" alt="aboutfoto" height="380px">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About section-->


    <!-- Our features section-->
    <section class="ourfeatures" id="ourfeatures">
        <div class="container">

          
            <h2 class="title text-center fe-titile ">Our Features</h2>
          
           <span class="line1"></span>
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="card mb-5">
                        <img src="layout/images/f1.jpg" class="card-img-top" alt="foto" height="270px">
                        <div class="card-body">
                            <h5 class="card-title">Delivery Speed</h5>
                            <p class="card-text">Siparişiniz üç günü geçmeyen bir süre içinde teslim edilecektir.Türkiye genelinde dağıtılan çok sayıda teslimat aracı nedeniyle.
                                of the card's content.</p>
                        </div>

                    </div>

                </div>
                <div class="col-md-4 col-12">
                    <div class="card mb-5">
                        <img src="layout/images/p5.jpg" class="card-img-top" alt="foto" height="270px">
                        <div class="card-body">
                            <h5 class="card-title">High Quality</h5>
                            <p class="card-text"> Paketleme ve teslimat konusunda kapsamlı deneyime sahip özel bir ekip.Siparişinizin hasarsız ve yüksek verimle ulaşmasını sağlamak.
                                of the card's content.</p>
                        </div>

                    </div>

                </div>
                <div class="col-md-4 col-12">
                    <div class="card mb-5">
                        <img src="layout/images/fiyat2.jpg" class="card-img-top" alt="foto" height="270px">
                        <div class="card-body">
                            <h5 class="card-title">Suitable prices</h5>
                            <p class="card-text">Büyük miktarlarda satın alırsanız indirimlere ek olarak tüm ürünlerimizi rekabetçi fiyatlarla sunuyoruz
                                of the card's content.</p>
                        </div>

                    </div>

                </div>
            </div>
    </section>
    <!-- End our feature section -->

    <!-- Contact us section -->
    <section class="contact" id="contactus">

        <div class="container">
            <h2 class="title text-center">Contact Us</h2>
            <span class="line1 mb-5"></span>
            <form id="myForm" >
                <div class="row">

                    <div class="col-md-6 col-12">
                        <div class="">
                            <div class="sent-not"></div>
                            <div class="form-group mb-4">
                                <label for="email mb-3">E-posta :</label>
                                <input type="email" class="form-control input-connect" name="email" id="email"
                                    placeholder="Enter your Email" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="fullname">Full Name :</label>
                                <input type="text" class="form-control input-connect" name="name" id="name"
                                    placeholder="Enter your full name">
                            </div>
                            <div class="form-group mb-4">
                                <label for="subject">Subject :</label>
                                <input type="text" class="form-control input-connect" name="subject" id="subject"
                                    placeholder="Enter the subject">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="message">
                            <div class="form-group">
                                <label for="message">The Message:</label>
                                <textarea class="form-control" name="body" id="body" rows="9"
                                    placeholder="Enter your Mesage"></textarea>
                            </div>

                        </div>
                    </div>
                    <button type="button" onclick="sendEmail()" class="btn btn-info btnsend">send message</button>
                    
            <script type="text/javascript">
                        function sendEmail(){
                            var name = $("#name");
                            var email = $("#email");
                            var subject = $("#subject");
                            var body = $("#body");
                            
                            if(isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)){
                                $.ajax({
                                        url:'sendEmail.php',
                                        method:'POST',
                                        dataType:'json',
                                        data:{
                                            name: name.val(),
                                            email:email.val(),
                                            subject: subject.val(),
                                            body: body.val()
                                        }, success:function(response){
                                            $('#myForm')[0].reset();
                                            $('.sent-not').text("Message sent successfully.");


                                        }
                                });
                            }

                        }
                        function isNotEmpty(caller){
                            if(caller.val() == ""){
                                caller.css('border','1px solid red');
                                return false;
                            }else{
                                caller.css('border','');
                                return true;
                            }

                        }
                         </script>
                </div>
            </form>
           
        </div>
    </section>
    <!-- End Contact us section -->
    <!-- Footer Section -->
       <div class="footer">
           <ul class="footer-lists">
               <li><a href=""><i class="fa fa-facebook"></i></a></li>
               <li><a href=""><i class="fa fa-instagram"></i></a></li>
               <li><a href=""><i class="fa fa-twitter"></i></a></li>
               <li><a href=""><i class="fa fa-youtube"></i></a></li>
               <li><a href=""><i class="fa fa-linkedin"></i></a></li>
               <li><a href=""><i class="fa fa-google-plus"></i></a></li>
           </ul>
          <p class="pa">copyright &copy; 2021 all right reserved </p>
       </div>

   <!-- End Footer Section -->
   

   <?php
   
  include $tpl.'footer.php';

?>
