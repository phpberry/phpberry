<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    header('Location: 404');
}
?>
<script type="text/javascript">
    window.oncontextmenu = function (event) {
        event.preventDefault();
    }

    function addMultifordev(el, s, fn) {
        var evts = s.split(' ');
        for (var i = 0, iLen = evts.length; i < iLen; i++) {
            el.addEventListener(evts[i], fn, false);
        }
    }

    addMultifordev(window, 'keyup keydown', function (event) {
        if (event.ctrlKey && event.shiftKey && (event.keyCode == 73 || event.keyCode == 74)) {
            event.preventDefault();
        }
        if (event.keyCode == 123) {
            event.preventDefault();
        }
        if (event.ctrlKey && (event.keyCode == 85 || event.keyCode == 83)) {
            event.preventDefault();
        }
        <?php //if($print){?>
        /*    if (event.ctrlKey && (event.keyCode == 80)) {                
                    event.preventDefault();                
            }*/
        <?php //}?>
    });
    console.log("%cStop!", "color: #FF0000; font-size:75px; font-family: serif;font-weight: bold;");
    console.log("%cThis is a browser feature intended for developers. If someone told you to copy and paste something here to enable a feature or 'hack' someone's account, it is a scam and will give them access to your account.", "color: #008000; font-size:20px;font-family: monospace;font-weight: bold;");
</script>