<div class="pageContainer">
    <h4><?php if(isset($module)) echo $module; ?></h4>
   	<h1> Oops. <br><br>Some error occured.</h1> <h3><br>Try again later<br> <br>If the problem persists, please contact admin </h3>
	<h1>Cause of Error: <br><br><br><span style:color=red><?php if(isset($error)) echo $error; ?> </span> </h1>
	<p><a href="javascript:history.go(-1)" title="Return to previous page">&laquo;Back</a></p>
	
</div>