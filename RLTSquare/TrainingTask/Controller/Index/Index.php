<?php
declare(strict_types=1);
/**
 * @author RLTSquare
 * @copyright Copyright (c) 2022 RLTSquare (https://www.rltsquare.com/)
 * @package RLTSquare_TrainingTask
 */

namespace RLTSquare\TrainingTask\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Index
 */
class Index implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    private PageFactory $pageFactory;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var TransportBuilder
     */
    protected TransportBuilder $transportBuilder;

    /**
     * @var StoreManagerInterface
     */
    protected StoreManagerInterface $storeManager;

    /**
     * @var StateInterface
     */
    protected StateInterface $inlineTranslation;

    /**
     * @param PageFactory $pageFactory
     * @param LoggerInterface $logger
     * @param TransportBuilder $transportBuilder
     * @param StoreManagerInterface $storeManager
     * @param StateInterface $state
     */
    public function __construct(
        PageFactory           $pageFactory,
        LoggerInterface       $logger,
        TransportBuilder      $transportBuilder,
        StoreManagerInterface $storeManager,
        StateInterface        $state
    ) {
        $this->pageFactory = $pageFactory;
        $this->logger = $logger;
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $state;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        /** log in custom log file */
        $this->logger->info('Page Visited');

        /** send test email */
        $this->sendEmail();

        return $this->pageFactory->create();
    }

    /**
     * Send Test Email
     * @return void
     */
    public function sendEmail(): void
    {
        $templateId = 'unit1';
        $fromEmail = 'admin@rltsquare.com';
        $fromName = 'Admin';
        $toEmail = 'zarbab.mushtaq@rltsquare.com';

        try {
            // template variables pass here
            $templateVars = [
                'msg' => 'test'
            ];

            $storeId = $this->storeManager->getStore()->getId();

            $from = ['email' => $fromEmail, 'name' => $fromName];
            $this->inlineTranslation->suspend();

            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $templateOptions = [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $storeId
            ];
            $transport = $this->transportBuilder->setTemplateIdentifier($templateId, $storeScope)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars($templateVars)
                ->setFrom($from)
                ->addTo($toEmail)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
