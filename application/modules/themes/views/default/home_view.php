<?php 
$curr_lang = ($this->uri->segment(1)!='')?$this->uri->segment(1):default_lang();
?>
        <div class="row">
          <?php $current_url = base64_encode(current_url().'/#data-content');?>
          <div id="data-content" class="col-md-9"  style="-webkit-transition: all 0.7s ease-in-out; transition: all 0.7s ease-in-out;">
              
              
              <?php render_widgets('home_middle');?> 

              <h1 class="recent-grid"><i class="fa fa-home fa-4"></i>&nbsp;<?php echo lang_key('recent_estates'); ?>
                  <?php require'switcher_view.php';?>
              </h1>

              <!-- Thumbnails container -->
              <?php
              $query = (isset($recents))?$recents:array();
              if($this->session->userdata('view_style')=='list')
              {
                  require'list_view.php';
              }
              else if($this->session->userdata('view_style')=='map')
              {
                  $map_id = 'recent_map_view';
                  require'map_view.php';
              }
              else
              {                  
                  require'list_view.php';
              }
              ?>
              <div class="clearfix"></div>
              <?php if($query->num_rows()>0){?>
              <div class="view-more"><a class="" href="<?php echo site_url('show/properties/recent');?>"><?php echo lang_key('view_all');?></a></div>
              <?php }?>

          </div>


          <div class="col-md-3">
<h2 class="recent-grid"><i class="fa fa-puzzle-piece"></i> Type</h2>
<div class="well">
    <ul class="nav nav-pills nav-stacked">
                <li class="">
            <a href="http://www.lejibyen.dk/index.php/da/show/type/apartment">
                <i class="fa fa-indent"></i> Lejlighed            </a>
        </li>
  <li class="">
            <a href="http://www.lejibyen.dk/index.php/da/show/type/condo">
                <i class="fa fa-indent"></i> Værelse            </a>
        </li>
                <li class="">
            <a href="http://www.lejibyen.dk/index.php/da/show/type/house">
                <i class="fa fa-indent"></i> Hus            </a>
        </li>
              
                <li class="">
            <a href="http://www.lejibyen.dk/index.php/da/show/type/villa">
                <i class="fa fa-indent"></i> Villa            </a>
        </li>
            </ul>
</div>
<div style="clear:both"></div>          </div>


        </div> <!-- /row -->
