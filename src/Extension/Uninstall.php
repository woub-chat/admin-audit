<?php

namespace Admin\Extend\AdminAudit\Extension;

use Admin\Core\UnInstallExtensionProvider;
use Admin\Interfaces\ActionWorkExtensionInterface;

/**
 * Class Navigator
 * @package Admin\Extend\AdminAudit\Extension
 */
class Uninstall extends UnInstallExtensionProvider implements ActionWorkExtensionInterface {

    /**
     * @return void
     */
    public function handle(): void
    {

    }
}
