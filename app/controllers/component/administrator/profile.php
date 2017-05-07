<?php
if($this->isConnected())
{
    $this->datas['menuSection'] = "mProfile";
    $this->chargerViewLayout($this->layout, $this->direct.'profile', $this->datas);
}
?>
