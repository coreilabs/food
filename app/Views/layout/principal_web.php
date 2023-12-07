<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<!-- BEGIN head -->


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

    <!-- Meta tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Food | <?= $this->renderSection('titulo'); ?></title>

    <!-- Stylesheets -->
    <link href="<?= site_url('web/')?>src/assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" media="all" />
    <link href="<?= site_url('web/')?>src/assets/css/bootstrap-theme.min.css" type="text/css" rel="stylesheet" media="all" />
    <link href="<?= site_url('web/')?>src/assets/css/fonts.css" type="text/css" rel="stylesheet" />
    <link href="<?= site_url('web/')?>src/assets/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
    <link href="<?= site_url('web/')?>src/assets/css/slick.css" type="text/css" rel="stylesheet" />
    <link href="<?= site_url('web/')?>src/assets/css/slick-theme.css" type="text/css" rel="stylesheet" />
    <link href="<?= site_url('web/')?>src/assets/css/aos.css" type="text/css" rel="stylesheet" />
    <link href="<?= site_url('web/')?>src/assets/css/scrolling-nav.css" type="text/css" rel="stylesheet" />
    <link href="<?= site_url('web/')?>src/assets/css/bootstrap-datepicker.css" type="text/css" rel="stylesheet" />
    <link href="<?= site_url('web/')?>src/assets/css/bootstrap-datetimepicker.css" type="text/css" rel="stylesheet" />
    <link href="<?= site_url('web/')?>src/assets/css/touch-sideswipe.css" type="text/css" rel="stylesheet" />
    <link href="<?= site_url('web/')?>src/assets/css/jquery.fancybox.css" type="text/css" rel="stylesheet" />
    <link href="<?= site_url('web/')?>src/assets/css/main.css" type="text/css" rel="stylesheet" />
    <link href="<?= site_url('web/')?>src/assets/css/responsive.css" type="text/css" rel="stylesheet" />
   
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= site_url('web/')?>src/assets/img/favicon/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="256x256"  href="<?= site_url('web/')?>src/assets/img/favicon/android-chrome-256x256.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= site_url('web/')?>src/assets/img/favicon/android-chrome-192x192.png">    
    <link rel="icon" type="image/png" sizes="32x32" href="<?= site_url('web/')?>src/assets/img/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= site_url('web/')?>src/assets/img/favicon/favicon-16x16.png" />
    <link rel="icon" type="image/png" href="<?= site_url('web/')?>src/assets/img/favicon/favicon.ico" />
    <link rel="manifest" href="<?= site_url('web/')?>src/assets/img/site.html" />
    <link rel="mask-icon" href="<?= site_url('web/')?>src/assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5" />
    <meta name="msapplication-TileColor" content="#990100" />
    <meta name="theme-color" content="#ffffff" />   
    
    <style>
        .navbar-nav > li > a {
            line-height:30px;
        }
        .btn-food{
            background-color: #990100;
            color: white !important;
            font-family: 'Montserrat-Bold';
        }

        .containerprincipal {
            margin-top:6em;            
        }
        .navigation{
            background-color: #990100;
        }

        @media only screen and (min-width: 1200px) {
            .containerprincipal {
            margin-top:11em;            
        }

        .alert {
            margin-top:2em;
        }

            #main-carousel {
                margin-top:-20px;
            }
        }
    </style>

    <!-- Essa Section renderizará os estilos específicos da View que estender este layout -->

    <?= $this->renderSection('estilos'); ?>

</head>
<!-- END head -->

<!-- BEGIN body -->

<body data-spy="scroll" data-target=".navbar" data-offset="50">
  
    <!-- BEGIN  Loading Section -->  
    <div class="loading-overlay">
        <div class="spinner">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- END Loading Section -->    

    <!-- BEGIN body wrapper -->
    <div class="body-wrapper">

        <!-- Begin header-->
        <header id="header">


            <!-- BEGIN navigation -->
            <div class="navigation">

                <div class="navbar-container" data-spy="affix" data-offset-top="400">
                    <div class="container">

                        <div class="navbar_top hidden-xs">
                            <div class="top_addr">
                                <span><i class="fa fa-map-marker" aria-hidden="true"></i> Your country, your city, 12345</span>
                                <span><i class="fa fa-phone" aria-hidden="true"></i> 123 456 789</span>
                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> 11:00 - 21:00</span>
                                <div class="pull-right search-block">
                                    <i class="fa fa-search" id="search" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div id="navbar_search">
                                <form method="post">
                                    <input type="text" name="q" class="form-control pull-left" value="" placeholder="Search anything">
                                    <button type="submit" class="pull-right close" id="search_close"><i class="fa fa-close"></i></button>
                                </form>
                            </div>
                        </div>
                        <!-- /.navbar_top -->

                        <!-- BEGIN navbar -->
                        <nav class="navbar">
                            <div id="navbar_content">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <a class="navbar-brand" href="#">
                                        <img src="<?= site_url('web/')?>src/assets/img/logo.png" alt="logo" />
                                    </a>
                                    <a href="#cd-nav" class="cd-nav-trigger right_menu_icon">
                                        <span><i class="fa fa-bars" aria-hidden="true"></i></span>
                                    </a>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="navbar">
                                    <div class="navbar-right">
                                        <ul class="nav navbar-nav">
                                            <li><a class="page-scroll" href="#header">Home</a></li>
                                            <li><a class="page-scroll" href="#about_us">About</a></li>
                                        
                                            <li><a class="page-scroll" href="#gallery">Gallery</a></li>
                                           
                                            <li><a class="page-scroll" href="#footer">Contact</a></li>

                                           
                                                <?php if(session()->has('carrinho') && count(session()->get('carrinho')) > 0) :?>
                                            <li>
                                                <a class="page-scroll" href="<?= site_url('carrinho')?>">
                                                    <i class="fa fa-shopping-cart fa-2x"></i>
                                                    <span style="font-size:25px !important;font-family: 'Montserrat-Bold'">

                                                        <?= count(session()->get('carrinho'))?>

                                                    </span>
                                                </a>
                                            </li>
                                            <?php endif;?>

                                            <?php if(usuario_logado()) :?>
                                                <li><a class="page-scroll" href="<?= site_url('conta')?>">Minha Conta</a></li>
                                                <li><a class="page-scroll" href="<?= site_url('login/logout')?>">Sair</a></li>

                                            <?php else:?>

                                                <li><a class="page-scroll" href="<?= site_url('login')?>">Entrar</a></li>
                                                <li><a class="page-scroll" href="<?= site_url('registrar')?>">Criar Conta</a></li>

                                            <?php endif;?>




                                        </ul>
                                    </div>
                                </div>
                                <!-- /.navbar-collapse -->
                            </div>
                        </nav>
                    </div>
                    <!-- END navbar -->
                </div>
                <!-- /.navbar-container -->
            </div>
            <!-- END navigation -->

        </header>
        <!-- End header -->

<div class="container containerprincipal" >

<?php if(session()->has('sucesso') ): ?>

<div class="alert alert-success" role="alert"><?= session('sucesso')?></div>

<?php endif; ?>

<?php if(session()->has('info') ): ?>

<div class="alert alert-info" role="alert"><?= session('info')?></div>

<?php endif; ?>

<?php if(session()->has('atencao') ): ?>

<div class="alert alert-danger" role="alert"><?= session('atencao')?></div>

<?php endif; ?>

<?php if(session()->has('fraude') ): ?>

<div class="alert alert-warning" role="alert"><?= session('fraude')?></div>

<?php endif; ?>

<!-- captura os erros de csrf - acao nao permitida-->

<?php if(session()->has('error') ): ?>

<div class="alert alert-danger" role="alert"><?= session('error')?></div>

<?php endif; ?>

</div>

    <?= $this->renderSection('conteudo');?>

        <!--  Begin Footer  -->
        <footer id="footer">

            <!--    Contact    -->

            <!--    Google map, Social links    -->
            <div class="section" id="contact">
                <div id="googleMap"></div> 
                <div class="footer_pos">
                    <div class="container">
                        <div class="footer_content">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <h4 class="footer_ttl footer_ttl_padd">about us</h4>
                                    <p class="footer_txt">Lorem Ipsum is simply dummy text of the printing and typesetting industry. It has survived not only five centuries but also the leap into electronic typesetting. </p>
                                </div>
                                <div class="col-sm-6 col-md-6">

                                <?php $expedientes = expedientes();?>

                                    <h4 class="footer_ttl footer_ttl_padd">Horário de Funcionamento</h4>
                                    <div class="footer_border">

                                    <?php foreach($expedientes as $dia):?>

                                        <div class="week_row clearfix">
                                            <div class="week_day"><?= esc($dia->dia_descricao)?></div>

                                            <?php if($dia->situacao == 0):?>
                                            
                                            <div class="week_time text-left"><?= $dia->situacao == 1 ? "Aberto" : "Fechado";?></div>
                                            <?php else:?>
                                                <div class="week_time">
                                                <span class="week_time_start"><?= esc($dia->abertura)?></span>
                                                <span class="week_time_node">-</span>
                                                <span class="week_time_end"><?= esc($dia->fechamento)?></span>
                                            </div>
                                            <?php endif;?>

                                        </div>


                                        <div class="week_row clearfix">
                                      
                       
                                        </div>
                                    <?php endforeach;?>
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <h4 class="footer_ttl footer_ttl_padd">contact us</h4>
                                    <div class="footer_border">
                                        <div class="footer_cnt">
                                            <i class="fa fa-map-marker"></i>
                                            <span>Your City, Your streert, 18765, 100 Tenth Avenue, New York City, NY 1001</span>
                                        </div>
                                        <div class="footer_cnt">
                                            <i class="fa fa-phone"></i>
                                            <span>(457) 570 5682; (385) 620 756</span>
                                        </div>
                                        <div class="footer_cnt">
                                            <i class="fa fa-envelope"></i>
                                            <span>info@butazzopizza.net</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="copyright">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="copy_text">
                                        <a target="_blank" href="https://www.templateshub.net">Templates Hub</a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="social-links">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a href="javascript:;" title="">
                                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:;" title="">
                                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:;" title="">
                                                    <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:;" title="">
                                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- End Footer -->

    </div>
    <!-- END body-wrapper -->


    <!-- START mobile right burger menu -->

    <nav class="cd-nav-container right_menu" id="cd-nav">
        <div class="header__open_menu">
            <a href="index-2.html" class="rmenu_logo" title="yagmurmebel.az">
                <img src="<?= site_url('web/')?>src/assets/img/logo.png" alt="logo" />
            </a>
        </div>
        <div class="right_menu_search">
            <form method="post">
                <input type="text" name="q" class="form-control search_input" value="" placeholder="Search anything">
                <button type="submit" class="search_icon"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <ul class="rmenu_list">
            <li><a class="page-scroll" href="#header">Home</a></li>
            <li><a class="page-scroll" href="#about_us">About</a></li>
            <li><a class="page-scroll" href="#menu">Menus</a></li>
            <li><a class="page-scroll" href="#gallery">Gallery</a></li>
            <li><a class="page-scroll" href="#reservation">Reservation</a></li>
            <li><a class="page-scroll" href="#footer">Contact</a></li>
        </ul>
        <div class="right_menu_addr top_addr">
            <span><i class="fa fa-map-marker" aria-hidden="true"></i> Your country, your city, 12345</span>
            <span><i class="fa fa-phone" aria-hidden="true"></i> 123 456 789</span>
            <span><i class="fa fa-clock-o" aria-hidden="true"></i> 11:00 - 21:00</span>
        </div>
    </nav>

    <div class="cd-overlay"></div>
    <!-- /.cd-overlay -->
         

    <!-- END mobile right burger menu -->

    <!-- JavaScript -->
    <script src="<?= site_url('web/')?>src/assets/js/jquery-2.1.1.min.js"></script>
    <script src="<?= site_url('web/')?>src/assets/js/bootstrap.min.js"></script>
    <script src="<?= site_url('web/')?>src/assets/js/jquery.mousewheel.min.js"></script>
    <script src="<?= site_url('web/')?>src/assets/js/jquery.easing.min.js"></script>
    <script src="<?= site_url('web/')?>src/assets/js/scrolling-nav.js"></script>
    <script src="<?= site_url('web/')?>src/assets/js/aos.js"></script>
    <script src="<?= site_url('web/')?>src/assets/js/slick.min.js"></script>
    <script src="<?= site_url('web/')?>src/assets/js/jquery.touchSwipe.min.js"></script>
    <script src="<?= site_url('web/')?>src/assets/js/moment.js"></script>
    <script src="<?= site_url('web/')?>src/assets/js/bootstrap-datepicker.js"></script>
    <script src="<?= site_url('web/')?>src/assets/js/bootstrap-datetimepicker.js"></script>
    <script src="<?= site_url('web/')?>src/assets/js/jquery.fancybox.js"></script>
    <script src="<?= site_url('web/')?>src/assets/js/loadMoreResults.js"></script>
    <script src="<?= site_url('web/')?>src/assets/js/main.js"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcg5Y2D1fpGI12T8wcbtPIsyGdw-_NV1Y&amp;callback=myMap"></script> -->

    <!-- Essa Section renderizará os scripts específicos da View que estender este layout -->
    <?= $this->renderSection('scripts'); ?>


</body>

</html> 