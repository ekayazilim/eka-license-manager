<?php
namespace App\Controllers;

use Core\EkaController;
use Core\EkaRequest;
use Core\EkaResponse;
use Core\EkaAuth;
use App\Models\EkaUser;
use Core\EkaLogger;

class EkaAuthController extends EkaController {
    public function loginView(EkaRequest $request, EkaResponse $response): void {
        $this->render('auth/login');
    }

    public function loginAction(EkaRequest $request, EkaResponse $response): void {
        $body = $request->getBody();
        $email = $body['email'] ?? '';
        $password = $body['password'] ?? '';

        $userModel = new EkaUser();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            EkaAuth::login($user['id']);
            EkaLogger::log('INFO', "Kullanıcı giriş yaptı: {$user['email']}");
            $response->redirect('/dashboard');
        } else {
            EkaLogger::log('WARNING', "Başarısız giriş denemesi: {$email}");
            $this->render('auth/login', ['error' => 'Geçersiz e-posta veya şifre']);
        }
    }

    public function logout(EkaRequest $request, EkaResponse $response): void {
        EkaAuth::logout();
        $response->redirect('/login');
    }
}
