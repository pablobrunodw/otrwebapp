<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>OTR Group</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        
        <!-- FontAwesome 4.3.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />       
        <!-- Ionicons 2.0.0 -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
        <!-- Theme style -->
        <link href=<?php echo PATH_VISTA.'assets/dist/css/AdminLTE.min.css'; ?> rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href=<?php echo PATH_VISTA.'assets/dist/css/skins/_all-skins.min.css'; ?> rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href=<?php echo PATH_VISTA.'assets/plugins/iCheck/flat/blue.css'; ?> rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href=<?php echo PATH_VISTA.'assets/plugins/morris/morris.css'; ?> rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href=<?php echo PATH_VISTA.'assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css'; ?> rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href=<?php echo PATH_VISTA.'assets/plugins/datepicker/datepicker3_blue.css'; ?> rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href=<?php echo PATH_VISTA.'assets/plugins/daterangepicker/daterangepicker-bs3.css'; ?> rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href=<?php echo PATH_VISTA.'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'; ?> rel="stylesheet" type="text/css" />
        <!-- treeview -->
        <link href=<?php echo PATH_VISTA.'assets/plugins/treeview/treeview.css'; ?> rel="stylesheet" type="text/css" />                
        <!-- select -->
        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
        <!-- datatable -->        
        <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">

        <!-- favicom -->
        <link rel="shortcut icon" href=<?php echo PATH_VISTA.'assets/dist/img/logo-otr.png'; ?>>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>        
        <![endif]-->        

        <style>
            .nopadding {
               padding: 0 !important;
               margin: 0 !important;
            }
        </style>
    </head>

    <body class="sidebar-mini wysihtml5-supported skin-black sidebar-collapse">        
        <div class="wrapper">

            <!-- jQuery 2.1.3 -->
            <script src=<?php echo PATH_VISTA.'assets/plugins/jQuery/jQuery-2.1.3.min.js'; ?>></script>
            <!-- jQuery UI 1.11.2 -->
            <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>                    

            <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
            <script>
              $.widget.bridge('uibutton', $.ui.button);
            </script>

            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

            <!-- Morris.js charts -->
            <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
            <script src=<?php echo PATH_VISTA.'assets/plugins/morris/morris.min.js'; ?> type="text/javascript"></script>
            <!-- Sparkline -->
            <script src=<?php echo PATH_VISTA.'assets/plugins/sparkline/jquery.sparkline.min.js'; ?> type="text/javascript"></script>
            <!-- jvectormap -->
            <script src=<?php echo PATH_VISTA.'assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'; ?> type="text/javascript"></script>
            <script src=<?php echo PATH_VISTA.'assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'; ?> type="text/javascript"></script>
            <!-- jQuery Knob Chart -->
            <script src=<?php echo PATH_VISTA.'assets/plugins/knob/jquery.knob.js'; ?> type="text/javascript"></script>
            <!-- daterangepicker -->
            <script src=<?php echo PATH_VISTA.'assets/plugins/daterangepicker/daterangepicker.js'; ?> type="text/javascript"></script>
            <!-- datepicker -->
            <script src=<?php echo PATH_VISTA.'assets/plugins/datepicker/bootstrap-datepicker.js'; ?> type="text/javascript"></script>
            <script src=<?php echo PATH_VISTA.'assets/plugins/datepicker/locales/bootstrap-datepicker.es.js'; ?> charset="UTF-8"></script>
            <!-- iCheck -->
            <script src=<?php echo PATH_VISTA.'assets/plugins/iCheck/icheck.min.js'; ?> type="text/javascript"></script>
            <!-- Slimscroll -->
            <script src=<?php echo PATH_VISTA.'assets/plugins/slimScroll/jquery.slimscroll.min.js'; ?> type="text/javascript"></script>
            <!-- FastClick -->
            <script src=<?php echo PATH_VISTA.'assets/plugins/fastclick/fastclick.min.js'; ?>></script>
            <!-- AdminLTE App -->
            <script src=<?php echo PATH_VISTA.'assets/dist/js/app.min.js'; ?> type="text/javascript"></script>
            <!-- CK Editor -->
            <script src="//cdn.ckeditor.com/4.4.3/full/ckeditor.js"></script>
            <!-- Treeview -->
            <script src=<?php echo PATH_VISTA.'assets/plugins/treeview/treeview.js'; ?>></script>
            <!-- Select -->                                      
            <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
            <!-- datatable -->                        
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
            
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">