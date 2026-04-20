<?php
namespace Core;

class EkaController {
    public function render(string $view, array $params = []): void {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        
        ob_start();
        include_once __DIR__ . "/../app/Views/$view.php";
        $content = ob_get_clean();
        
        include_once __DIR__ . "/../app/Views/layouts/master.php";
    }
}
