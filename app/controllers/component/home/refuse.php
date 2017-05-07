<?php
if($this->user->userInfo('login')==null)
{
    header("Location:".SITE."home/");
}
else if($this->user->userInfo('roleid')==2)
{
    header("Location:".SITE."members/prohibited");
}else{
    header("Location:".SITE."administrator/prohibited");
}
?>
