<?php
class TestController extends BaseController {
    public function t(){
        $this->smarty->display('_index.html');
    }
}
?>