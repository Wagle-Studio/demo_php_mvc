<?php

namespace Src\Controllers;

class AbstractController
{
    protected function render(string $view, array $data = [])
    {
        $viewFile = __DIR__ . "/../../templates/" . $view . ".php";

        if (!file_exists($viewFile)) {
            http_response_code(500);
            echo "Vue introuvable : $viewFile";
            return;
        }

        extract($data);

        include $viewFile;
    }
}
