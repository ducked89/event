<?php
if($this->isConnected())
{
    $this->datas['menuSection'] = "mSettings";
    $this->chargerViewLayout($this->layout, $this->direct.'adminpassword', $this->datas);
}

?>
