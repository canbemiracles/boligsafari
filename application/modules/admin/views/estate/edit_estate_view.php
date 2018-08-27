<!--Rickh Text Editor-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
<style type="text/css">
.file-upload{
    margin:0 !important;
    padding:0 !important;
    list-style: none;
}
.file-upload li{
    clear: both;
}
.facilities{
    list-style: none;
    margin: 0;
    padding: 0;
}
.facilities li{
    float: left;
    margin-right: 10px;
}
</style>
<?php
$system_currency_type = get_settings('realestate_settings','system_currency_type',0);

if($system_currency_type == 0){

    $system_currency = get_currency_icon(get_settings('realestate_settings','system_currency','USD'));

}

else{

    $system_currency = get_settings('realestate_settings','system_currency','USD');

}
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript">
    var markers = [];
    var Ireland = "Dhaka, Bangladesh";
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var mapOptions = {
            center: new google.maps.LatLng(-34.397, 150.644),
            zoom: 13
        };
        map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
//        codeAddress();//call the function
        var ex_latitude = $('#latitude').val();
        var ex_longitude = $('#longitude').val();

        if (ex_latitude != '' && ex_longitude != ''){
            map.setCenter(new google.maps.LatLng(ex_latitude, ex_longitude));//center the map over the result
            var marker = new google.maps.Marker(
                {
                    map: map,
                    draggable:true,
                    animation: google.maps.Animation.DROP,
                    position: new google.maps.LatLng(ex_latitude, ex_longitude)
                });

            markers.push(marker);
            google.maps.event.addListener(marker, 'dragend', function()
            {
                var marker_positions = marker.getPosition();
                $('#latitude').val(marker_positions.lat());
                $('#longitude').val(marker_positions.lng());
//                        console.log(marker.getPosition());
            });

        }
    }

    function codeAddress()
    {
        var main_address = $('#address').val();
        var country = $('#country').find(':selected').data('name');
        var state = $('#state').val();
        var city = $('#city').val();

        var address = [main_address,city, state, country].join();

        if(country != '' && city != '')
        {


            setAllMap(null); //Clears the existing marker

            geocoder.geocode( {address:address}, function(results, status)
            {
                if (status == google.maps.GeocoderStatus.OK)
                {
                    console.log(results[0].geometry.location.lat());
                    $('#latitude').val(results[0].geometry.location.lat());
                    $('#longitude').val(results[0].geometry.location.lng());
                    map.setCenter(results[0].geometry.location);//center the map over the result


                    //place a marker at the location
                    var marker = new google.maps.Marker(
                        {
                            map: map,
                            draggable:true,
                            animation: google.maps.Animation.DROP,
                            position: results[0].geometry.location
                        });

                    markers.push(marker);


                    google.maps.event.addListener(marker, 'dragend', function()
                    {
                        var marker_positions = marker.getPosition();
                        $('#latitude').val(marker_positions.lat());
                        $('#longitude').val(marker_positions.lng());
//                        console.log(marker.getPosition());
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });

        }
        else{
            alert('You must enter at least country and city');
        }

    }

    function setAllMap(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div class="row">
  <div class="col-md-12">
    <?php echo $this->session->flashdata('msg');?>
    <?php echo (isset($msg) && $msg!='')?$msg:'';?>
    <form class="form-horizontal" id="addpackage" action="<?php echo site_url('admin/realestate/updateestate');?>" method="post">
      <input type="hidden" name="id" value="<?php echo $estate->id;?>">
      <input type="hidden" name="page" value="<?php echo $page;?>">
    <div class="box">

      <div class="box-title">
        <h3><i class="fa fa-bars"></i><?php echo lang_key('basic_info'); ?></h3>
        <div class="box-tool">
          <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
        </div>
      </div>

      <div class="box-content">
            <div class="translator_key" >
              <a href="" style="float: left;height: 40px;padding-top: 10px;" id="lang_key_id" class="btn btn-primary col-md-4">Auto-translate tile & description</a><span class="loading_status col-md-8"></span>
            </div>
            <div class="clearfix"></div>
            <span style="font-size:10px;font-style:italic">Auto trnslation is done using my memory api. Please check manually if translation is correct. If no translation is provided then <?php echo default_lang()?> will be used.</span>
            <div class="clearfix"></div>
            <?php 
            $CI = get_instance();
            $CI->load->model('admin/system_model');
            $query = $CI->system_model->get_all_langs();
            $active_languages = $query->result();
            ?>
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab1">
                    <?php $flag=1; foreach ($active_languages as $lang){ ?>
                    <li class="<?php echo (default_lang()==$lang->short_name)?'active':'';?>"><a data-toggle="tab" href="#<?php echo $lang->short_name;?>"><i class="fa fa-home"></i> <?php echo $lang->short_name;?></a></li>
                    <?php $flag++; }?>
                </ul>
                <div class="tab-content" id="myTabContent1">
                     <?php $flag=1; foreach ($active_languages as $lang){ ?>
                     <div id="<?php echo $lang->short_name;?>" class="tab-pane fade in <?php echo (default_lang()==$lang->short_name)?'active':'';?>">

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('title');?>:</label>
                      <div class="col-sm-4 col-lg-5 controls">
                        <?php 
                        $title = get_title_for_edit_by_id_lang($estate->id,$lang->short_name);
                        $title = (set_value('title'.$lang->short_name)!='')?set_value('title'.$lang->short_name):$title;
                        ?>
                        <input type="text" name="title<?php echo $lang->short_name;?>" value="<?php echo $title;?>" placeholder="<?php echo lang_key('title');?>" class="form-control input-sm" >
                        <span class="help-inline">&nbsp;</span>
                        <?php echo form_error('title'.$lang->short_name); ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('description');?>:</label>
                      <div class="col-sm-7 col-lg-7 controls">
                        <?php 
                        $description = get_description_for_edit_by_id_lang($estate->id,$lang->short_name);
                        $description = (set_value('description'.$lang->short_name)!='')?set_value('description'.$lang->short_name):$description;
                        ?>
                        <textarea style="min-height:200px" class="form-control wysihtml5" name="description<?php echo $lang->short_name;?>"><?php echo $description;?></textarea>
                        <span class="help-inline">&nbsp;</span>
                        <?php echo form_error('description'.$lang->short_name); ?>
                      </div>
                    </div>

                    </div>
                    <?php $flag++; }?>
                </div>
            </div>

          <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('purpose');?> :</label>
              <div class="col-sm-4 col-lg-5 controls">
                  <?php $purposes = array("DBC_PURPOSE_SALE", "DBC_PURPOSE_RENT", "DBC_PURPOSE_BOTH");?>
                  <select id="purpose-select" name="purpose" class="form-control input-sm">
                      <?php foreach ($purposes as $purpose) { 
                              $v = (set_value('purpose')!='')?set_value('purpose'):$estate->purpose;
                              $sel = ($purpose==$v)?'selected="selected"':'';
                        ?>
                          <option value="<?php echo $purpose;?>" <?php echo $sel;?>><?php echo lang_key($purpose);?></option>
                      <?php } ?>
                  </select>
                  <span class="help-inline">&nbsp;</span>
                  <?php echo form_error('purpose'); ?>
              </div>
          </div>

            <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('type');?>:</label>
              <div class="col-sm-4 col-lg-5 controls">
                <?php $types = array();
                      $this->load->config('realcon');
                      $custom_types = $this->config->item('property_types');
                      if(is_array($custom_types)) foreach ($custom_types as $key => $custom_type) {
                        $types[] = $custom_type['title'];
                      }
                ?>
                <select id="type-select" name="type" class="form-control input-sm">
                    <option value="">Select Type</option>
                    <?php foreach ($types as $type) { 
                              $v = (set_value('type')!='')?set_value('type'):$estate->type;
                              $sel = ($type==$v)?'selected="selected"':'';
                      ?>
                    <option value="<?php echo $type; ?>" <?php echo $sel;?>><?php echo lang_key($type);?></option>
                    <?php } ?>
                </select>
                <span class="help-inline">&nbsp;</span>
                <?php echo form_error('type'); ?>
              </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('price_negotiable').'?';?> :</label>
                <div class="col-sm-4 col-lg-5 controls">
                    <?php $options = array("0"=>"No","1"=>"Yes");?>
                    <select name="price_negotiable" class="form-control input-sm" id="price_negotiable">
                      <?php $p_neg = (set_value('price_negotiable')!='')?set_value('price_negotiable'):get_post_meta($estate->id,'price_negotiable','0');?>
                        <?php foreach ($options as $key=>$option) {
                            $sel = ($key==$p_neg)?'selected="selected"':'';
                            ?>
                            <option value="<?php echo $key;?>" <?php echo $sel;?>><?php echo lang_key($option);?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('price_negotiable'); ?>
                </div>
            </div>

          <div id="sales-price-holder">
          <div class="form-group">
              <label id="sales-label" class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('sales_price');?>:</label>
              <div class="col-sm-4 col-lg-5 controls">
                  <div class="input-group">
                      <span class="input-group-addon"><?php echo $system_currency;?></span>
                      <?php $total_price = (set_value('total_price')!='')?set_value('total_price'):$estate->total_price;?>
                      <input type="text" id="total_price" name="total_price" value="<?php echo $total_price;?>" placeholder="<?php echo lang_key('sales_price');?>" class="form-control input-sm" >
                  </div>
                  <span class="help-inline">&nbsp;</span>
                  <?php echo form_error('total_price'); ?>
              </div>
          </div>

          <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('price_per_unit');?>:</label>
              <div class="col-sm-4 col-lg-3 controls">
                  <div class="input-group">
                      <span class="input-group-addon"><?php echo $system_currency;?></span>
                      <?php $price_per_unit = (set_value('price_per_unit')!='')?set_value('price_per_unit'):$estate->price_per_unit;?>
                      <input type="text" id="price_per_unit" name="price_per_unit" value="<?php echo $price_per_unit;?>" placeholder="<?php echo lang_key('price_per_unit');?>" class="form-control input-sm" >
                  </div>
                  <span class="help-inline">&nbsp;</span>
                  <?php echo form_error('price_per_unit'); ?>
              </div>
              <div class="col-sm-4 col-lg-2 controls">
                  <select name="price_unit" class="form-control input-sm">
                      <?php 
                        $units = array('sqft'=>'Square Feet','sqmeter'=>'Square Meter','acre'=>'Acre','hector'=>'Hector');
                        foreach ($units as $val=>$unit) 
                        {
                          $v = (set_value('price_unit')!='')?set_value('price_unit'):$estate->price_unit;
                          $sel = ($val==$v)?'selected="selected"':'';
                      ?>
                          <option value="<?php echo $val;?>" <?php echo $sel;?>><?php echo $unit;?></option>
                      <?php
                        }
                      ?>
                  </select>
                  <span class="help-inline">&nbsp;</span>
                  <?php echo form_error('price_unit'); ?>
              </div>
          </div>
            </div>
            <div id="rent-price-holder" class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('rent_price');?>:</label>
                <div class="col-sm-4 col-lg-3 controls">
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo $system_currency;?></span>
                           <?php $rent_price = (set_value('rent_price')!='')?set_value('rent_price'):$estate->rent_price;?>
                           <input type="text" id="rent_price" name="rent_price" value="<?php echo $rent_price;?>" placeholder="<?php echo lang_key('rent_price');?>" class="form-control input-sm" >
                    </div>
                    <span class="help-inline">&nbsp;</span>
                    <?php echo form_error('rent_price'); ?>
                </div>
                <div class="col-sm-4 col-lg-2 controls">
                    <select name="rent_price_unit" class="form-control input-sm">
                      <?php 
                        $units = array('DBC_PER_MONTH'=>'DBC_PER_MONTH','DBC_PER_QUARTER'=>'DBC_PER_QUARTER','DBC_PER_YEAR'=>'DBC_PER_YEAR');
                        foreach ($units as $val=>$unit) 
                        {
                          $v = (set_value('rent_price_unit')!='')?set_value('rent_price_unit'):$estate->rent_price_unit;
                          $sel = ($val==$v)?'selected="selected"':'';
                      ?>
                          <option value="<?php echo $val;?>" <?php echo $sel;?>><?php echo lang_key($unit);?></option>
                      <?php
                        }
                      ?>
                    </select>
                    <span class="help-inline">&nbsp;</span>
                    <?php echo form_error('rent_price_unit'); ?>
                </div>

                <div class="clearfix"></div>
                <label class="col-sm-3 col-lg-2 control-label">Date format:</label>
                <div class="col-sm-4 col-lg-3 controls">
                    <select name="date_format" class="form-control" id="format">
                    <option value="mm/dd/yy">Default - mm/dd/yy</option>
                    <option value="yy-mm-dd">ISO 8601 - yy-mm-dd</option>
                    <option value="d M, y">Short - d M, y</option>
                    <option value="d MM, y">Medium - d MM, y</option>
                    <option value="DD, d MM, yy">Full - DD, d MM, yy</option>
                    <option value="&apos;day&apos; d &apos;of&apos; MM &apos;in the year&apos; yy">With text - 'day' d 'of' MM 'in the year' yy</option>
                    </select>
                    <span class="help-inline">&nbsp;</span>
                    <?php echo form_error('date_format'); ?>
                </div>

                <div class="clearfix"></div>
                <label class="col-sm-3 col-lg-2 control-label">From date:</label>
                <div class="col-sm-4 col-lg-3 controls">
                    <?php $v = (set_value('from_date')!='')?set_value('from_date'):get_post_meta($estate->id,'from_rent_date','');?>
                    <input type="text"  name="from_date" value="<?php echo $v;?>" placeholder="From when " class="form-control input-sm my-date-picker" >
                    <span class="help-inline">&nbsp;</span>
                    <?php echo form_error('from_date'); ?>
                </div>

                <div class="clearfix"></div>
                <label class="col-sm-3 col-lg-2 control-label">To date:</label>
                <div class="col-sm-4 col-lg-3 controls">
                    <?php $v = (set_value('to_date')!='')?set_value('to_date'):get_post_meta($estate->id,'to_rent_date','');?>
                    <input type="text"  name="to_date" value="<?php echo $v;?>" placeholder="To when " class="form-control input-sm my-date-picker" >
                    <span class="help-inline">&nbsp;</span>
                    <?php echo form_error('to_date'); ?>
                </div>

            </div>

            <div id="home-size-holder" class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('home_size');?>:</label>
                <div class="col-sm-4 col-lg-3 controls">
                        <?php $home_size = (set_value('home_size')!='')?set_value('home_size'):$estate->home_size;?>
                        <input type="text" id="home_size" name="home_size" value="<?php echo $home_size;?>" placeholder="<?php echo lang_key('home_size');?>" class="form-control input-sm" >
                    <span class="help-inline">&nbsp;</span>
                    <?php echo form_error('home_size'); ?>
                </div>
                <div class="col-sm-4 col-lg-2 controls">
                    <select name="home_size_unit" class="form-control input-sm">
                      <?php 
                        $units = array('sqft'=>'Square Feet','sqmeter'=>'Square Meter');
                        foreach ($units as $val=>$unit) 
                        {
                          $v = (set_value('home_size_unit')!='')?set_value('home_size_unit'):$estate->home_size_unit;
                          $sel = ($val==$v)?'selected="selected"':'';
                      ?>
                          <option value="<?php echo $val;?>" <?php echo $sel;?>><?php echo $unit;?></option>
                      <?php
                        }
                      ?>
                    </select>
                    <span class="help-inline">&nbsp;</span>
                    <?php echo form_error('home_size_unit'); ?>
                </div>
            </div>

            <div id="lot-size-holder" class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('lot_size');?>:</label>
                <div class="col-sm-4 col-lg-3 controls">
                        <?php $lot_size = (set_value('lot_size')!='')?set_value('lot_size'):$estate->lot_size;?>
                        <input type="text" id="lot_size" name="lot_size" value="<?php echo $lot_size;?>" placeholder="<?php echo lang_key('lot_size');?>" class="form-control input-sm" >
                        <span class="help-inline">&nbsp;</span>
                    <?php echo form_error('lot_size'); ?>
                </div>
                <div class="col-sm-4 col-lg-2 controls">
                    <select name="lot_size_unit" class="form-control input-sm">
                      <?php 
                        $units = array('acre'=>'Acre','hector'=>'Hector');
                        foreach ($units as $val=>$unit) 
                        {
                          $v = (set_value('lot_size_unit')!='')?set_value('lot_size_unit'):$estate->lot_size_unit;
                          $sel = ($val==$v)?'selected="selected"':'';
                      ?>
                          <option value="<?php echo $val;?>" <?php echo $sel;?>><?php echo $unit;?></option>
                      <?php
                        }
                      ?>
                    </select>
                    <span class="help-inline">&nbsp;</span>
                    <?php echo form_error('lot_size_unit'); ?>
                </div>
            </div>



            <div id="bedroom-holder" class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('bedrooms');?>:</label>
                <div class="col-sm-4 col-lg-5 controls">
                    <?php $bedroom = (set_value('bedroom')!='')?set_value('bedroom'):$estate->bedroom;?>
                    <input type="text" id="bedroom" name="bedroom" value="<?php echo $bedroom;?>" placeholder="<?php echo lang_key('bedrooms');?>" class="form-control input-sm" >
                    <span class="help-inline">&nbsp;</span>
                    <?php echo form_error('bedroom'); ?>
                </div>
            </div>

            <div id="bath-holder" class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('baths');?>:</label>
                <div class="col-sm-4 col-lg-5 controls">
                    <?php $bath = (set_value('bath')!='')?set_value('bath'):$estate->bath;?>
                    <input type="text" id="bath" name="bath" value="<?php echo $bath;?>" placeholder="<?php echo lang_key('baths');?>" class="form-control input-sm" >
                    <span class="help-inline">&nbsp;</span>
                    <?php echo form_error('bath'); ?>
                </div>
            </div>

            <div id="year-built-holder" class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('year_built');?>:</label>
                <div class="col-sm-4 col-lg-5 controls">
                    <?php $year_built = (set_value('year_built')!='')?set_value('year_built'):$estate->year_built;?>
                    <input type="text" id="year_built" name="year_built" value="<?php echo $year_built;?>" placeholder="<?php echo lang_key('year_built');?>" class="form-control input-sm" >
                    <span class="help-inline">&nbsp;</span>
                    <?php echo form_error('year_built'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('energy_efficiency');?> :</label>
                <div class="col-sm-4 col-lg-5 controls">
                    <?php $options = array("0"=>"None","5"=>"5", "4"=>"4", "3"=>"3", "2"=>"2","1"=>"1");?>
                    <select name="energy_efficiency" class="form-control input-sm">
                        <?php $v = (set_value('energy_efficiency')!='')?set_value('energy_efficiency'):get_post_meta($estate->id,'energy_efficiency','');?>
                        <?php foreach ($options as $key=>$option) {
                            $sel = ($key==$v)?'selected="selected"':'';
                            ?>
                            <option value="<?php echo $key;?>" <?php echo $sel;?>><?php echo lang_key($option);?></option>
                        <?php } ?>
                    </select>
                    <span class="help-inline">As Star Rating</span>
                    <?php echo form_error('energy_efficiency'); ?>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('status');?> :</label>
                <div class="col-sm-4 col-lg-5 controls">
                    <?php $conditions = $this->config->item('property_status');?>
                    <select name="condition" class="form-control input-sm">
                        <?php foreach ($conditions as $condition) { 
                                $v = (set_value('condition')!='')?set_value('condition'):$estate->estate_condition;
                                $sel = ($condition['title']==$v)?'selected="selected"':'';
                          ?>
                            <option value="<?php echo $condition['title'];?>" <?php echo $sel;?>><?php echo lang_key($condition['title']);?></option>
                        <?php } ?>
                    </select>
                    <span class="help-inline">&nbsp;</span>
                    <?php echo form_error('condition'); ?>
                </div>
            </div>

          <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('AC');?> :</label>
              <div class="col-sm-4 col-lg-5 controls">
                  <input type="text" name="admin_estate_ac"  placeholder="<?php echo lang_key('AC');?>" class="form-control input-sm" value="<?php echo $estate->ac; ?>" >
                  <span class="help-inline">&nbsp;</span>
                  <?php echo form_error('condition'); ?>
              </div>
          </div>

          <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('Prepaid Rent');?> :</label>
              <div class="col-sm-4 col-lg-5 controls">
                  <select name="admin_estate_prepaid_rent" class="form-control input-sm">
                      <?php for($i=1;$i<=3;$i++)
                      {
                          if($estate->prepaid_rent==$i)
                          {
                              ?>
                              <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                              <?php
                          }
                          else {
                              ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                          <?php
                          }
                      }
                      ?>
                  </select>
                  <span class="help-inline">&nbsp;</span>
                  <?php echo form_error('condition'); ?>
              </div>
          </div>

          <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('Deposit');?> :</label>
              <div class="col-sm-4 col-lg-5 controls">
                  <select name="admin_estate_deposit" class="form-control input-sm">
                      <?php for($i=1;$i<=3;$i++)
                      {
                          if($estate->deposit==$i)
                          {
                              ?>
                              <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                          <?php
                          }
                          else {
                              ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                          <?php
                          }
                      }
                      ?>
                  </select>
                  <span class="help-inline">&nbsp;</span>
                  <?php echo form_error('condition'); ?>
              </div>
          </div>

          <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('Takeover Date');?> :</label>
              <div class="col-sm-4 col-lg-5 controls">
                  <input type="text" name="admin_estate_takeover_date" value="<?php echo $estate->takeover_date; ?>" placeholder="<?php echo lang_key('Takeover Date');?>" class="form-control input-sm" >
                  <span class="help-inline">&nbsp;</span>
                  <?php echo form_error('condition'); ?>
              </div>
          </div>


          <?php if(is_admin()){ ?>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('agent');?> :</label>
                    <div class="col-sm-4 col-lg-5 controls">
                        <?php $CI = get_instance();
                        $CI->load->model('show/show_model');
                        $agents = $CI->show_model->get_users_by_range('all','','first_name');?>
                        <select name="created_by" class="form-control input-sm">
                            <?php if(set_value('created_by')!= ''){
                                $v = set_value('created_by');
                            }
                            else if($estate->created_by != 0){
                                $v = $estate->created_by;
                            }
                            else{
                               $v = $CI->session->userdata('user_id');
                            }
                             ?>
                            <?php foreach ($agents->result() as $agent) {
                                $sel = ($agent->id== $v)?'selected="selected"':'';
                                ?>
                                <option value="<?php echo $agent->id;?>" <?php echo $sel;?>><?php echo $agent->first_name.' '.$agent->last_name;?></option>
                            <?php } ?>
                        </select>
                        <span class="help-inline">&nbsp;</span>
                        <?php echo form_error('condition'); ?>
                    </div>
                </div>
            <?php } ?>

            <div id="year-built-holder" class="form-group">
            <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('tags');?>:</label>
            <div class="col-sm-4 col-lg-5 controls">
                <?php $v = (set_value('tags')!='')?set_value('tags'):get_post_meta($estate->id,'tags','');?>
                <textarea class="form-control" name="tags"><?php echo $v;?></textarea>
                <span class="help-inline">Put tags as , (comma) separated</span>
                <?php echo form_error('tags'); ?>
            </div>
        </div>

      </div>
    </div>

    <!-- facilities box start -->
    <div class="box">

      <div class="box-title">
        <h3><i class="fa fa-bars"></i><?php echo lang_key('general_amenities');?></h3>
        <div class="box-tool">
          <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
        </div>
      </div>

      <div class="box-content">
            <ul class="facilities">
                <?php
                $facilities = get_all_facilities();
                if($facilities->num_rows()<=0)
                {
                    echo 'No feature list found';
                }
                else
                {
                    foreach ($facilities->result() as $facility) 
                    {
                      $v = (set_value('facilities')!='')?set_value('facilities'):json_decode($estate->facilities);
                      $sel = (is_array($v) && in_array($facility->id,$v))?'checked="checked"':'';
                ?>
                        <li class="col-md-3">
                            <label>
                                <img style="width:20px" src="<?php echo base_url('uploads/thumbs/'.$facility->icon);?>">
                                <input type="checkbox" name="facilities[]" value="<?php echo $facility->id;?>" <?php echo $sel;?>>
                                <?php echo lang_key($facility->title);?>
                            </label>
                        </li>
                <?php 
                    }
                }
                ?>
            </ul>
            <div class="clearfix"></div>    
      </div>
    </div>

    <!-- end facilities box -->

    <?php 
          $this->config->load('realcon');
          $enable_custom_fields = $this->config->item('enable_custom_fields');
          if($enable_custom_fields=='Yes')
          {


    ?>
    <!-- custom box start -->
    <div class="box">

      <div class="box-title">
        <h3><i class="fa fa-bars"></i><?php echo lang_key('custom_fields');?></h3>
        <div class="box-tool">
          <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
        </div>
      </div>

      <div class="box-content">
            <?php 
              $custom_values = (array)json_decode(get_post_meta($estate->id,'custom_values','[]'));
              $fields = $this->config->item('custom_fields');
              foreach ($fields as $field) {
                $field_val = (isset($custom_values[$field['name']]))?$custom_values[$field['name']]:'';
                $v = (set_value($field['name'])!='')?set_value($field['name']):$field_val;
                if($field['type']=='text')
                {
                  ?>
                  <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key($field['title']); ?>:</label>
                    <div class="col-sm-6 col-lg-6 controls">
                       
                        <input class="form-control" type="text" name="<?php echo $field['name'];?>" value="<?php echo $v;?>">
                        <?php echo form_error($field['name']);?>
                        <span class="help-inline">&nbsp;</span>
                    </div>
                  </div>

                  <?php
                }
                elseif($field['type']=='textarea')
                {
                  ?>
                  <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key($field['title']); ?>:</label>
                    <div class="col-sm-6 col-lg-6 controls">
                        <textarea name="<?php echo $field['name'];?>" class="form-control"><?php echo $v;?></textarea>
                        <?php echo form_error($field['name']);?>
                        <span class="help-inline">&nbsp;</span>
                    </div>
                  </div>
                  <?php
                }
                elseif($field['type']=='select')
                {
                  ?>
                  <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key($field['title']); ?>:</label>
                    <div class="col-sm-6 col-lg-6 controls">
                        <select class="form-control" name="<?php echo $field['name'];?>">
                          <?php foreach ($field['value'] as $key => $label) {
                              $sel = ($v==$key)?'selected="selected"':'';
                            ?>
                              <option value="<?php echo $key;?>" <?php echo $sel;?>><?php echo $label;?></option>
                            <?php
                          }?>
                        </select>
                        <?php echo form_error($field['name']);?>
                        <span class="help-inline">&nbsp;</span>
                    </div>
                  </div>
                  <?php
                }
              }
            ?>
            <div class="clearfix"></div>    
      </div>
    </div>

    <!-- end custom box -->
    <?php
        }
    ?>

    <?php if(get_settings('realestate_settings','enable_distance_fields','Yes')=='Yes'){?>
    <!-- Distances box -->
    <div class="box">

      <div class="box-title">
        <h3><i class="fa fa-bars"></i><?php echo lang_key('distance');?></h3>
        <div class="box-tool">
          <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
        </div>
      </div>

      <div class="box-content">
        <?php
        if(count($distance_info)>0)
        {
            foreach ($distance_info as $key => $distance) {
              $val = json_decode($distance);
        ?>
                <div class="form-group">
                    <input type="hidden" name="distance_title[]" value="<?php echo $val->{'title'}; ?>">
                    <?php if(!isset($val->{'icon'})) {
                            $val->{'icon'} = get_distance_field_icon($val->{'id'});
                    }?>
                    <input type="hidden" name="distance_icon[]" value="<?php echo $val->{'icon'}; ?>">
                    <input type="hidden" name="distance_id[]" value="<?php echo $val->{'id'}; ?>">
                    <label class="col-sm-3 col-lg-2 control-label"><?php echo $val->{'title'}; ?>:</label>
                    <div class="col-sm-4 col-lg-3 controls">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" placeholder="Distance" value="<?php echo $val->{'value'}; ?>" name="distance_value[]" >
                        </div>
                        <span class="help-inline">&nbsp;</span>
                    </div>

                    <div class="col-sm-4 col-lg-2 controls">

                        <select class="form-control input-sm" name="distance_unit[]">
                            <?php
                            
                            $distance_unit = $val->{'units'};

                            //the following if else block is needed to convert the values already in the database to correct form
                            if($distance_unit == 'Minute(s)'){
                              $distance_unit = 'Minutes';
                            }
                            else if($distance_unit == 'Meter(s)'){
                              $distance_unit = 'Meters';
                            }
                            else if($distance_unit == 'Feet(s)'){
                              $distance_unit = 'Feets';
                            }
                            else if($distance_unit == 'Kilometer(s)'){
                              $distance_unit = 'Kilometers';
                            }
                            else if($distance_unit == 'Mile(s)'){
                              $distance_unit = 'Miles';
                            }
                            
                            $units = array('Minutes'=>'Minute(s)','Meters'=>'Meter(s)','Feets'=>'Feet(s)', 'Kilometers' => 'Kilometer(s)', 'Miles' => 'Mile(s)');

                            foreach ($units as $val=>$unit)
                            {
                                $sel = ($val==$distance_unit)?'selected="selected"':'';
                                ?>
                                <option value="<?php echo $val;?>" <?php echo $sel;?>><?php echo $unit;?></option>
                            <?php
                            }
                            ?>

                        </select>
                        <span class="help-inline">&nbsp;</span>
                    </div>
                </div>

        <?php 
            }
        }
        ?>
        <div class="clearfix"></div>    
      </div>
    </div>

    <!-- end distances box -->
    <?php }?>

    
      <div class="row">
          <div class="col-md-7">
              <!-- address box start -->
              <div class="box">

                  <div class="box-title">
                      <h3><i class="fa fa-bars"></i><?php echo lang_key('address');?></h3>
                      <div class="box-tool">
                          <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
                      </div>
                  </div>

                  <div class="box-content">

                      <div class="form-group">
                          <label class="col-sm-4 col-lg-3 control-label"><?php echo lang_key('address');?>:</label>
                          <div class="col-sm-7 col-lg-8 controls">
                              <?php $address = (set_value('address')!='')?set_value('address'):$estate->address;?>
                              <input type="text" id="address" name="address" value="<?php echo $address;?>" placeholder="<?php echo lang_key('address');?>" class="form-control input-sm" >
                              <span class="help-inline">&nbsp;</span>
                              <?php echo form_error('address'); ?>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-4 col-lg-3 control-label"><?php echo lang_key('country');?>:</label>
                          <div class="col-sm-7 col-lg-8 controls">
                              <select name="country" id="country" class="form-control">
                                  <?php foreach (get_all_countries()->result() as $row) {
                                      $v = (set_value('country')!='')?set_value('country'):$estate->country;
                                      $sel = ($row->id==$v)?'selected="selected"':'';
                                      ?>
                                      <option data-name="<?php echo $row->name;?>" value="<?php echo $row->id;?>" <?php echo $sel;?>><?php echo $row->name;?></option>
                                  <?php }?>
                              </select>
                              <span class="help-inline">&nbsp;</span>
                              <?php echo form_error('country'); ?>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-4 col-lg-3 control-label"><?php echo lang_key('state_province');?>:</label>
                          <div class="col-sm-7 col-lg-8 controls">
                              <?php $selected_state = (set_value('selected_state')!='')?set_value('selected_state'):$estate->state;?>
                              <input type="hidden" name="selected_state" id="selected_state" value="<?php echo $selected_state;?>">
                              <input type="text" id="state" name="state" value="<?php echo get_location_name_by_id($selected_state);?>" placeholder="<?php echo lang_key('state_province');?>" class="form-control input-sm" >
                              <span class="help-inline state-loading">&nbsp;</span>
                              <?php echo form_error('state'); ?>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-4 col-lg-3 control-label"><?php echo lang_key('city');?>:</label>
                          <div class="col-sm-7 col-lg-8 controls">
                              <?php $selected_city = (set_value('selected_city')!='')?set_value('selected_city'):$estate->city;?>
                              <input type="hidden" name="selected_city" id="selected_city" value="<?php echo $selected_city;?>">
                              <input type="text" id="city" name="city" value="<?php echo get_location_name_by_id($selected_city);?>" placeholder="<?php echo lang_key('city');?>" class="form-control input-sm" >
                              <span class="help-inline city-loading">&nbsp;</span>
                              <?php echo form_error('city'); ?>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-4 col-lg-3 control-label"><?php echo lang_key('zip_code');?>:</label>
                          <div class="col-sm-7 col-lg-8 controls">
                              <?php $zip_code = (set_value('zip_code')!='')?set_value('zip_code'):$estate->zip_code;?>
                              <input type="text" name="zip_code" value="<?php echo $zip_code;?>" placeholder="<?php echo lang_key('zip_code');?>" class="form-control input-sm" >
                              <span class="help-inline">&nbsp;</span>
                              <?php echo form_error('zip_code'); ?>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-4 col-lg-3 control-label">&nbsp;</label>
                          <div class="col-sm-7 col-lg-8 controls">
                              <a href="#" class="btn btn-danger" onclick="codeAddress()"><i class="fa fa-map-marker"></i> <?php echo lang_key('view_on_map');?></a>
                          </div>
                      </div>


                      <div class="form-group">
                          <label class="col-sm-4 col-lg-3 control-label">Latitude:</label>
                          <div class="col-sm-7 col-lg-8 controls">
                              <?php $latitude = (set_value('latitude')!='')?set_value('latitude'):$estate->latitude;?>
                              <input type="text" id="latitude" name="latitude" value="<?php echo $latitude;?>" placeholder="Latitude" class="form-control input-sm" >
                              <span class="help-inline">&nbsp;</span>
                              <?php echo form_error('latitude'); ?>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-4 col-lg-3 control-label">Longitude:</label>
                          <div class="col-sm-7 col-lg-8 controls">
                              <?php $longitude = (set_value('longitude')!='')?set_value('longitude'):$estate->longitude;?>
                              <input type="text" id="longitude" name="longitude" value="<?php echo $longitude;?>" placeholder="Longitude" class="form-control input-sm" >
                              <span class="help-inline">&nbsp;</span>
                              <?php echo form_error('longitude'); ?>
                          </div>
                      </div>

                  </div>
              </div>

              <!-- end addess box -->
          </div>
          <div class="col-md-5">
              <div class="box">

                  <div class="box-title">
                      <h3><i class="fa fa-bars"></i>Map</h3>
                      <div class="box-tool">
                          <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
                      </div>
                  </div>

                  <div class="box-content">

                      <div id="map-canvas" style="height: 400px; width:100%;"></div>
                  </div></div>
          </div>
      </div>


    <!-- image box start -->
    <div class="box">

      <div class="box-title">
        <h3><i class="fa fa-bars"></i>Images</h3>
        <div class="box-tool">
          <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
        </div>
      </div>

       <div class="box-content">

            
            <h4><?php echo lang_key('featured_image');?> :</h4>
            
            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label">&nbsp;</label>
                <div class="col-sm-4 col-lg-5 controls">
                    <?php $featured_img = (set_value('featured_img')!='')?set_value('featured_img'):$estate->featured_img;?>
                    <img class="thumbnail" id="featured_photo" src="<?php echo get_featured_photo_by_id($featured_img);?>" style="width:256px;">
                </div>
                <div class="clearfix"></div>                   
                <span id="featured-photo-error"><?php echo form_error('featured_img');?></span> 
            </div>

            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('featured_image');?>:</label>
                <div class="col-sm-4 col-lg-5 controls">                    
                    <input type="hidden" name="featured_img" id="featured_photo_input" value="<?php echo $featured_img;?>">                    
                    <iframe src="<?php echo site_url('admin/realestate/featuredimguploader');?>" style="border:0;margin:0;padding:0;height:130px;"></iframe>
                    <span class="help-inline">&nbsp;</span>
                </div>          
            </div>
            <div class="clearfix"></div>

            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('embed_video_url');?>:</label>
                <div class="col-sm-4 col-lg-5 controls">
                    <span id="video_preview"></span>
                    <input type="text" class="form-control" name="video_url" id="video_url" value="<?php echo get_post_meta($estate->id,'video_url');?>">
                    <span class="help-inline">youtube or videmo url</span>
                </div>          
            </div>
            <div class="clearfix"></div>

           <div class="form-group">

               <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('estate_brochure');?>:</label>
               <div class="col-sm-4 col-lg-5 controls">
                   <?php $v = (isset($_POST['estate_brochure'])) ? $_POST['estate_brochure'] : get_post_meta($estate->id,'estate_brochure'); ?>
                   <input type="hidden" name="estate_brochure" id="estate_brochure_input" value="<?php echo $v;?>">
                   <span class="help-inline">Upload PDF, Doc or DocX file</span>
                   <iframe src="<?php echo site_url('admin/realestate/brochureuploader');?>" style="border:0;margin:0;padding:0;height:130px;"></iframe>

               </div>

           </div>
           <?php if($v != ''){
           ?>
               <span id="brochure-error"><label class="col-sm-3 col-lg-2">&nbsp;</label><div class="col-sm-4 col-lg-5"><div class="alert alert-success" style="margin-bottom:0;"><?php echo $v;?></div></div></span>
           <?php
           } else {
           ?>
           <span id="brochure-error"></span>
           <?php }
           ?>

           <div class="clearfix"></div>

            <h4>Gallery :</h4>
            <?php $gallery = ($estate->gallery!='')?json_decode($estate->gallery):array();?>
            <?php //echo $estate->gallery;die;?>
            <ul class="multiple-uploads">
                <?php foreach ($gallery as $item) {
                ?>
                <li style="margin:10px 10px 0 0;overflow:hidden">
                  <input type="hidden" name="gallery[]" value="<?php echo $item;?>" />
                  <image src="<?php echo base_url('uploads/gallery/'.$item);?>" style="height:100%"/>
                  <div class="remove-image" onclick="jQuery(this).parent().remove();">X</div>
                </li>
                <?php }?>
                <li class="add-image">+</li>
            </ul>       
            <div class="clearfix"></div>
            <span style="font-size:14px;font-style: italic;">NB: you can drag drop to reorder the gallery photos. Photos are not resized.</span>
            <div class="clearfix" style="height:20px;"></div>

      </div>
    </div>

    <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> <?php echo lang_key('update'); ?></button>

    <!-- end image box -->
    </form>

  </div>
</div>
<!--Rich text editor-->
<script src="<?php echo base_url();?>assets/admin/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
<script src="<?php echo base_url();?>assets/admin/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<script type="text/javascript">
    function getUrlVars(url) {
        var vars = {};
        var parts = url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    }

    function showVideoPreview(url)
    {
      if(url.search("youtube.com")!=-1)
      {
        var video_id = getUrlVars(url)["v"];
        //https://www.youtube.com/watch?v=jIL0ze6_GIY
        var src = '//www.youtube.com/embed/'+video_id;
        //var src  = url.replace("watch?v=","embed/");
        var code = '<iframe class="thumbnail" width="100%" height="420" src="'+src+'" frameborder="0" allowfullscreen></iframe>';
        jQuery('#video_preview').html(code);
      }
      else if(url.search("vimeo.com")!=-1)
      {
        //http://vimeo.com/64547919
        var segments = url.split("/");
        var length = segments.length;
        length--;
        var video_id = segments[length];
        var src  = url.replace("vimeo.com","player.vimeo.com/video");
        var code = '<iframe class="thumbnail" src="//player.vimeo.com/video/'+video_id+'" width="100%" height="420" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        jQuery('#video_preview').html(code);
      }
      else
      {
        //alert("only youtube and video url is valid");
      }
    }

    $(document).ready(function(){

        var type_arr = ['DBC_TYPE_APARTMENT', 'DBC_TYPE_HOUSE','DBC_TYPE_LAND','DBC_TYPE_COMSPACE', 'DBC_TYPE_CONDO', 'DBC_TYPE_VILLA'];

        jQuery( ".my-date-picker" ).datepicker();
        jQuery( "#format" ).change(function() {
          jQuery( ".my-date-picker" ).datepicker( "option", "dateFormat", $( this ).val() );
        });
        
        jQuery('#video_url').change(function(){
          var url = jQuery(this).val();
          showVideoPreview(url);
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
                    "<?php echo site_url('admin/realestate/get_states_ajax');?>/",
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
                    "<?php echo site_url('admin/realestate/get_cities_ajax');?>/",
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

        var base_url = "<?php echo base_url();?>";

      

        jQuery('#featured_photo_input').change(function(){
            var val = jQuery(this).val();
            var src = base_url+'uploads/thumbs/'+val;
            jQuery('#featured_photo').attr('src',src);
        }).change();

        



        var estate_type = $('#type-select').val();
        $('#home-size-holder').hide();
        $('#lot-size-holder').hide();
        $('#bedroom-holder').hide();
        $('#bath-holder').hide();
        $('#year-built-holder').hide();

        if(estate_type == 'DBC_TYPE_APARTMENT' ||  estate_type == 'DBC_TYPE_HOUSE' || estate_type == 'DBC_TYPE_COMSPACE' || estate_type == "DBC_TYPE_CONDO" || estate_type == "DBC_TYPE_VILLA"){
            $('#home-size-holder').show();
            $('#year-built-holder').show();
        }

        if(estate_type == 'DBC_TYPE_APARTMENT' ||  estate_type == 'DBC_TYPE_HOUSE' || estate_type == "DBC_TYPE_CONDO" || estate_type == "DBC_TYPE_VILLA"){
            $('#bedroom-holder').show();
            $('#bath-holder').show();
        }


        if( estate_type == 'DBC_TYPE_HOUSE' || estate_type == 'DBC_TYPE_LAND' || estate_type == "DBC_TYPE_VILLA"){
            $('#lot-size-holder').show();
        }

        if(estate_type!='' && jQuery.inArray(estate_type,type_arr)<0) {
            $('#home-size-holder').show('slow');
            $('#lot-size-holder').show('slow');
            $('#bedroom-holder').show('slow');
            $('#bath-holder').show('slow');
            $('#year-built-holder').show('slow');
        }

        $('#type-select').change(function(){
            var estate_type = $('#type-select').val();

            if(estate_type!='' && jQuery.inArray(estate_type,type_arr)<0) {
                $('#home-size-holder').show('slow');
                $('#lot-size-holder').show('slow');
                $('#bedroom-holder').show('slow');
                $('#bath-holder').show('slow');
                $('#year-built-holder').show('slow');
            }
            else {
              
              if(estate_type == 'DBC_TYPE_APARTMENT' ||  estate_type == 'DBC_TYPE_HOUSE' || estate_type == 'DBC_TYPE_COMSPACE' || estate_type == "DBC_TYPE_CONDO" || estate_type == "DBC_TYPE_VILLA"){
                  $('#home-size-holder').show('slow');
                  $('#year-built-holder').show('slow');
              }
              else {
                  $('#home-size-holder').hide('slow');
                  $('#year-built-holder').hide('slow');
              }

              if( estate_type == 'DBC_TYPE_HOUSE' || estate_type == 'DBC_TYPE_LAND' || estate_type ==  "DBC_TYPE_VILLA"){
                  $('#lot-size-holder').show('slow');
              }
              else{
                  $('#lot-size-holder').hide('slow');
              }

              if(estate_type == 'DBC_TYPE_APARTMENT' ||  estate_type == 'DBC_TYPE_HOUSE' || estate_type == "DBC_TYPE_CONDO" || estate_type == "DBC_TYPE_VILLA"){
                  $('#bedroom-holder').show('slow');
                  $('#bath-holder').show('slow');
              }
              else{
                  $('#bedroom-holder').hide('slow');
                  $('#bath-holder').hide('slow');
              }
            }

        });

        var estate_purpose = $('#purpose-select').val();
        $('#sales-price-holder').hide();
        $('#rent-price-holder').hide();

        if( estate_purpose == 'DBC_PURPOSE_BOTH'){
            $('#sales-price-holder').show();
            $('#rent-price-holder').show();

        }
        else if(estate_purpose == 'DBC_PURPOSE_SALE'){
            $('#sales-price-holder').show();
            $('#rent-price-holder').hide();
        }
        else{
            $('#sales-price-holder').hide();
            $('#rent-price-holder').show();
        }

        $('#purpose-select').change(function(){
            var estate_purpose = $('#purpose-select').val();
            var price_neg = $('#price_negotiable').val();
            if(price_neg!=1) {

              if( estate_purpose == 'DBC_PURPOSE_BOTH'){
                  $('#sales-price-holder').show('slow');
                  $('#rent-price-holder').show('slow');

              }
              else if(estate_purpose == 'DBC_PURPOSE_SALE'){
                  $('#sales-price-holder').show('slow');
                  $('#rent-price-holder').hide('slow');
              }
              else{
                  $('#sales-price-holder').hide('slow');
                  $('#rent-price-holder').show('slow');
              }
            }
        });

        $('#price_negotiable').change(function(){
          var price_neg = $(this).val();
          if(price_neg==1) {
            $('#sales-price-holder').hide('slow');
            $('#rent-price-holder').hide('slow');
          }
          else {
            var estate_purpose = $('#purpose-select').val();
            if( estate_purpose == 'DBC_PURPOSE_BOTH'){
                $('#sales-price-holder').show('slow');
                $('#rent-price-holder').show('slow');

            }
            else if(estate_purpose == 'DBC_PURPOSE_SALE'){
                $('#sales-price-holder').show('slow');
                $('#rent-price-holder').hide('slow');
            }
            else{
                $('#sales-price-holder').hide('slow');
                $('#rent-price-holder').show('slow');
            }
          }
        }).change();

        var array = new Array();   
        jQuery('#lang_key_id').click(function(e){
          e.preventDefault();
          jQuery('.loading_status').html('<img src="<?php echo base_url();?>/assets/admin/img/loading.gif" alt ="Loading..."/>');

          var lang = jQuery('.active').children("a").eq(2).text();
          lang = lang.replace(/\s/g,"");
          var title = 'title'+lang;
          title = title.replace(/\s/g, "");
          var input_title = "input[name='"+title+"']";
          var input_desc = "description"+lang;
          input_desc = input_desc.replace(/\s/g, "");
          var input_desc = "textarea[name='"+input_desc+"']";
          title = jQuery(input_title).val();
          var desc = jQuery(input_desc).val();
          array[lang] = desc;
         jQuery.ajaxSetup ({  cache: false  });
         jQuery.post(
          '<?php echo site_url();?>/admin/system/translate_title_description_ajax',
          {lang:lang,title:title,desc:desc},
          function(data,status){
            //console.log(data);
            jQuery('.loading_status').html('');
            jQuery('.loading_status').html('<div class="alert alert-success " style="margin:0 auto;">Language has been translated successfully</div>');
            var obj = jQuery.parseJSON(data);
            jQuery.each(obj, function(key, value) {
              var lang_value = value.lang;
              title = 'title'+value.lang;
              title  = title.replace(/\s/g, "");
              input_title = "input[name='"+title+"']";
              jQuery(input_title).val(value.title);
              input_desc = 'description'+value.lang;
              lang_value= lang_value.replace(/\s/g, "");
              array[lang_value]= value.description;
              input_desc = input_desc.replace(/\s/g, "");
              input_desc = "textarea[name='"+input_desc+"']";
              input_desc = input_desc.replace(/\s/g, "");
              jQuery(input_desc).html(value.description);
            });
          }
         );
      });
      jQuery('#myTab1>li>a').click(function(e){
        e.preventDefault();
        var alink = this.href.split("#");
       jQuery("iframe").contents().find("body").html(array[alink[1]]);
      });
    });
</script>

<?php require'multiple-uploader.php';?>
<script type="text/javascript">
jQuery(document).ready(function(){
    
    jQuery('.multiple-uploads > .add-image').click(function(){
        jQuery('#photoimg').attr('target','.multiple-uploads');
        jQuery('#photoimg').attr('input','gallery');
        jQuery('#photoimg').click();
    });

    jQuery( ".multiple-uploads" ).sortable();
});
</script>
<style type="text/css">
.multiple-uploads{
    list-style: none;
    margin:0;
    padding: 10px;
}
.multiple-uploads li{
     width: 100px;
     height: 100px;
     float: left;
     margin-right: 10px;
     margin-top: 10px;
     cursor: move;
}
.multiple-uploads .add-image{
    border: 3px dashed #aaa;
    height: 100px;
    padding-top: 0px;
    text-align: center;
    width: 100px;
    cursor: pointer !important;
    font-size: 65px;
    color: #aaa;
}
.multiple-uploads .add-image:hover{
    border: 3px dashed #78a;
    color: #78a;
}

.multiple-uploads .remove-image{
    color: red;
    cursor: pointer;
    float: right;
    font-size: 17px;
    font-weight: bold;
    left: -6px;
    position: relative;
    top: -102px;
    width: 10px;
}
</style>