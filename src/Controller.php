<?php
namespace CarloNicora\Minimalism\Modules\Cli;

use CarloNicora\Minimalism\Core\Modules\Abstracts\Controllers\AbstractCliController;
use CarloNicora\Minimalism\Core\Modules\Interfaces\ModelInterface;
use CarloNicora\Minimalism\Core\Modules\Interfaces\ResponseInterface;
use CarloNicora\Minimalism\Core\Response;
use CarloNicora\Minimalism\Modules\Cli\Abstracts\AbstractModel;
use Exception;

class Controller extends AbstractCliController {
    /** @var ModelInterface|AbstractModel  */
    protected ModelInterface $model;

    /**
     * @return ResponseInterface
     */
    public function render(): ResponseInterface {
        try {
            $this->model->preRender();

            $response = $this->model->run();
        } catch (Exception $e) {
            $response = new Response();
            $response->setData($e->getMessage());
        }

        $this->completeRender($response->getStatus(), $response->getData());

        $response->setNotHttpResponse();

        return $response;
    }
}