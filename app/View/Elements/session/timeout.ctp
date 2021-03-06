<?php if (DESIGN == 1) { ?>
    <div class="modal fade" id="timeoutpop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog clearfix">
            <div class="modal-content">
                <div class = "modal-header">
                    <button aria-label="Close" data-dismiss="modal" class="close" type="button" >
                        <span><img src="/img/4_popup_x.png" alt="#close"></span>
                    </button>
                <h4 class="modal-title">Session Timeout</h4>       
                </div>
    
                <div class="modal-body hc vc"> 
                    <div id="timeout" style='height:60px;'></div>
                    <div>
                        <?php echo $this->Form->button('Click here to continue', array('type' => 'button', 'class' => 'color_white button f18 w260 hc vc button-color1', 'id' => 'stayconnect')); ?>
                    </div>
                <div>
        </div>
           
        </div>    
    </div>
           
    <?php } else if (DESIGN == 2) { ?>
    
    
    <style>
        #timeout       { font-size:15px;float:left;text-align:left;padding:8px;margin:0px }
        .modal-header  { background-color: #fff; }
    /*    .modal-body    { background-color: #fff; }*/
        .modal-content { width: 100%; }
        .btn-primary   { margin-top: 4px; }
    
    </style>
    
    
    <!-- modal for ups calculator -->
    <div class="modal fade" id="timeoutpop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog select-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="lineModalLabel">Session Timeout</h3>
                </div>
                <div class="modal-body">
                    <span class="errorMsg"></span>
                    <div class="container" style="width:auto;">
                        <!-- order type section start  -->
                        <div id="timeout"></div>
                        <!-- order type section end  -->
                        <div class="button-frame" style="float:left;width:40%;">
                            <?php
                            echo $this->Form->button('Click here to continue', array('type' => 'button', 'class' => 'btn-sm btn-primary', 'id' => 'stayconnect'));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php } ?>
    
    <script>
    
        var count = 360;
        var counter = setInterval(timer, 1000); //1000 will  run it every 1 second
        function timer() {
            count = count - 1;
            if (count <= 0) {
                clearInterval(counter);
                clearsession();
                return;
            }
            document.getElementById("timeout").innerHTML = "Your session expiring in " + count + " seconds.";
        }
    
        $(document).ready(function () {
            $('#stayconnect').click(function () {
                clearInterval(counter);
                window.location = window.location;
                $('#timeoutpop').modal('hide');
            });
        });
    
    </script>