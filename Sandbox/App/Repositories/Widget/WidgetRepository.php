<?php

namespace Sandbox\Repositories\Widget;

interface WidgetRepository {
    public function getAll();
    public function getById($id);
    public function add($job);
    public function edit($job);
    public function delete($job);
}