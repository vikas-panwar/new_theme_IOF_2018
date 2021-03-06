<div class="row">
    <div class="col-lg-12">
        <h3>Newsletter Listing</h3>
        <hr>
        <?php echo $this->Session->flash(); ?> 
    </div>
    <div class="col-lg-12">
        <div class="table-responsive">   
            <?php echo $this->Form->create('Newsletter', array('url' => array('controller' => 'newsletters', 'action' => 'newsletterList'), 'id' => 'NewsletterId', 'type' => 'post')); ?>
            <div class="row padding_btm_20">
                <div class="col-lg-3">		     
                    <?php
                    $options = array('1' => 'Active', '0' => 'Inactive');
                    echo $this->Form->input('Newsletter.is_active', array('type' => 'select', 'class' => 'form-control valid', 'label' => false, 'div' => false, 'autocomplete' => 'off', 'options' => $options, 'empty' => 'Select Status'));
                    ?>		
                </div>
                <div class="col-lg-8">		  
                    <div class="addbutton">                
                        <?php echo $this->Form->button('Add Newsletter', array('type' => 'button', 'onclick' => "window.location.href='/newsletters/index'", 'class' => 'btn btn-default')); ?>  
                    </div>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->element('show_pagination_count'); ?>
            <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                    <tr>	    
                        <th  class="th_checkbox"><?php echo $this->Paginator->sort('Newsletter.name', 'Subject'); ?></th>
                        <th  class="th_checkbox"><?php echo $this->Paginator->sort('Newsletter.created', 'Created'); ?></th>
                        <th  class="th_checkbox">Status : <?php echo $this->Html->image("store_admin/active.png"); ?> /
                            <?php echo $this->Html->image("store_admin/inactive.png"); ?></th>
                        <th  class="th_checkbox">Action</th>

                </thead>

                <tbody class="dyntable">
                    <?php
                    if ($list) {
                        $i = 0;
                        foreach ($list as $key => $data) {
                            $class = ($i % 2 == 0) ? ' class="active"' : '';
                            $EncryptNewsletterID = $this->Encryption->encode($data['Newsletter']['id']);
                            ?>
                            <tr <?php echo $class; ?>>	    
                                <td><?php echo $data['Newsletter']['name']; ?></td>

                                <td>
                                    <?php echo $this->Dateform->us_format($this->Common->storeTimezone('', $data['Newsletter']['created'])); ?>
                                </td>
                                <td>
                                    <?php
                                    if ($data['Newsletter']['is_active']) {
                                        echo $this->Html->link($this->Html->image("store_admin/active.png", array("alt" => "Active", "title" => "Active")), array('controller' => 'newsletters', 'action' => 'activateNewsletter', $EncryptNewsletterID, 0), array('confirm' => 'Are you sure to Inactive Newsletter?', 'escape' => false));
                                    } else {
                                        echo $this->Html->link($this->Html->image("store_admin/inactive.png", array("alt" => "Inactive", "title" => "Inactive")), array('controller' => 'newsletters', 'action' => 'activateNewsletter', $EncryptNewsletterID, 1), array('confirm' => 'Are you sure to Activate Newsletter?', 'escape' => false));
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $this->Html->link($this->Html->image("store_admin/edit.png", array("alt" => "Edit", "title" => "Edit")), array('controller' => 'newsletters', 'action' => 'editNewsletter', $EncryptNewsletterID), array('escape' => false)); ?>
                                    <?php echo " | "; ?>
                                    <?php echo $this->Html->link($this->Html->image("store_admin/time.png", array("alt" => "Cron", "title" => "Cron")), array('controller' => 'newsletters', 'action' => 'newsletterManagement', $EncryptNewsletterID), array('escape' => false)); ?>         
                                    <?php echo " | "; ?>
                                    <?php echo $this->Html->link($this->Html->image("store_admin/delete.png", array("alt" => "Delete", "title" => "Delete")), array('controller' => 'newsletters', 'action' => 'deleteNewsletter', $EncryptNewsletterID), array('confirm' => 'Are you sure to delete Newsletter?', 'escape' => false)); ?>         
                                </td> 

                            </tr>
                            <?php
                            $i++;
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="11" style="text-align: center;">
                                No record available
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>  
            <?php echo $this->element('pagination'); ?>
            <div class="row padding_btm_20" style="padding-top:10px">
                <div class="col-lg-2">   
                    LEGENDS:                        
                </div>
                <div class="col-lg-2"><?php echo $this->Html->image("store_admin/delete.png") . " Delete &nbsp;"; ?></div>
                <div class="col-lg-2"> <?php echo $this->Html->image("store_admin/edit.png") . " Edit"; ?> </div>
                <div class="col-lg-2"> <?php echo $this->Html->image("store_admin/active.png") . " Active"; ?> </div>
                <div class="col-lg-2"> <?php echo $this->Html->image("store_admin/inactive.png") . " Inactive"; ?> </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->css('pagination'); ?>
<script>
    $(document).ready(function () {
        $("#NewsletterIsActive").change(function () {
            $("#NewsletterId").submit();
        });
    });
</script>