<?php
/**
 * @author RLTSquare
 * @copyright Copyright (c) 2022 RLTSquare (https://www.rltsquare.com/)
 * @package RLTSquare_TrainingTask
 */
namespace RLTSquare\TrainingTask\Logger;

use Magento\Framework\Logger\Handler\Base as BaseHandler;
use Monolog\Logger;

/**
 * Class Handler
 */
class Handler extends BaseHandler
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = Logger::INFO;

    /**
     * File name
     * @var string
     */
    protected $fileName = 'var/log/rltsquare.log';
}
