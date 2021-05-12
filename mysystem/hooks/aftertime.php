<?php 
if(basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)){header("Location: 404");}
   /*add two variable and include this file this 
	$time = 1; //min
  $file = BASE_URL.'512'; 
  require HOOKS_PATH.'aftertime.php'; */
?>
<script>
  var TimeLimit = <?php echo $time * 10 ; ?>;
  var File = "<?php echo $file ; ?>";
  var timeSinceLastMove = 0;
  document.addEventListener("load",checkTime()); 
  function checkTime() {	 
      timeSinceLastMove++;
      //document.getElementById("demo").innerHTML = timeSinceLastMove; for testing
      if (timeSinceLastMove > TimeLimit) {
               window.location = File;
      }
     setTimeout(checkTime, 1000);
  }
  function addAfterTime(el, s, fn) {
    var evts = s.split(' ');
    for (var i=0, iLen=evts.length; i<iLen; i++) {
      el.addEventListener(evts[i], fn, false);
    }
  }
  addAfterTime(document, 'mousemove keyup', function(event) {
       timeSinceLastMove = 0;
  });
</script>