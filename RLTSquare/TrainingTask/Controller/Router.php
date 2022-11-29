<?php
declare(strict_types=1);
/**
 * @author RLTSquare
 * @copyright Copyright (c) 2022 RLTSquare (https://www.rltsquare.com/)
 * @package RLTSquare_TrainingTask
 */

namespace RLTSquare\TrainingTask\Controller;

use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterInterface;

/**
 * Class Router
 */
class Router implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    private ActionFactory $actionFactory;

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * Router constructor.
     *
     * @param ActionFactory $actionFactory
     * @param ResponseInterface $response
     */
    public function __construct(
        ActionFactory     $actionFactory,
        ResponseInterface $response
    ) {
        $this->actionFactory = $actionFactory;
        $this->response = $response;
    }

    /**
     * @param RequestInterface $request
     * @return ActionInterface|null
     */
    public function match(RequestInterface $request): ?ActionInterface
    {
        $identifier = trim($request->getPathInfo(), '/');

        if (str_contains($identifier, 'rltsquare')) {
            $request->setModuleName('training');
            $request->setControllerName('index');
            $request->setActionName('index');

            return $this->actionFactory->create(Forward::class, ['request' => $request]);
        }
        return null;
    }
}
