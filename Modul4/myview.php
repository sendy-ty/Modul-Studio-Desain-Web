<?php
declare(strict_types=1);

class MyView {

  protected $template_dir = 'templates/';
  protected $vars = [];

  public function render(string $template_file) {

    $file = $this->template_dir . $template_file;

    if (file_exists($file)) {

      include $this->template_dir . 'layout/header.php';
      include $file;
      include $this->template_dir . 'layout/footer.php';

    } else {
      throw new Exception('Template tidak ditemukan');
    }
  }

  public function __set($name, $value) {
    $this->vars[$name] = $value;
  }

  public function __get($name) {
    return $this->vars[$name] ?? null;
  }
}
