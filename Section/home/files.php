<?php
	session_start();
	if(isset($_SESSION['username']))
	{
    	$i=0;
		$files= scandir("upload");
		foreach($files as $file)
		{ $i++; }
 		if($i>2)
		{ header('refresh:0;url=./upload/'); }
		else
		{ echo "<script type='text/javascript'> alert('No new uploads here... Please Check the Resource Section...'); </script>"; 
	  	?>
	  	<script type="text/javascript">close();</script>
	  	<?php
		}
	}
	else
	{
		?>
        <script type="text/javascript">close();</script>
        <?php
	}
?>