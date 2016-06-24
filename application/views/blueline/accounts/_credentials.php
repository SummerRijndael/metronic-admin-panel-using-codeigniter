
<ul class="details">
	<li><span>Username: </span> <?=$user_info->username;?></li>
	<li><span>Email: </span> <?=$user_info->email;?></li>
 	<li><span>Password: </span> <?=$new_password;?></li>
</ul>

    <div class="modal-footer">
    <?=form_open_multipart($form_action,' role="form"');?>
    <input type="hidden" name="username" value="<?=$user_info->username;?>">
    <input type="hidden" name="view_id" value="<?=$user_info->view_id;?>">
	<input type="hidden" name="email" value="<?=$user_info->email;?>">
 	<input type="hidden" name="password" value="<?=$new_password;?>">

    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope"></i> Email login credentials</button>
	<a class="btn" data-dismiss="modal">Close</a>
    <?=form_close();?>
    </div>