<?php
namespace App\Controllers;

use Core\EkaController;
use Core\EkaRequest;
use Core\EkaResponse;
use App\Models\EkaLicense;
use App\Models\EkaLog;
use Core\EkaLogger;

class EkaApiController extends EkaController {
    public function validateLicense(EkaRequest $request, EkaResponse $response): void {
        $body = $request->getBody();
        
        $key = $body['license_key'] ?? '';
        $domain = $body['domain'] ?? '';
        $ip = $body['ip'] ?? $request->getIp();

        $logModel = new EkaLog();
        $logData = [
            'license_key' => $key,
            'domain' => $domain,
            'ip_address' => $ip,
            'request_data' => json_encode($body)
        ];

        if (empty($key) || empty($domain)) {
            $logData['status'] = 'failed';
            $logData['reason'] = 'Eksik parametre (license_key veya domain)';
            $logModel->create($logData);
            EkaLogger::log('WARNING', "API: Eksik parametre isteği", $body);
            $response->json(['status' => 'invalid', 'reason' => 'missing_parameters'], 400);
        }

        $model = new EkaLicense();
        $license = $model->findByKey($key);

        if (!$license) {
            $logData['status'] = 'failed';
            $logData['reason'] = 'Geçersiz lisans anahtarı';
            $logModel->create($logData);
            EkaLogger::log('WARNING', "API: Geçersiz lisans kontrolü: $key");
            $response->json(['status' => 'invalid', 'reason' => 'invalid_key'], 404);
        }

        if ($license['status'] !== 'active') {
            $logData['status'] = 'failed';
            $logData['reason'] = 'Lisans durumu aktif değil: ' . $license['status'];
            $logModel->create($logData);
            $response->json(['status' => 'invalid', 'reason' => $license['status']], 403);
        }

        if ($license['expires_at'] && strtotime($license['expires_at']) < time()) {
            $model->update($license['id'], ['domain' => $license['domain'], 'status' => 'expired']);
            $logData['status'] = 'failed';
            $logData['reason'] = 'Lisans süresi dolmuş';
            $logModel->create($logData);
            $response->json(['status' => 'invalid', 'reason' => 'expired'], 403);
        }

        $allowedDomains = array_map('trim', explode(',', $license['domain']));
        $domainMatched = false;
        foreach ($allowedDomains as $allowedDomain) {
            if ($allowedDomain === '*' || $allowedDomain === $domain) {
                $domainMatched = true;
                break;
            }
        }

        if (!$domainMatched) {
            $logData['status'] = 'failed';
            $logData['reason'] = 'Geçersiz domain: ' . $domain;
            $logModel->create($logData);
            EkaLogger::log('WARNING', "API: Domain uyumsuzluğu - Beklenen: {$license['domain']}, Gelen: $domain");
            $response->json(['status' => 'invalid', 'reason' => 'domain_mismatch'], 403);
        }

        if ($license['ip_address'] && $license['ip_address'] !== $ip) {
            $logData['status'] = 'failed';
            $logData['reason'] = 'Geçersiz IP adresi: ' . $ip;
            $logModel->create($logData);
            EkaLogger::log('WARNING', "API: IP uyumsuzluğu - Beklenen: {$license['ip_address']}, Gelen: $ip");
            $response->json(['status' => 'invalid', 'reason' => 'ip_mismatch'], 403);
        }

        $logData['status'] = 'success';
        $logModel->create($logData);

        $response->json([
            'status' => 'valid',
            'expires_at' => $license['expires_at']
        ]);
    }
}
