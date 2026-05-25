<?php
echo phpversion();
echo "<br>";
echo extension_loaded('openssl') ? 'OpenSSL: ACTIVO' : 'OpenSSL: NO ACTIVO';
echo "<br>";
echo openssl_get_cert_locations()['default_cert_file'];