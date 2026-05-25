# Laboratorio #5 - Seguridad en PHP con OpenSSL

## Descripción
Implementación y documentación de funciones criptográficas utilizando la extensión OpenSSL en PHP. Este laboratorio forma parte del curso Desarrollo de Software VII de la Universidad Tecnológica de Panamá.

## Tema
Uso de funciones criptográficas en PHP: firma digital, verificación y encriptación básica.

## Objetivo
Aplicar el uso de la extensión OpenSSL en PHP para ejecutar funciones criptográficas, comprendiendo su propósito y funcionamiento mediante la ejecución de los scripts proporcionados.

## Requisitos
- WampServer o XAMPP
- PHP 8.x con extensión OpenSSL activa
- Navegador web

## Archivos del proyecto
| Archivo | Descripción |
|---|---|
| `firma7.php` | Generación de par de llaves RSA y firma digital |
| `firmaOtra.php` | Creación de certificado X.509 autofirmado |
| `FirmarMesaje.php` | Firma y verificación de un mensaje |
| `Encriptacion.php` | Cifrado y descifrado con AES-128-CBC |
| `encriptacion1.php` | Formulario web interactivo de cifrado simétrico |

## Configuración
Si tienes problemas con la ruta de `openssl.cnf`, agrega esta línea en el array `$configArgs` de cada script:

```php
'config' => 'C:\\wamp64\\bin\\php\\php8.x.x\\extras\\ssl\\openssl.cnf'
```

## Docente
Ing. Irina Fong - Facultad de Ingeniería en Sistemas Computacionales, UTP
