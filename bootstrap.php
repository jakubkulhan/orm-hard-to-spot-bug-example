<?php
namespace Example;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once __DIR__ . "/vendor/autoload.php";

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration([__DIR__ . "/src/Example"], $isDevMode, null, null, false);

return EntityManager::create([
	"driver" => "pdo_sqlite",
	"path" => __DIR__ . "/db.sqlite",
], $config);
