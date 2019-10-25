<?php
/**
 * Copyright © Magefan (support@magefan.com). All rights reserved.
 * Please visit Magefan.com for license details (https://magefan.com/end-user-license-agreement).
 *
 * Glory to Ukraine! Glory to the heroes!
 */

namespace Magefan\BlogAmp\Plugin\Plumrocket\Amp;

/**
 * Plugin for helper data (amp extension by Plumrocket)
 */
class HelperDataPlugin
{
    /**
     * Add magefan blog actions to allowed list
     * @param  \Plumrocket\Amp\Helper\Data $helper
     * @param  array $allowedPages
     * @return array
     */
    public function afterGetAllowedPages(\Plumrocket\Amp\Helper\Data $helper, $allowedPages)
    {
        foreach ($allowedPages as &$value) {
            if (strpos($value, 'magefan_blog_') === 0) {
                $value = str_replace('magefan_blog_', 'blog_', $value);
            }
        }

        return $allowedPages;
    }
}
