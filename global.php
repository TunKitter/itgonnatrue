<?php
$home_path = '../..';

?>
<script>
function launch_toast(text,bg=null) {
var x = document.getElementById("toast")
document.getElementById('desc').innerText = text
if(bg) {
    x.style.backgroundColor = bg
    document.getElementById('img').style.color = bg
}
x.className = "show";
setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);

}       
</script>
