<?php
namespace T3docs\Examples\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Localization\LanguageService;

class AdminModuleController
{

    public function __construct(
        protected readonly ModuleTemplateFactory $moduleTemplateFactory,
        protected readonly IconFactory $iconFactory,
        // ...
    ) {}

    public function handleRequest(ServerRequestInterface $request): ResponseInterface
    {
        $GLOBALS['LANG']->includeLLFile('EXT:examples/Resources/Private/Language/AdminModule/locallang.xlf');

        $allowedOptions = [
            'function' => [
                'debug' => $GLOBALS['LANG']->getLL('debug'),
                'password' => $GLOBALS['LANG']->getLL('password'),
                'index' => $GLOBALS['LANG']->getLL('index'),
            ],
        ];

        $moduleData = $request->getAttribute('moduleData');
        if ($moduleData->cleanUp($allowedOptions)) {
            $GLOBALS['BE_USER']->pushModuleData($moduleData->getModuleIdentifier(), $moduleData->toArray());
        }

        $moduleTemplate = $this->moduleTemplateFactory->create($request, 't3docs/examples');
        $this->setUpDocHeader($request, $moduleTemplate);

        $title = $GLOBALS['LANG']->sL('LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang_mod.xlf:mlang_tabs_tab');
        switch ($moduleData->get('function')) {
            case 'debug':
                $moduleTemplate->setTitle($title, $GLOBALS['LANG']->getLL('module.menu.debug'));
                return $this->debugAction($request, $moduleTemplate);
            case 'password':
                $moduleTemplate->setTitle($title, $GLOBALS['LANG']->getLL('module.menu.password'));
                return $this->passwordAction($request, $moduleTemplate);
            default:
                $moduleTemplate->setTitle($title, $GLOBALS['LANG']->getLL('module.menu.log'));
                return $this->indexAction($request, $moduleTemplate);
        }
    }

    private function setUpDocHeader(
        ServerRequestInterface $request,
        ModuleTemplate $view
    ) {
        $buttonBar = $view->getDocHeaderComponent()->getButtonBar();
        $list = $buttonBar->makeLinkButton()
            ->setHref('<uri-builder-path>')
            ->setTitle('A Title')
            ->setShowLabelText('Link')
            ->setIcon($this->iconFactory->getIcon('actions-extension-import', Icon::SIZE_SMALL));
        $buttonBar->addButton($list, ButtonBar::BUTTON_POSITION_LEFT, 1);
    }

    public function indexAction(
        ServerRequestInterface $request,
        ModuleTemplate $view
    ) : ResponseInterface
    {
        $view->assign('aVariable', 'aValue');
        return $view->renderResponse('AdminModule/Index');
    }


    protected function debugAction(
        ServerRequestInterface $request,
        ModuleTemplate $view
    ): ResponseInterface
    {
        $cmd = $request->getParsedBody()['tx_examples_admin_examples']['cmd'] ?? 'cookies';
        switch ($cmd) {
            case 'cookies':
                $this->debugCookies();
                break;
            default:
                // do something else
        }

        $view->assignMultiple(
            [
                'cookies' => $request->getCookieParams(),
                'lastcommand' => $cmd,
            ]
        );
        return $view->renderResponse('AdminModule/Debug');
    }


    protected function passwordAction(
        ServerRequestInterface $request,
        ModuleTemplate $view
    ): ResponseInterface
    {
        // TODO: Do something
        return $view->renderResponse('AdminModule/Password');
    }

    private function debugCookies()
    {
        // TODO: do something()
    }
}
