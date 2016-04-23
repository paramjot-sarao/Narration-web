<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $page_title;?></title>

  <!-- Bootstrap Core CSS -->
    <link href="<?php echo site_url('assets/sbadmin/bower_components/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo site_url('assets/sbadmin/bower_components/metisMenu/dist/metisMenu.min.css');?>" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo site_url('assets/sbadmin/dist/css/timeline.css');?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo site_url('assets/sbadmin/dist/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo site_url('assets/sbadmin/bower_components/morrisjs/morris.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo site_url('assets/sbadmin/bower_components/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    
    <link href="<?php echo site_url('assets/sbadmin/dist/css/admin.css');?>" rel="stylesheet" type="text/css">

    <?php
    // Grocery CRUD scripts
    if ( !empty($output) )
    {
      foreach ($output->css_files as $file)
        echo "<link href='$file' rel='stylesheet'>".PHP_EOL;
    }
  ?>
   <link href="<?php echo site_url('assets/sbadmin/dist/css/jquery-ui.css');?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php //$asset_url = base_url('assets'); ?>
    <!--
    <script type="text/javascript">
     var asset_url = "<?php echo $asset_url;?>";
    </script> -->
<?php echo $before_head;?>
</head>
<body>
<?php
if($this->ion_auth->logged_in()) {
?>

<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <?php $site = $this->config->item('site');
        $user_role = $this->ion_auth->get_users_groups()->row()->name;
            //  var_dump($menu); ?>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url('admin'); ?>"><?php echo $site['short_name'];?> <?php echo ucfirst($user_role);?> Panel</a>
            </div>
            <!-- /.navbar-header -->
            <?php 

            
        
            switch ($user_role) {
                  case 'admin':
                    $menu = $site['admin_menu'];  ?>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                               <i class="fa fa-user fa-fw"></i> Accounts <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="<?php echo site_url('admin/users'); ?>"><i class="fa fa-user fa-fw"></i> Users</a>
                                </li>
                                <li><a href="<?php echo site_url('admin/groups'); ?>"><i class="fa fa-gear fa-fw"></i> Groups</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="<?php echo site_url('admin/user/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!-- /.dropdown -->
                    </ul>
                    <!-- /.navbar-top-links -->
                    <?php
              
                      break;

                       case 'members':
                    $menu = $site['member_menu'];  ?>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                               <i class="fa fa-user fa-fw"></i> Accounts <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="<?php echo site_url('admin/user/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!-- /.dropdown -->
                    </ul>
                    <!-- /.navbar-top-links -->
                    <?php
              
                      break;
                  
                  default:
                      # code...
                      break;
              }      

            ?>

            

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php foreach ($menu as $parent => $parent_params): ?>

                          <?php if (empty($parent_params['children'])): ?>

                            <?php //$active = ($thi->uri->uri_string()==$parent_params['url'] || $ctrler==$parent); ?>
                            <li class='<?php /*if ($active) */ //echo 'active'; ?>'>
                              <a href='<?php echo site_url($parent_params['url']); ?>'>
                                <i class='<?php echo $parent_params['icon']; ?>'></i> <?php echo $parent_params['name']; ?>
                              </a>
                            </li>

                          <?php else: ?>

                            <?php // $parent_active = ($ctrler==$parent); ?>
                            <li class='treeview <?php /*if ($parent_active)*/ //echo 'active'; ?>'>
                              <a href='#'>
                                <i class='<?php echo $parent_params['icon']; ?>'></i> <?php echo $parent_params['name']; ?> <i class='fa fa-angle-left pull-right'></i>
                              </a>
                              <ul class='treeview-menu'>
                                <?php foreach ($parent_params['children'] as $name => $url): ?>
                                  <?php //$child_active = ($current_uri==$url); ?>
                                  <li <?php /*if ($child_active)*/ //echo 'class="active"'; ?>>
                                    <a href='<?php echo site_url($url); ?>'> <?php echo $name; ?></a>
                                  </li>
                                <?php endforeach; ?>
                              </ul>
                            </li>

                          <?php endif; ?>

                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side for admin-->
   
            <!-- Section for seedgrower -->
        
            
           
        </nav>

<?php } ?>


    <!-- /#wrapper -->