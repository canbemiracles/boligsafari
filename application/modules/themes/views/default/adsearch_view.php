<link rel="stylesheet" href="<?php echo theme_url();?>/assets/css/chosen.min.css">
<link rel="stylesheet" href="<?php echo theme_url();?>/assets/jquery-ui/jquery-ui.min.css">
<script src="<?php echo theme_url();?>/assets/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo theme_url();?>/assets/jquery-ui/jquery-ui.min.js"></script>

<?php 

$curr_lang = ($this->uri->segment(1)!='')?$this->uri->segment(1):'en';
$CI = get_instance();
?>
<?php 

if(isset($data['facilities']) && is_array($data['facilities']))
{
  $filter_facilities = $data['facilities'];
}
else
{
  $filter_facilities = array();
}

?>

        <style type="text/css">

        .up,.down{color:#fff;}

        .up:hover,.down:hover{color:#fff;}

        </style>

        <div class="row">



          <div class="col-md-3 col-sm-3">

            <form action="<?php echo site_url('show/advfilter');?>" method="post"> 

              <div class="search-bar">

                 <h1 class="detail-title"><i class="fa fa-search"></i>&nbsp;<?php echo lang_key('DBC_ADVANCED_SEARCH'); ?></h1>

              </div>

              <div  class="orange-border panel panel-primary effect-helix in" id="plain_box">

                  <div class="panel-heading orange"><?php echo lang_key('plain_search'); ?></div>

                  <div class="panel-body">


                      <span id="plain_container">

                        <div class="info_list">                      

                              <input class="form-control" type="text" value="<?php echo (isset($data['plainkey']))?rawurldecode($data['plainkey']):'';?>" name="plainkey">

                          </div>

                        <button type="submit" class="btn btn-info  btn-labeled" style="margin:10px 0 10px 0">

                        Søg

                        <span class="btn-label btn-label-right">

                           <i class="fa fa-search"></i>

                        </span>

                        </button>

                      </span>  

                  </div>

             </div>       

             

             



              <div  class="orange-border panel panel-primary effect-helix in" id="advance_box">

                  <div class="panel-heading orange"><?php echo lang_key('advanced_filters') ?></div>

                  <div class="panel-body">

                      <span id="adv_container">


                      <div class="info_list">

                      <h5>Type af lejemål</h5>

                        <select multiple="multiple" id="type-select" name="type[]" class="form-control input-sm chzn-select" data-placeholder="Vælg">

                              
                              
                                  <option value="DBC_TYPE_APARTMENT" >Lejlighed</option>

                                  <option value="DBC_TYPE_CONDO" >Værelse</option>

                            
                                  <option value="DBC_TYPE_HOUSE" >Hus</option>

                              

                              
                              
                          </select>

                      </div>
                  


                      <div class="divider"></div>



                      <div class="info_list">

                          <h5>Leje pr. måned</h5>

                          <div id="slider-range-rent-price" style="margin-top: 6px"></div>

                          <input id="rent_price_min" class="form-control board-filter-input-slider" type="text" name="rent_price_min" value="<?php echo (isset($data['rent_price_min']))?$data['rent_price_min']:'';?>">

                          <p class="slider-input-text-middle"><?php echo $CI->session->userdata('system_currency'); ?></p>

                          <input id="rent_price_max" class="form-control board-filter-input-slider" type="text" name="rent_price_max" value="<?php echo (isset($data['rent_price_max']))?$data['rent_price_max']:'';?>">



                      </div>



                      <div class="divider"></div>

                      <div class="info_list">

                          <h5>Antal værelser</h5>

                          <div id="slider-bedroom" style="margin-top: 6px"></div>

                          <input id="bedroom_min" class="form-control board-filter-input-slider" type="text" name="bedroom_min" value="<?php echo (isset($data['bedroom_min']))?$data['bedroom_min']:'';?>">

                          <p class="slider-input-text-middle">Antal</p>

                          <input id="bedroom_max" class="form-control board-filter-input-slider" type="text" name="bedroom_max" value="<?php echo (isset($data['bedroom_max']))?$data['bedroom_max']:'';?>">

                      </div>


                      <div class="divider"></div>

             
                     








                      <button type="submit" class="btn btn-info  btn-labeled" style="margin:10px 0 10px 0">

                        Søg

                        <span class="btn-label btn-label-right">

                           <i class="fa fa-search"></i>

                        </span>

                      </button>

                    </span>

                  </div>

              </div>


          




            </form>  

          </div>

          <?php $current_url = base64_encode(current_url().'/#data-content');?>

          <div class="col-md-9 col-sm-9"  style="-webkit-transition: all 0.7s ease-in-out; transition: all 0.7s ease-in-out;">

              <h1 class="detail-title"><i class="fa fa-building-o"></i>&nbsp;<?php echo lang_key('result'); ?>

                  <?php require'switcher_view.php';?>

              </h1>


              <?php

              

              if($this->session->userdata('view_style')=='list')

              {

                  require'list_view.php';

              }

              else if($this->session->userdata('view_style')=='map')

              {

                  $map_id = 'search_map_view';

                  require'map_view.php';

              }

              else

              {                  

                  require'list_view.php';

              }

              ?>



              <div class="clearfix"></div>

              <div style="text-align:center">

                <ul class="pagination">

                <?php echo (isset($pages))?$pages:'';?>

                </ul>

              </div>

          </div>



        </div> <!-- /row -->

        <script type="text/javascript">



            function updown()

            {

              $('.up').click(function(e){

                  e.preventDefault();

                  var panel = $(this).attr('href');

                  $(panel+' > .panel-body').hide();

                  $(panel+ ' .fa-chevron-up').addClass('fa-chevron-down');

                  $(panel+ ' .fa-chevron-up').removeClass('fa-chevron-up');

                  $(this).addClass('down');

                  $(this).removeClass('up');

                  updown();

                });



                $('.down').click(function(e){

                  e.preventDefault();

                  var panel = $(this).attr('href');

                  $(panel+' > .panel-body').show();

                  $(panel+ ' .fa-chevron-down').addClass('fa-chevron-up');

                  $(panel+ ' .fa-chevron-down').removeClass('fa-chevron-down');

                  $(this).addClass('up');

                  $(this).removeClass('down');

                  updown();

                });

            }

            $(function () {

                

                updown();

                jQuery('.facility-filter').click(function(){
                  jQuery('.facility').hide('slow');
                  var flag = 0;
                  jQuery('.facility-filter').each(function(){
                      var val = jQuery(this).val();
                      var sel = jQuery(this).attr('checked');
                      if(sel=='checked')
                      {
                        flag = 1;
                        jQuery('.facility-'+val).show('slow');
                      }
                  });     

                  if(flag==0)
                    jQuery('.facility').show('slow');             
                  
                });

                $('#ignor_plain').change(function() {

                    if($(this).is(":checked")) {

                        // var returnVal = confirm("Are you sure?");

                        // $(this).attr("checked", returnVal);

                        var panel = jQuery(this).attr('target');

                        jQuery(panel).hide();

                    }

                    else

                    {

                        var panel = jQuery(this).attr('target');

                        jQuery(panel).show();

                    }

                }).change();


            

                $('#ignor_location').change(function() {

                    if($(this).is(":checked")) {

                        // var returnVal = confirm("Are you sure?");

                        // $(this).attr("checked", returnVal);

                        var panel = jQuery(this).attr('target');

                        jQuery(panel).hide();

                    }

                    else

                    {

                        var panel = jQuery(this).attr('target');

                        jQuery(panel).show();

                    }

                }).change();



                $('#ignor_adv').change(function() {

                    if($(this).is(":checked")) {

                        // var returnVal = confirm("Are you sure?");

                        // $(this).attr("checked", returnVal);

                        var panel = jQuery(this).attr('target');

                        jQuery(panel).hide();

                    }

                    else

                    {

                        var panel = jQuery(this).attr('target');

                        jQuery(panel).show();

                    }

                }).change();



                jQuery('#country').change(function(){

                    jQuery('#state').val('');

                    jQuery('#selected_state').val('');

                    jQuery('#city').val('');

                    jQuery('#selected_city').val('');

                });



                jQuery('#state').change(function(){

                    jQuery('#city').val('');

                    jQuery('#selected_city').val('');

                });



                jQuery( "#state" ).bind( "keydown", function( event ) {

                    if ( event.keyCode === jQuery.ui.keyCode.TAB &&

                    jQuery( this ).data( "ui-autocomplete" ).menu.active ) {

                        event.preventDefault();

                    }

                })

                .autocomplete({

                    source: function( request, response ) {

                        

                        jQuery.post(

                            "<?php echo site_url('show/get_states_ajax');?>/",

                            {term: request.term,country: jQuery('#country').val()},

                            function(responseText){

                                response(responseText);

                                jQuery('#selected_state').val('');

                                jQuery('.state-loading').html('');

                            },

                            "json"

                        );

                    },

                    search: function() {

                        // custom minLength

                        var term = this.value ;

                        if ( term.length < 2 ) {

                            return false;

                        }

                        else

                        {

                            jQuery('.state-loading').html('Loading...');

                        }

                    },

                    focus: function() {

                        // prevent value inserted on focus

                        return false;

                    },

                    select: function( event, ui ) {

                        this.value = ui.item.value;

                        jQuery('#selected_state').val(ui.item.id);

                        jQuery('.state-loading').html('');

                        return false;

                    }

                });





                jQuery( "#city" ).bind( "keydown", function( event ) {

                    if ( event.keyCode === jQuery.ui.keyCode.TAB &&

                    jQuery( this ).data( "ui-autocomplete" ).menu.active ) {

                        event.preventDefault();

                    }

                })

                .autocomplete({

                    source: function( request, response ) {

                        

                        jQuery.post(

                            "<?php echo site_url('show/get_cities_ajax');?>/",

                            {term: request.term,state: jQuery('#selected_state').val()},

                            function(responseText){

                                response(responseText);

                                jQuery('#selected_city').val('');

                                jQuery('.city-loading').html('');

                            },

                            "json"

                        );

                    },

                    search: function() {

                        // custom minLength

                        var term = this.value ;

                        if ( term.length < 2 || jQuery('#selected_state').val()=='') {

                            return false;

                        }

                        else

                        {

                            jQuery('.city-loading').html('Loading...');

                        }

                    },

                    focus: function() {

                        // prevent value inserted on focus

                        return false;

                    },

                    select: function( event, ui ) {

                        this.value = ui.item.value;

                        jQuery('#selected_city').val(ui.item.id);

                        jQuery('.city-loading').html('');

                        return false;

                    }

                });



                $(".chzn-select").chosen();



                var start_range = 0;

                var end_range = 1000000;

                $("#slider-range-price").slider({

                    range: true,

                    min: 0,

                    max: 1000000,

                    values: [ start_range, end_range ],

                    slide: function (event, ui) {

                        $("#price_min").val(ui.values[ 0 ]);

                        $("#price_max").val(ui.values[ 1 ]);

                    }

                });


                var start_range = 0;

                var end_range = 20000;

                $("#slider-range-rent-price").slider({

                    range: true,

                    min: 0,

                    max: 20000,

                    values: [ start_range, end_range ],

                    slide: function (event, ui) {

                        $("#rent_price_min").val(ui.values[ 0 ]);

                        $("#rent_price_max").val(ui.values[ 1 ]);

                    }

                });



                var start_range = 0;

                var end_range = 50;

                $("#slider-bedroom").slider({

                    range: true,

                    min: 0,

                    max: 50,

                    values: [ start_range, end_range ],

                    slide: function (event, ui) {

                        $("#bedroom_min").val(ui.values[ 0 ]);

                        $("#bedroom_max").val(ui.values[ 1 ]);

                    }

                });



                var start_range = 0;

                var end_range = 50;

                $("#slider-bath").slider({

                    range: true,

                    min: 0,

                    max: 50,

                    values: [ start_range, end_range ],

                    slide: function (event, ui) {

                        $("#bath_min").val(ui.values[ 0 ]);

                        $("#bath_max").val(ui.values[ 1 ]);

                    }

                });



                var start_range = 1900;

                var end_range = 2020;

                $("#slider-year").slider({

                    range: true,

                    min: 1900,

                    max: 2020,

                    values: [ start_range, end_range ],

                    slide: function (event, ui) {

                        $("#year_min").val(ui.values[ 0 ]);

                        $("#year_max").val(ui.values[ 1 ]);

                    }

                });



            });



        </script>