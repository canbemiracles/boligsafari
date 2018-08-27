<h1 class="detail-title"><i class="fa fa-user"></i>&nbsp;<?php echo lang_key('choose_a_package'); ?></h1>
<div class="row">
    <div class="col-md-12">
        <?php 
        if($packages->num_rows()<=0){
        ?>
            <div class="alert alert-danger"><?php echo lang_key('no_package_found'); ?></div>
        <?php    
        }
        else
        {
        ?>
        <?php echo $this->session->flashdata('msg');?>
        <?php foreach($packages->result() as $package):?>
            <?php $action = (isset($alias) && $alias=='renew')?site_url('account/renewpackage'):site_url('account/takepackage');?>
            <form action="<?php echo $action;?>" method="post">
                <input type="hidden" name="package_id" value="<?php echo $package->id;?>">
                <div class="col-md-4 col-sm-4">
                    <div class="thumbnail thumb-shadow green">
                        
                        <div class="caption">
                            <h2 class="package-title" style="color:white;"><?php echo $package->title;?></h2> 
                            <p style="min-height:25px;color:white;"><?php echo $package->description;?>         </p>    

<p style="color:white;">- Du kan altid framelde dig under "Frameld"</p>

<hr>
          
                            <div style="clear:both;">
                                <span class="rtl-right" style="float:left; font-weight:bold;color:white;"><?php echo lang_key('price'); ?>:</span>
                                <span class="rtl-left" style="float:right;color:white; ">10 DKK</span>
                            </div>
  
                       
                            <div style="clear:both; border-bottom:1px solid #ccc; margin:10px 0px;"></div>

<p><label class="checkbox">
                                            <input type="checkbox" name="terms_conditon_field" id="terms_conditon_field" <?php echo (isset($_POST['terms_conditon_field']))?'checked':'';?>> 
<span style="color:white;">Jeg accepterer <a target="_blank" href="<?php echo site_url('show/page/betingelser');?>">handelsbetingelserne</a> og mit køb kan overgå til abonnement.</span>

                            <p>

                                <button style="margin-top:2px;" type="submit" href="<?php echo site_url('show/registerinfo');?>" class="btn btn-primary  btn-labeled">
                                    <?php echo lang_key('subscribe'); ?>
                                    <span class="btn-label btn-label-right">
                                       <i class="fa  fa-arrow-right"></i>
                                    </span>
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </form>    
        <?php endforeach;?>
        <?php
        }
        ?>

 <div class="col-md-4 col-sm-4">
                    <div class="thumbnail thumb-shadow">
                        
                        <div class="caption">
                            <h2 class="package-title">Om Intropakke:</h2> 
                            <p style="min-height:25px;">>> Det tager i gennemsnit kun 9 dage at finde en lejebolig<br><br>>> Gratis support - 11:00-14:00 på telefon & email<br><br>>> Mere end 1000 ledige lejeboliger<br><br> >> Få kontakt til alle udlejere<br><br>>> Altid ledige lejemål i Danmarks 8 største byer<br><br>>> Alle lejemål er valideret manuelt<br><br>>> Søg efter lejemål på både din mobil, tablet og computer.</p>                       
                            
                        </div>
                    </div>
                </div>

<div class="col-md-4 col-sm-4">
                    <div class="thumbnail thumb-shadow">
                        
                        <div class="caption">
                            <h2 class="package-title">Vi her for at hjælpe:</h2> 
                            <p style="min-height:25px;"><img src="/uploads/thumbs/support-pic2.jpg" width="74%" height="74%" /><p style="min-height:25px;">Har du nogle spørgsmål?<br>
Kontakt os på tlf. 27 92 45 90 eller på email: infolejibyen@gmail.com</p>  </p>                       
                            
                        </div>
                    </div>
                </div>
    </div>    
</div> <!-- /row -->
