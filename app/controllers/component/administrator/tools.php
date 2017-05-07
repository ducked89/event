<?php
if($this->isConnected())
{
    $this->datas['menuSection'] = "mTools";
    $this->chargerViewLayout($this->layout, 'users/tools', $this->datas);
}

?>
