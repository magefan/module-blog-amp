<?php
/**
 * Copyright © Magefan (support@magefan.com). All rights reserved.
 * Please visit Magefan.com for license details (https://magefan.com/end-user-license-agreement).
 *
 * Glory to Ukraine! Glory to the heroes!
 */

declare(strict_types=1);

namespace Magefan\BlogAmp\Plugin\Magefan\Blog\Model;

use  \Magento\Framework\App\Config\ScopeConfigInterface;

class TemplatePool
{
    const XML_PATH_AMP_ENABLED = 'pramp/general/enabled';

    /**
     * @var bool
     */
    private $isAmpRequest;

    private $scopeConfig;


     /**
     * TemplatePool constructor.
     * @param array $templates
     */
    public function __construct
    (
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Retrieve template
     * @param subject $templateType
     * @param string $templateType
     * @param string $name
     * @return array
     */
    public function beforeGetTemplate($subject, string $templateType, string $name):array
    {
        
        $templateType = ($this->isAmpRequest()) ? 'amp_' . $templateType : $templateType;

        return [$templateType, $name];
        
    }


    /**
     * Check if it is amp request
     */
    public function isAmpRequest()
    {
        if (null === $this->isAmpRequest) {
            if ($this->getConfig(self::XML_PATH_AMP_ENABLED)) {
                /* We know that using objectManager is not a not a good practice,
                   but if Plumrocket_AMP is not installed on your magento instance
                   you'll get error during di:compile */
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $this->isAmpRequest = $objectManager->get('\Plumrocket\Amp\Helper\Data')->isAmpRequest();
            }
        }


        return $this->isAmpRequest;
    }

    /**
     * Retrieve store config value
     * @param  string $path
     * @return mixed
     */
    public function getConfig($path)
    {
        return $this->scopeConfig->getValue($path,\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
