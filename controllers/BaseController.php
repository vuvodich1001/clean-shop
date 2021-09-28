<?php

class BaseController {
    const BASE_FOLDER_VIEW = './views';
    const BASE_FOLDER_MODEL = './models';
    protected function view($path, array $data = []) {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        $path = self::BASE_FOLDER_VIEW . '/' . str_replace('.', '/', $path) . '.php';
        return include($path);
    }

    protected function loadModel($path) {
        $path = self::BASE_FOLDER_MODEL . '/' . str_replace('.', '/', $path) . '.php';
        return include($path);
    }
}