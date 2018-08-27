<div class="row">
    <div class="col-md-12">
        <?php echo $this->session->flashdata('msg'); ?>
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i> <?php echo lang_key('all_messages'); ?></h3>
                <?php $page = ($this->uri->segment(5)!='')?$this->uri->segment(5):0;?>
                <div class="box-tool">
                    <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
                </div>
            </div>

            <div class="box-content">
                <?php $this->load->helper('text'); ?>
                <?php if ($messages->num_rows() <= 0) { ?>
                    <div class="alert alert-info"><?php echo lang_key('no_pages'); ?></div>
                <?php } else { ?>
                    <div id="no-more-tables">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="numeric"><?php echo lang_key('Thread'); ?></th>
                                <th class="numeric"><?php echo lang_key('created');?></th>
                                <th class="numeric"><?php echo lang_key('message'); ?></th>
                                <th class="numeric"><?php echo lang_key('options');?></th>
                            </tr>

                            </thead>

                           <tbody>
                              <?php foreach($messages->result() as $row) { ?>
                              <tr>
                                  <td data-title="<?php echo lang_key('name'); ?>" class="numeric">
                                      <?php //if ($row->from_id == 1) echo lang_key('Answer from');?>
                                      <?php //if ($row->from_id > 1) echo lang_key('Question from');?>
                                      <b><?php echo $user_model->get_user_profile_by_id($row->user_id)->user_name;?></b>
                                      <?php echo " - ".$row->url; ?>
                                      <?php //if ($row->from_id == 1) echo lang_key('to').' '.$user_model->get_user_profile_by_id($row->to_id)->user_name;?>
                                  </td>

                                  <td data-title="<?php echo lang_key('created'); ?>" class="numeric">
                                      <?php echo $row->created;?>
                                  </td>

                                  <td data-title="<?php echo lang_key('message'); ?>" class="numeric">
                                      <?php echo $row->message;?>
                                  </td>

                                  <td data-title="<?php echo lang_key('options'); ?>" class="numeric">
                                      <a href="<?php echo site_url('admin/messages/answer/'.(($row->from_id == 1) ? $row->to_id : $row->from_id))."/".urlencode($row->url);?>">Write message</a>
                                  </td>
                              </tr>
                              <?php } ?>


                           </tbody>
                        </table>

                    </div>

                    <div class="pagination">

                        <ul class="pagination pagination-colory"><?php echo $pages; ?></ul>

                    </div>

                <?php } ?>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">





    jQuery('#searchkey').keyup(function () {



        var val = jQuery(this).val();



        var loadUrl = '<?php echo site_url('admin/search/');?>';



        jQuery("#bookings").html(ajax_load).load(loadUrl, {'key': val});



    });





    var ajax_load = '<div class="box">loading...</div>';





    jQuery('document').ready(function () {



        jQuery.ajaxSetup({



            cache: false



        });



    });



</script>