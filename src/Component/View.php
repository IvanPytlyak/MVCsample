<?php

namespace User\Test\Component;

class View
{
    public static function build(string $tempalte, string $page, array $data = []): void // $template = 'main'
    {
        $tempaltes = TEMPLATES_PATH . DIRECTORY_SEPARATOR . $tempalte . '.php';
        $page = PAGES_PATH . DIRECTORY_SEPARATOR . $page . '.php';

        $data['pagePath'] = $page;

        extract($data);

        require($tempaltes);
    }
}
