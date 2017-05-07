<?php
if(isset($this->datas['user']))
{
    if($this->user->userInfo('roleid')==2)
        header("Location:".SITE."organizers/");
    else
        header("Location:".SITE."administrator/");
}

$this->chargerViewLayout($this->layout, 'default/index', $this->datas);
?>
