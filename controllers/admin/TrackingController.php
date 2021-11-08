<?php

class TrackingController extends BaseController {
    private $inventoryModel;
    public function __construct() {
        $this->loadModel('InventoryModel');
        $this->inventoryModel = new InventoryModel();
    }
    public function index() {
    }
}
