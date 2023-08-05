<?php

namespace Admin\Extend\AdminAudit;

use Admin\ExtendProvider;
use Admin\Core\ConfigExtensionProvider;
use Admin\Extend\AdminAudit\Extension\Config;
use Admin\Extend\AdminAudit\Extension\Install;
use Admin\Extend\AdminAudit\Extension\Navigator;
use Admin\Extend\AdminAudit\Extension\Uninstall;
use Admin\Extend\AdminAudit\Extension\Permissions;

/**
 * Class ServiceProvider
 * @package Admin\Extend\AdminAudit
 */
class ServiceProvider extends ExtendProvider
{
    /**
     * Extension ID name
     * @var string
     */
    public static $name = "bfg/admin-audit";

    /**
     * Extension call slug
     * @var string
     */
    static $slug = "bfg_admin_audit";

    /**
     * Extension description
     * @var string
     */
    public static $description = "The auditing viewer for bfg admin";

    /**
     * @var string
     */
    protected $navigator = Navigator::class;

    /**
     * @var string
     */
    protected $install = Install::class;

    /**
     * @var string
     */
    protected $uninstall = Uninstall::class;

    /**
     * @var string
     */
    protected $permissions = Permissions::class;

    /**
     * @var ConfigExtensionProvider|string
     */
    protected $config = Config::class;
}

