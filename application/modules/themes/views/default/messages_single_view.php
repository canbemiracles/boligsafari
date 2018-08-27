<div class="row">

    <!-- Article main content -->
    <article class="col-sm-9 maincontent">
        <h1 class="detail-title">Beskeder mellem dig og udlejer</h1>
        <?php echo $this->session->flashdata('msg');?>
        <form action="<?php echo site_url('show/messages');?>" method="post">
            <div class="row">
                <?php if ($messages->num_rows() > 0) {
                    foreach($messages->result() as $row) { ?>
                        <div class="col-sm-12">
                            <?php //if ($row->from_id == 1) echo lang_key('Answer from').' '.$user_model->get_user_profile_by_id($row->from_id)->user_name.' at ';?>
                            <?php echo "[".$row->created."]  ";?>
                            <?php if ($row->from_id == 1) echo "<b>Udlejer - </b>"; ?>
                            <?php if($row->from_id != 1) echo "<b>Dig - </b>"; ?>
                            <?php echo $row->message;?>
                            <input type="hidden" name="url" value="<?php echo $row->url; ?>">
                            <hr />
                        </div>
                    <?php }
                }?>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <textarea class="form-control" rows="9" name="message"></textarea>
                    <?php echo form_error('message');?>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6 text-right">
                    <input class="btn btn-action" type="submit" value="Send besked">
                </div>
            </div>
        </form>

    </article>
    <!-- /Article -->

    <!-- Sidebar -->
    <aside class="col-sm-3 sidebar sidebar-right">
        <?php echo render_widget('contact_text');?>
    </aside>
    <!-- /Sidebar -->

</div>