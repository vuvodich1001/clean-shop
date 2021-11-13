<?php
class InventoryController extends BaseController {
    private $inventoryModel;
    public function __construct() {
        parent::__construct();
        $this->loadModel('InventoryModel');
        $this->inventoryModel = new InventoryModel();
    }
    public function index() {
    }
}
