<?php
namespace App\Controllers;

use Core\EkaController;
use Core\EkaRequest;
use Core\EkaResponse;
use App\Models\EkaLicense;

class EkaDashboardController extends EkaController {
    public function index(EkaRequest $request, EkaResponse $response): void {
        $licenseModel = new EkaLicense();
        
        $total = $licenseModel->countTotal();
        $active = $licenseModel->countStatus('active');
        $expired = $licenseModel->countStatus('expired');
        $suspended = $licenseModel->countStatus('suspended');

        $this->render('admin/dashboard', [
            'total' => $total,
            'active' => $active,
            'expired' => $expired,
            'suspended' => $suspended
        ]);
    }
}
