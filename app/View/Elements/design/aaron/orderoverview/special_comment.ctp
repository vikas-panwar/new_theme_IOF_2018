<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
                SPECIAL COMMENT
        </h3>
    </div>
    <?php
    $guestUserDetail = $this->Session->check('GuestUser');
    $specialComment = $this->Session->check('Cart.comment');
    $userId = AuthComponent::User('id');
    if (!empty($userId) || !empty($guestUserDetail)) {
        ?>
        <div id="collapsesix" class="panel-collapse collapse in">
            <div class="panel-body">
                <div id="flashSpecialComment"></div>
                <div class="comment-box">
                    <?php echo $this->Form->input('User.comment', array('type' => 'textarea', 'label' => false, 'class' => 'inbox', 'value' => $this->Session->read('Cart.comment'))); ?>
                </div>
                <div class="theme-btn-group">
                    <button class="cont-btn btn saveComment button-color2 button-size1" type="button"><?php echo ($specialComment) ? 'UPDATE COMMENT' : 'SAVE COMMENT'; ?></button>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<script type="text/javascript">
    $(document).on('click', '.saveComment', function () {
        var specialComment = $('#UserComment').val();
        if (specialComment != '') {
            $.ajax({
                type: 'post',
                url: "<?php echo $this->Html->url(array('controller' => 'payments', 'action' => 'saveSpecialComment')); ?>",
                data: {'specialComment': specialComment},
                beforeSend: function () {
                    $.blockUI({css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }});
                },
                complete: function () {
                    $.unblockUI();
                },
                success: function (successResult) {
                    data = JSON.parse(successResult);
                    $("#errorPop").modal('show');
                    $("#errorPopMsg").html(data.msg);
                    //$("#flashSpecialComment").html('<div class="message message-success alert alert-success" id="flashMessage"><a href="#" data-dismiss="alert" aria-label="close" title="close" class="close">×</a> ' + data.msg + '</div>');
                }
            });
        }
    });
</script>