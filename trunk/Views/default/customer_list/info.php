<ul class="sui-nav nav-tabs nav-xlarge" style="margin-top: 8px;">
	<li style="width: 8%;" class="active"><a href="#index" data-toggle="tab">
      <h3 style="font-size: 14px;line-height: 0;">基本信息</h3>
     </a>
    </li>
    <li style="width: 8%;"><a href="#address" data-toggle="tab" >
      <h3 style="font-size: 14px;line-height: 0;">收货地址</h3>
     </a>
   </li>
</ul>





<div class="tab-content" style="padding:20px;">
  <div id="index" class="tab-pane active">
  	<form id="ems-form" style="width: 100%;" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
	    <div class="sui-row-fluid">
		    <div class="span2">
		    	<div class="control-group">
				    <label for="inputEmail" class="control-label">用户账号：</label>
				    <div class="controls">
						<span class="input-xlarge input-xfat"><?php echo $accout?></span>
				   </div>
				</div>

		    </div>
		    <div class="span2">
		    	<div class="control-group">
				    <label for="inputEmail" class="control-label">手机类型：</label>
				    <div class="controls">
						<span class="input-xlarge input-xfat"><?php echo ($deviceType==1)?'安卓':'IOS';?></span>

				    </div>
				</div>

		    </div>
			<?php  if($headPhoto):?>
		    <div class="span2">
		    	<img src="<?php echo $headPhoto;?>" width="100" />
		    </div>
			<?php  endif;?>
		</div>



		<div class="control-group">
			<label for="inputDes" class="control-label v-top">会员类型：</label>
			<div class="controls">
				<span class="input-xlarge input-xfat"><?php echo ($makerLevel||$providerType)?'':'普通会员&nbsp;' ;?>
					<?php  if($providerType){ echo ($providerType==1?'供应':'联盟').'商&nbsp;' ; } ?>
					<?php  if($makerLevel){  echo ($makerLevel==1?'金':'银').'星创客' ;}?>
				</span>
			</div>
		</div>
		<div class="control-group">
			<label for="inputDes" class="control-label v-top">昵称：</label>
			<div class="controls">
				<span class="input-xlarge input-xfat"><?php echo $alias ;?></span>
			</div>
		</div>
		<div class="control-group">
			<label for="inputDes" class="control-label v-top">真实姓名：</label>
			<div class="controls">
				<span class="input-xlarge input-xfat"><?php echo $realName ;?></span>
			</div>
		</div>
		<div class="control-group">
			<label for="inputDes" class="control-label v-top">性别：</label>
			<div class="controls">
				<span class="input-xlarge input-xfat"><?php echo $sex=='M'?'男':"女" ;?></span>
			</div>
		</div>
		<div class="control-group">
			<label for="inputDes" class="control-label v-top">捆绑联系手机：</label>
			<div class="controls">
				<span class="input-xlarge input-xfat"><?php echo $mobilePhone ;?></span>
			</div>
		</div>
		<div class="control-group">
			<label for="inputDes" class="control-label v-top">出生年月日：</label>
			<div class="controls">
				<span class="input-xlarge input-xfat"><?php echo $birthday ;?></span>
			</div>
		</div>
		<div class="control-group">
			<label for="inputDes" class="control-label v-top">上级会员账号：</label>
			<div class="controls">
				<span class="input-xlarge input-xfat"><?php echo $superioraccount ;?></span>
			</div>
		</div>
		<div class="control-group">
			<label for="inputDes" class="control-label v-top">下级总数：</label>
			<div class="controls">
				<span class="input-xlarge input-xfat"><?php echo $lowertotal ;?></span>
			</div>
		</div>
		<div class="control-group">
			<label for="inputDes" class="control-label v-top">加入时间：</label>
			<div class="controls">
				<span class="input-xlarge input-xfat"><?php echo $createDate ;?></span>
			</div>
		</div>
		<div class="control-group">
			<label for="inputDes" class="control-label v-top">状态：</label>
			<div class="controls">
				<span class="input-xlarge input-xfat"><?php echo $status==1?'正常':'注销' ;?></span>
			</div>
		</div>


	</form>
  </div>
  <div id="address" class="tab-pane">
  	<form id="ems-form" style="width: 100%;" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
    	<?php if($receivingAddress){?>
    	<?php foreach($receivingAddress as $ra_key=>$ra_val){?>
    	<div class="sui-row-fluid" style="margin-top:10px;padding-top: 10px;border: 1px solid #F0F0F0;border-radius: 5px;">
		    <div class="span2">
				<div class="control-group">
				    <label for="inputEmail" class="control-label">收货人：</label>
				    <div class="controls">
				      <?php echo $ra_val['receivingPeople'];?>
				    </div>
				</div>
				<div class="control-group">
				    <label for="inputEmail" class="control-label">联系方式：</label>
				    <div class="controls">
				      <?php echo $ra_val['telephone'];?>
				    </div>
				</div>
				<div class="control-group">
				    <label for="inputEmail" class="control-label">详细地址：</label>
				    <div class="controls">
				      <?php echo $ra_val['prefixAddress'].$ra_val['address'];?>
				    </div>
				</div>
				<div class="control-group">
				    <label for="inputEmail" class="control-label">邮编：</label>
				    <div class="controls">
				      <?php echo $ra_val['postalCode'];?>
				    </div>
				</div>
			</div>
		</div>
    	<?php }}else{?>
		<span style="color: #FF0000;">该会员没有收货地址</span>
    	<?php }?>
	</form>
  </div>
  <form id="ems-form" style="width: 100%;" class="sui-form form-horizontal sui-validate" novalidate="novalidate">
	  <div class="sui-row-fluid">
		<div class="span2">
		  <div class="control-group">
		    <label class="control-label"></label>
		    <div class="controls">
		      <a href="javascript:void(0);" class="sui-btn btn-xlarge" data-url="<?php echo $ref;?>">关闭</a>
		    </div>
		  </div>
		</div>
	  </div>
  </form>
</div>
<?php echo assets::$sayimo; ?>