<h1 class="detail-title"><i class="fa fa-user"></i>&nbsp;Opret lejeprofil</h1>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div style="clear:both"></div>

                            <div style="clear:both;margin-top:-20px;"></div>
                            <?php
                            $fb_enabled = get_settings('realestate_settings','enable_fb_login','No');
                            $gplus_enabled = get_settings('realestate_settings','enable_gplus_login','No');
                            if($fb_enabled=='Yes' || $gplus_enabled=='Yes'){
                            ?>

                            <!-- Social Logins-->
                            <div style="height: 1px; background-color: #fff; text-align: center">
                              <span style="background-color:#fff; position: relative; top: -12px; font-size:16px;padding:0px 8px;">
                                <?php echo lang_key('signup_with_social_account');?>
                              </span>
                            </div>
                            <div style="text-align:center;">
                                <br>
                                <?php if($fb_enabled=='Yes'){?>
                                <a class="fb-signup" href="<?php echo site_url('account/newaccount/fb');?>">
                                    <img src="<?php echo theme_url();?>/assets/social-icons/facebook_login.png"
                                    data-toggle="tooltip" data-placement="top" data-original-title="Login with facebook"/>
                                </a>
                                <?php }?>
                                <?php if($gplus_enabled=='Yes'){?>
                                <a href="<?php echo site_url('account/newaccount/google_plus');?>">
                                    <img src="<?php echo theme_url();?>/assets/social-icons/google+.png"
                                    data-toggle="tooltip" data-placement="top" data-original-title="Login with google"/>
                                </a>
                                <?php }?>
                            </div>
                            <hr>
                            <?php 
                            }
                            ?>
                            
                            <!-- Email Logins-->
                            <form action="<?php echo site_url('account/register/');?>" method="post">
                                <input type="hidden" name="package_id" value="<?php echo (isset($package->id))?$package->id:'';?>">
                                <input type="hidden" name="user_type" class="user_type" value="<?php echo (set_value('user_type')!='')?set_value('user_type'):'dealer';?>">
                                <div class="top-margin">
                                    <label><?php echo lang_key('first_name'); ?></label>
                                    <input type="text" name="first_name" value="<?php echo set_value('first_name');?>" class="form-control">
                                </div>
                                <?php echo form_error('first_name');?>
                                <div class="top-margin">
                                    <label><?php echo lang_key('last_name'); ?></label>
                                    <input type="text"name="last_name" value="<?php echo set_value('last_name');?>" class="form-control">
                                </div>
                                <?php echo form_error('last_name');?>
                                <div class="top-margin">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="text" name="useremail" value="<?php echo set_value('useremail');?>" class="form-control">
                                </div>
                                <?php echo form_error('useremail');?>
                                <div class="top-margin">
                                    <label>Brugernavn <span class="text-danger">*</span></label>
                                    <input type="text" name="username" value="<?php echo set_value('username');?>" class="form-control">
                                </div>
                                <?php echo form_error('username');?>
                                <div class="top-margin">
                                    <label><?php echo lang_key('gender');?> <span class="text-danger">*</span></label>
                                    <?php $curr_value=(set_value('gender')!='')?set_value('gender'):$this->session->userdata('gender');?>
                                    <select class="form-control" name="gender">
                                        <?php $sel=($curr_value=='male')?'selected="selected"':'';?>
                                        <option value="male" <?php echo $sel;?>>Mand</option>
                                        <?php $sel=($curr_value=='female')?'selected="selected"':'';?>
                                        <option value="female" <?php echo $sel;?>>Kvinde</option>
                                    </select>    
                                </div>
                                <div class="top-margin">
                                    <label><?php echo lang_key('phone'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" value="<?php echo set_value('phone');?>" class="form-control">
                                </div>

                               

                                <div class="row top-margin">
                                    <div class="col-sm-6">
                                        <label><?php echo lang_key('password');?> <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control">
                                        <?php echo form_error('password');?>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Gentag password <span class="text-danger">*</span></label>
                                        <input type="password" name="repassword" class="form-control">
                                        <?php echo form_error('repassword');?>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-lg-8">
                                        <input type="hidden" name="terms_conditon" id="terms_conditon" value="<?php echo (isset($_POST['terms_conditon_field']))?$_POST['terms_conditon_field']:'';?>">
                                        <label style="margin-right:10px; margin-top:-1px;" class="checkbox">
                                            <input type="checkbox" name="terms_conditon_field" id="terms_conditon_field" <?php echo (isset($_POST['terms_conditon_field']))?'checked':'';?>> 
                                            Jeg accepterer <a target="_blank" href="<?php echo site_url('show/page/betingelser');?>">handelsbetingelserne</a> og mit køb kan overgå til abonnement.
                                        </label>
                                        <?php echo form_error('terms_conditon');?>                        
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <button class="btn btn-action" style="margin-left:-50px;" type="submit">Opret lejeprofil</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>        

    </div>    
</div> <!-- /row -->
<script type="text/javascript">
jQuery(document).ready(function(e){
    jQuery('#terms_conditon_field').click(function(e){
        var val = jQuery(this).attr('checked');
        jQuery('#terms_conditon').val(val);

    });


   
});
</script>
