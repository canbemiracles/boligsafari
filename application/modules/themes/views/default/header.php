<!-- Fixed navbar -->

    <div class="navbar navbar-inverse navbar-fixed-top headroom" >

        <div class="container">

            <div class="navbar-header">

                <!-- Button for smallest screens -->

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>

                <a class="navbar-brand" href="<?php echo site_url();?>"><img src="http://www.lejibyen.dk/logo.png" alt="Logo" style="height:40px"></a>

            </div>

            <div class="navbar-collapse collapse">



                <ul class="nav navbar-nav pull-right top-nav">

                

                        <?php
                            $CI = get_instance();
                            $CI->load->model('admin/page_model');
                            $CI->page_model->init();
                        ?>



                        <?php 
                            $alias = (isset($alias))?$alias:'';
                            foreach ($CI->page_model->get_menu() as $li) 
                            {
                                if($li->parent==0)
                                $CI->page_model->render_top_menu($li->id,0,$alias);
                            }
                        ?>


                    <?php if(is_loggedin() AND !is_admin()){?>
                    <li class="orange"><a href="<?php echo site_url('show/messages');?>">Beskeder</a></li>
                    <?php };?>
                        </li>    

                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                                <i class="fa fa-globe"></i> <b class="caret"></b>

                            </a>


 <ul class="dropdown-menu lang-menu"><li class="active"><a href="http://www.lejibyen.dk/index.php/da">Dansk</a></li><li class=""><a href="http://www.lejibyen.dk/index.php/en">English</a></li></ul>


                        </li>

                        
                    <?php if(!is_loggedin()){?>

                    <?php if(get_settings('realestate_settings','enable_signup','Yes')=='Yes'){?>

                    <li><a class="btn" data-toggle="modal" href="#myModal"><?php echo lang_key('sign_in'); ?></a></li>

                    <li><a class="btn" href="http://www.lejibyen.dk/index.php/da/account/signupform"><?php echo lang_key('sign_up'); ?></a></li>

                    <?php }?>

                    <?php }else{?>

                        <?php if(!is_admin()){?>


                        <?php }else{?>

                        <li><a class="btn" href="<?php echo site_url('admin');?>"><?php echo lang_key('admin_panel'); ?></a></li>

                        <?php }?>

                    <li><a class="btn" href="<?php echo site_url('account/logout');?>">Log ud</a></li>

                    <?php }?>

                </ul>

            </div><!--/.nav-collapse -->

        </div>

    </div> 

    <!-- /.navbar -->