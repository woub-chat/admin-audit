<?php

namespace Admin\Extend\AdminAudit\Extension;

use Admin\Core\NavigatorExtensionProvider;
use Admin\Extend\AdminAudit\AuditController;
use Admin\Interfaces\ActionWorkExtensionInterface;

/**
 * Class Navigator
 * @package Admin\Extend\AdminAudit\Extension
 */
class Navigator extends NavigatorExtensionProvider implements ActionWorkExtensionInterface {

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->item('Audits')
            ->resource('audits', AuditController::class)
            ->icon_broadcast_tower()
            ->dontUseSearch();
    }
}
