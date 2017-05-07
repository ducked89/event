<?php
if($this->isConnected())
{
    $this->datas['menuSection'] = "mRapport";
    $this->chargerViewLayout($this->layout, $this->direct.'rapport', $this->datas);
}

?>
