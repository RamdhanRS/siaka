<?php
// define("BASE_URL", "http://localhost/kuliah/sistem_informasi_akademik/");
define("BASE_URL", "http://localhost/pwl_smst6/sistem_informasi_akademik/");
// define("BASE_URL", "https://dfz18p6f-8010.asse.devtunnels.ms/");
function base_url($path = '')
{
  return BASE_URL . ltrim($path, '/');
}
