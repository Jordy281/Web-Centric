<?php
    echo '<div class="col-sm-2">
				<h1>:)</h1>
			</div>
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-2"></div>';
					
						require_once('headerInfo.php');
						foreach($headervalues as $info){
							echo "<div class=\"col-sm-2\">";
							echo "<a href=$info[1]>$info[0]</a>";
							echo "</div>";
						}
					
		echo '</div>
			</div>
            <div class="col-sm-2"></div>';
            
?>