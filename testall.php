<!--<?php
echo exec("whoami");
echo 'ok';
?>-->
<script>
function getcheckbox(){
    var test = document.getElementById("checkbox").checked;
    alert(test);
}
</script>
<input type="checkbox" name="checkbox" id="checkbox"><input type="button" id="button" value="Click Me" onclick="getcheckbox()">
