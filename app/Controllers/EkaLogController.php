<?php
namespace App\Controllers;

use Core\EkaController;
use Core\EkaRequest;
use Core\EkaResponse;
use App\Models\EkaLog;

class EkaLogController extends EkaController {
    public function index(EkaRequest $request, EkaResponse $response): void {
        $model = new EkaLog();
        $logs = $model->getAll();
        $this->render('admin/logs/index', ['logs' => $logs]);
    }
}
