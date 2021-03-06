<?php echo $this->Html->script('ckeditor/ckeditor'); ?>
<?php echo $this->Html->script('ckfinder/ckfinder'); ?>
<div class="row">
    <div class="col-lg-6">
        <h3>Edit Page</h3> 
        <?php echo $this->Session->flash(); ?>   
    </div> 
    <div class="col-lg-6">                        
        <div class="addbutton">                
        </div>
    </div>
</div>   
<div class="row">        
    <?php echo $this->Form->create('StoreContent', array('url' => array('controller' => 'hq', 'action' => 'editPage'))); ?>
    <div class="col-lg-6">            


        <div class="form-group form_margin">		 
            <label>Name<span class="required"> * </span></label>               

            <?php
            echo $this->Form->input('StoreContent.name', array('type' => 'text', 'class' => 'form-control valid', 'placeholder' => 'Enter Type', 'label' => '', 'div' => false));
            echo $this->Form->error('StoreContent.name');
            echo $this->Form->input('StoreContent.id', array('type' => 'hidden'));
            echo $this->Form->input('StoreContent.store_id', array('type' => 'hidden'));
            ?>
        </div>
        <div class="form-group form_margin">		 
            <label>Content Key<span class="required"> * </span></label>               

            <?php
            echo $this->Form->input('StoreContent.content_key', array('type' => 'text', 'class' => 'form-control valid', 'placeholder' => 'Enter Type', 'label' => '', 'div' => false));
            echo $this->Form->error('StoreContent.content_key');
            ?>
        </div>

        <div class="form-group">
            <label class="radioLabel">Page Position<span class="required"> * </span></label>                
            <?php
            echo $this->Form->input('StoreContent.page_position', array(
                'type' => 'radio',
                'options' => array('1' => 'Main Menu', '2' => 'Footer Menu'),
                'default' => 1,
                'label' => false,
                'legend' => false,
                'div' => false
            ));
            echo $this->Form->error('StoreContent.page_position');
            ?>
        </div>

        <div class="form-group form_spacing">
            <label>Page Content</label> 
            <?php
            echo $this->Form->textarea('StoreContent.content', array('class' => 'ckeditor'));
            echo $this->Form->error('StoreContent.content');
            ?>
        </div>

        <div class="form-group form_margin">
            <label class="radioLabel">Status<span class="required"> * </span></label>                
            <?php
            echo $this->Form->input('StoreContent.is_active', array(
                'type' => 'radio',
                'options' => array('1' => 'Active', '0' => 'In-Active'),
                'default' => 1,
                'label' => false,
                'legend' => false,
                'div' => false
            ));
            echo $this->Form->error('StoreContent.is_active');
            ?>
        </div>


        <?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-default')); ?>             
        <?php echo $this->Html->link('Cancel', "/hq/pageList/", array("class" => "btn btn-default", 'escape' => false)); ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div><!-- /.row -->


<script>
    $(document).ready(function () {

        $("#StoreContentEditPageForm").validate({
            debug: false,
            errorClass: "error",
            errorElement: 'span',
            onkeyup: false,
            rules: {
                "data[StoreContent][name]": {
                    required: true,
                },
                "data[StoreContent][content_key]": {
                    required: true,
                },
            },
            messages: {
                "data[StoreContent][name]": {
                    required: "Please enter page name",
                },
                "data[StoreContent][content_key]": {
                    required: "Please enter content key",
                },
            }, highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            }
        });
    });
    var url = '<?php echo HTTP_ROOT . 'js/'; ?>';
    CKEDITOR.env.isCompatible = true;
    var editor = CKEDITOR.replace('StoreContentContent', {
        filebrowserBrowseUrl: url + 'ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: url + 'ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: url + 'ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
</script>

<style>
    input[type="radio"] {
        line-height: normal;
        margin: 4px 10px;
    }
    .radioLabel{
        margin-right: 45px;
    }
</style>