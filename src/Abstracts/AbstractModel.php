<?php
namespace CarloNicora\Minimalism\Modules\Cli\Abstracts;

use CarloNicora\Minimalism\Core\Modules\Interfaces\ResponseInterface;

abstract class AbstractModel extends \CarloNicora\Minimalism\Core\Modules\Abstracts\Models\AbstractModel {
    /**
     * @return ResponseInterface
     */
    abstract public function run(): ResponseInterface;
}