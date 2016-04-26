<?php
 session_start();
 $key=$_REQUEST["key"];
 $data=$_SESSION["log_$key"];
 session_write_close();
 ?>

<script type="text/javascript">
 showtrace=function(traceid)
 {
	 
	 if($('trace_'+traceid).visible())
	 {
		 $('trace_'+traceid).update('');
		 $('trace_'+traceid).hide();
	}
	else
	{ 
		 new Ajax.Updater('trace_'+traceid,'trace_details.php',{parameters:{'traceid':traceid},onComplete:function(){$('trace_'+traceid).show()}});
 	}
 }
</script>
 <ul>

 
 <?php 
 
// Work around to line 23 errors
// Stil no idea why $_SESSION["log_$key"] & $_REQUEST["key"] are empty, I blame Dave!
if( !isset($_SESSION["log_$key"]) ) {

	// Ok we have a log_$key that doesn't exist, bummer

	$data=array();	// Make array just in case no errors and will cause the foreach ($data as $line) below not error out
	
	// Open the state/progress.txt and load it to variable
	$workaround	= file_get_contents("../state/progress.txt"); // Note: may need to path check this for better compatibility

	// Now spilt that var to one line per row as an array
	//$workaround = explode("\n", $workaround); // <= this may cause issues on windoze machines, preg match would be better
	$workaround = preg_split("/\\r\\n|\\r|\\n/", $workaround); //preg version :D
	
	// Make sure it's an array
	if( is_array( $workaround ) ) {
		foreach( $workaround as $wa_error) {
		
			if( ( strpos( $wa_error,'error' ) !== false ) || ( strpos( $wa_error,'warning' ) !== false ) ) {
				$data[] = $wa_error; //Woohoo an error, oh wait hat's a bad thing :( At least you now know :)
			}
		
		} // /foreach
	}
}
 
 foreach($data as $line){
 if($key=="error" && preg_match("|\d+:|",$line))
 {
 	$inf=explode(":",$line,2);
 	$errnum=$inf[0];
 	$xdata=$inf[1];
 }
 else
 {
 	$errnum=null;
 	$xdata=$line;
 }
 ?>
 
 <li>
 <?php if($errnum!=null){
 	?>
 		<a name="trace_<?php echo $errnum?>" href="#trace_<?php echo $errnum?>" onclick="showtrace('<?php echo $errnum?>')"><?php echo $errnum?></a>
 	<?php 
 }?><span><?php echo $xdata?></span>
 <?php if($errnum!=null){?>
 	<div style="display:none" class="trace" id="trace_<?php echo $errnum?>"></div>
 </li>
 <?php 
 }
 }?>
 </ul>