
<?php
	use yii\helpers\Html;
?>
<?php 
foreach ($model as $file){
?>
<div id="test" style="height:330px; background:url(<?=Yii::getAlias('@frontend').'/web/img/logo.png'?>);"> 
	<table>
		<tr>
			<td width="100%">
				<?=Html::img(Yii::getAlias('@frontend').'/web/img/tab.png', ['width' => 500])?>
			</td>
		</tr>
	</table>
	<table>
	    <tr>
	    	<td width="12%"></td>
	        <td width="60%">
	            <?=Html::img($file->urlPhoto, ['width' => 120])?>
	        </td>
	        <td width="100%">
				<br>
				<div>
					<h4>ชื่อ <strong><i><?=$file->fullname?></i></strong></h4><br />
		            <strong>เบอร์โทรศัพท์</strong>
		            <small> <?=$file->phone_number?></small><br />
		            <strong>รหัส   </strong>
		            <small> <?=$file->code?></small>
				</div>
        		<?=$file->qrcode?><br />
	        </td>
	        
	    </tr>
	</table>
</div>
<?php 
}
?>