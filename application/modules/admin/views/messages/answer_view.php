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
                                <th class="numeric"><?php echo lang_key('name'); ?></th>
                                <th class="numeric"><?php echo lang_key('created');?></th>
                                <th class="numeric"><?php echo lang_key('message'); ?></th>
                            </tr>

                            </thead>

                            <tbody>
                            <?php foreach($messages->result() as $row) { if($url==$row->url) { ?>
                            <tr>
                                <td data-title="<?php echo lang_key('name'); ?>" class="numeric">
                                    <?php if ($row->from_id == 1) echo lang_key('Answer from');?>
                                    <?php echo $user_model->get_user_profile_by_id($row->from_id)->user_name;?>
                                </td>

                                <td data-title="<?php echo lang_key('created'); ?>" class="numeric">
                                    <?php echo $row->created;?>
                                </td>

                                <td data-title="<?php echo lang_key('message'); ?>" class="numeric">
                                    <?php echo $row->message;?>
                                </td>
                            </tr>
                            <?php } } ?>


                            </tbody>
                        </table>


                        <form class="form-horizontal" method="post">
                            <div class="form-group">
                                <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('Write message:'); ?></label>
                                <div class="col-sm-9 col-lg-6 controls">
                                    <textarea name="message" class="form-control"></textarea>
                                    <span class="help-inline">&nbsp;</span>
                                </div>
                            </div>
                            <input type="hidden" name="title" value="<?php echo $url; ?>">
                            <div class="form-group">
                                <label class="col-sm-3 col-lg-2 control-label"></label>
                                <div class="col-sm-9 col-lg-6 controls">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-check"></i><?php echo lang_key("Send") ?>
                                    </button>
                                </div>

                            </div>

                        </form>
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