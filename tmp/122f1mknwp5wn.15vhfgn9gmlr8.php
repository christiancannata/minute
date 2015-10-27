<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php echo $ENCODING; ?>"/>
    <title>Powered by</title>
    <base href="<?php echo $SCHEME.'://'.$HOST.':'.$PORT.$BASE.'/'; ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Westilo - Bootstrap Responsive Admin Template</title>
    <link type="text/css" rel="stylesheet" href="ui/css/font-awesome.css">
    <link type="text/css" rel="stylesheet" href="ui/css/material-design-iconic-font.css">
    <link type="text/css" rel="stylesheet" href="ui/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="ui/css/animate.css">
    <link type="text/css" rel="stylesheet" href="ui/css/layout.css">
    <link type="text/css" rel="stylesheet" href="ui/css/components.css">
    <link type="text/css" rel="stylesheet" href="ui/css/widgets.css">
    <link type="text/css" rel="stylesheet" href="ui/css/plugins.css">
    <link type="text/css" rel="stylesheet" href="ui/css/pages.css">
    <link type="text/css" rel="stylesheet" href="ui/css/bootstrap-extend.css">
    <link type="text/css" rel="stylesheet" href="ui/css/common.css">
    <link type="text/css" rel="stylesheet" href="ui/css/responsive.css">

    <link type="text/css" rel="stylesheet" href="ui/css/offline-theme-default-indicator.css">
    <link type="text/css" rel="stylesheet" href="ui/css/offline-language-english-indicator.css">


</head>

<body class="<?php echo Base::instance()->get('bodyClass'); ?>">


<!--Topbar Start Here-->
<?php if (isset($header)) echo $this->render($header,$this->mime,get_defined_vars()); ?>
<!--Topbar End Here-->

<!--Leftbar Start Here-->

<?php if (isset($leftBar)) echo $this->render($leftBar,$this->mime,get_defined_vars()); ?>
<section class="main-container">
    <?php if (isset($content)) echo $this->render($content,$this->mime,get_defined_vars()); ?>

    <!--Footer Start Here -->
    <?php if (isset($footer)) echo $this->render($footer,$this->mime,get_defined_vars()); ?>
    <!--Footer End Here -->
</section>


<!--Page Container End Here-->
<!--Rightbar Start Here-->
<?php if (isset($rightBar)) echo $this->render($rightBar,$this->mime,get_defined_vars()); ?>

<!--Rightbar End Here-->


<script language="javascript" src="ui/js/jquery.js"></script>
<script language="javascript" src="ui/js/bootstrap.min.js"></script>
<script src="ui/js/lib/jRespond.js"></script>
<script src="ui/js/lib/hammerjs.js"></script>
<script src="ui/js/lib/jquery.hammer.js"></script>
<script src="ui/js/lib/smoothscroll.js"></script>
<script src="ui/js/lib/smart-resize.js"></script>

<script src="ui/js/lib/jquery.validate.js"></script>
<script src="ui/js/lib/jquery.form.js"></script>
<script src="ui/js/lib/j-forms.js"></script>
<script src="ui/js/lib/login-validation.js"></script>


<script src="ui/js/lib/jquery.ui.js"></script>
<script src="ui/js/lib/nav.accordion.js"></script>
<script src="ui/js/lib/hover.intent.js"></script>
<script src="ui/js/lib/jquery.fitvids.js"></script>
<script src="ui/js/lib/scrollup.js"></script>
<script src="ui/js/lib/jquery.slimscroll.js"></script>
<!--<script src="ui/js/lib/jquery.syntaxhighlighter.js"></script>-->
<script src="ui/js/lib/velocity.js"></script>
<!--<script src="ui/js/lib/jquery-jvectormap.js"></script>
<script src="ui/js/lib/jquery-jvectormap-world-mill.js"></script>
<script src="ui/js/lib/jquery-jvectormap-us-aea.js"></script> -->
<!--iCheck-->
<script src="ui/js/lib/icheck.js"></script>
<script src="ui/js/lib/jquery.switch.button.js"></script>
<!--CHARTS-->
<script src="ui/js/lib/chart/sparkline/jquery.sparkline.js"></script>
<script src="ui/js/lib/chart/easypie/jquery.easypiechart.min.js"></script>
<script src="ui/js/lib/chart/flot/excanvas.min.js"></script>
<script src="ui/js/lib/chart/flot/jquery.flot.min.js"></script>
<script src="ui/js/lib/chart/flot/curvedLines.js"></script>
<script src="ui/js/lib/chart/flot/jquery.flot.time.min.js"></script>
<script src="ui/js/lib/chart/flot/jquery.flot.stack.min.js"></script>
<script src="ui/js/lib/chart/flot/jquery.flot.axislabels.js"></script>
<script src="ui/js/lib/chart/flot/jquery.flot.resize.min.js"></script>
<script src="ui/js/lib/chart/flot/jquery.flot.tooltip.min.js"></script>
<script src="ui/js/lib/chart/flot/jquery.flot.spline.js"></script>
<script src="ui/js/lib/chart/flot/jquery.flot.pie.min.js"></script>
<!--Forms-->
<script src="ui/js/lib/jquery.maskedinput.js"></script>
<script src="ui/js/lib/jquery.validate.js"></script>
<script src="ui/js/lib/jquery.form.js"></script>
<script src="ui/js/lib/j-forms.js"></script>
<script src="ui/js/lib/jquery.loadmask.js"></script>
<!--<script src="ui/js/lib/vmap.init.js"></script>
<script src="ui/js/lib/theme-switcher.js"></script>-->
<script src="ui/js/lib/offline.min.js"></script>
<script src="ui/js/lib/select2.full.js"></script>

<script src="ui/js/lib/bootstrap-datepicker.js"></script>
<script src="ui/js/lib/moment.js"></script>
<script src="ui/js/lib/daterangepicker.js"></script>

<script src="//js.pusher.com/2.2/pusher.min.js"></script>

<script src="ui/js/lib/notify.min.js"></script>
<script src="ui/js/lib/pouchdb-4.0.3.min.js"></script>
<script src="ui/js/apps.js"></script>
</body>


</html>
