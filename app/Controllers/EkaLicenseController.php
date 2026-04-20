<?php
namespace App\Controllers;

use Core\EkaController;
use Core\EkaRequest;
use Core\EkaResponse;
use App\Models\EkaLicense;
use Core\EkaLicense as LicenseHelper;
use Core\EkaLogger;

class EkaLicenseController extends EkaController {
    public function index(EkaRequest $request, EkaResponse $response): void {
        $model = new EkaLicense();
        $licenses = $model->getAll();
        $this->render('admin/licenses/index', ['licenses' => $licenses]);
    }

    public function createView(EkaRequest $request, EkaResponse $response): void {
        $this->render('admin/licenses/create');
    }

    public function store(EkaRequest $request, EkaResponse $response): void {
        $body = $request->getBody();
        $data = [
            'license_key' => LicenseHelper::generateKey(),
            'domain' => $body['domain'] ?? '',
            'ip_address' => empty($body['ip_address']) ? null : $body['ip_address'],
            'expires_at' => empty($body['expires_at']) ? null : $body['expires_at'],
            'status' => $body['status'] ?? 'active'
        ];

        if (empty($data['domain'])) {
            $this->render('admin/licenses/create', ['error' => 'Domain adresi zorunludur']);
            return;
        }

        $model = new EkaLicense();
        if ($model->create($data)) {
            EkaLogger::log('INFO', "Yeni lisans oluşturuldu: {$data['license_key']} Domain: {$data['domain']}");
            $response->redirect('/licenses');
        } else {
            $this->render('admin/licenses/create', ['error' => 'Kayıt sırasında bir hata oluştu']);
        }
    }
}
