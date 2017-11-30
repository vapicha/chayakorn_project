
<?php
	use yii\helpers\Html;
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
	            <?=Html::img($model->urlPhoto, ['width' => 120])?>
	        </td>
	        <td width="100%">
				<?=$model->qrcode?><br />
				<div>
					<h4>ชื่อ <strong><i><?=$model->fullname?></i></strong></h4><br />
		            <strong>เบอร์โทรศัพท์</strong>
		            <small> <?=$model->phone_number?></small><br />
		            <strong>วันเกิด</strong>
		            <small> <?=$model->birth_date?></small>
				</div>
	        </td>
	        
	    </tr>
	</table>
</div>