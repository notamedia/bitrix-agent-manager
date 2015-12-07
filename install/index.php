<?php
/**
 * @link https://github.com/notamedia/bitrix-agent-manager
 * @copyright Copyright © 2015 Notamedia Ltd.
 * @license MIT
 */

class notamedia_agentmanager extends CModule
{
    public $MODULE_ID = 'notamedia.agentmanager';
    
    public function __construct()
    {
        IncludeModuleLangFile(__FILE__);
        
        $arModuleVersion = [];

        include(__DIR__ . '/version.php');

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = GetMessage('NOTAMEDIA_AGENT_MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage('NOTAMEDIA_AGENT_MODULE_DESCRIPTION');
        $this->PARTNER_NAME = GetMessage('NOTAMEDIA_AGENT_PARTNER_NAME');
        $this->PARTNER_URI = GetMessage('NOTAMEDIA_AGENT_PARTNER_URI');
    }

    public function DoInstall()
    {
        global $APPLICATION;
        
        $APPLICATION->IncludeAdminFile(GetMessage('NOTAMEDIA_AGENT_INSTALL_TITLE'), __DIR__ . '/install.php');
    }
    
    public function DoUninstall()
    {
        UnRegisterModule('notamedia.agentmanager');
    }
}