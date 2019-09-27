<?php
/**
 * Copyright © Magefan (support@magefan.com). All rights reserved.
 * Please visit Magefan.com for license details (https://magefan.com/end-user-license-agreement).
 *
 * Glory to Ukraine! Glory to the heroes!
 */

namespace Magefan\BlogAmp\Block\Amp\Ldjson;

/**
 * Blog post list ldJson block
 */
if (class_exists('\Plumrocket\Amp\Block\Page\Head\Ldjson\Cms')) {
    class PostListIntermediate extends \Plumrocket\Amp\Block\Page\Head\Ldjson\Cms
    {
    }
} else {
    class PostListIntermediate extends \Magento\Framework\View\Element\AbstractBlock
    {
    }
}

class PostList extends PostListIntermediate
{
    /**
     * Retrieve page structure structure data in JSON
     *
     * @return string
     */
    public function getJson()
    {
        $time = time();
        if (!$this->_cmsPage->getCreationTime()) {
            $this->_cmsPage->setCreationTime(
                date('Y-m-01 00:00:00', $time - 86400 * 150)
            );
        }

        if (!$this->_cmsPage->getUpdateTime()) {
            $this->_cmsPage->setUpdateTime(
                date('Y-m-01 00:00:00', $time)
            );
        }

        if (!$this->_cmsPage->getTitle()) {
            $this->_cmsPage->setTitle(
                $this->pageConfig->getTitle()->get()
            );
        }

        return parent::getJson();
    }
}
