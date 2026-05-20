<?php

declare(strict_types=1);

namespace T3docs\Examples\Module\AccessGate;

use TYPO3\CMS\Backend\Module\ModuleAccessGateInterface;
use TYPO3\CMS\Backend\Module\ModuleAccessResult;
use TYPO3\CMS\Backend\Module\ModuleInterface;
use TYPO3\CMS\Core\Attribute\AsModuleAccessGate;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;

#[AsModuleAccessGate(identifier: 'exampleUser')]
class ExampleGate implements ModuleAccessGateInterface
{
    public function decide(
        ModuleInterface $module,
        BackendUserAuthentication $user,
    ): ModuleAccessResult {
        if ($module->getAccess() !== 'exampleUser') {
            return ModuleAccessResult::Abstain;
        }
        $userTsConfig = $user->getTSConfig();
        $exampleUserGroupId = (int)($userTsConfig['options.']['example.']['userGroup'] ?? 0);
        $permission = $user->isAdmin() || in_array($exampleUserGroupId, $user->userGroupsUID);
        return $permission
            ? ModuleAccessResult::Granted
            : ModuleAccessResult::Denied;
    }
}
