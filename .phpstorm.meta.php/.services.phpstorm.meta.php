<?php

namespace PHPSTORM_META {

    override(\Phpfox::get(0), map([
    'assets'=>\Phpfox\Assets\AssetsFacades::class,
'auth'=>\Phpfox\Authentication\AuthFacades::class,
'auth.factory'=>\Neutron\User\Service\AuthFactory::class,
'auth.storage'=>\Phpfox\Authentication\AuthStorageSession::class,
'authorization'=>\Phpfox\Authorization\AuthorizationManager::class,
'blog.callback'=>\Neutron\Blog\Service\EventListener::class,
'breadcrumb'=>\Phpfox\Assets\Breadcrumb::class,
'cms.callback'=>\Neutron\Cms\Service\EventListener::class,
'controller.provider'=>\Phpfox\Package\ActionProvider::class,
'core.callback'=>\Neutron\Core\Service\EventListener::class,
'core.i18n_language'=>\Neutron\Core\Service\I18nLanguage::class,
'event.profile_filter'=>\Neutron\Event\Service\ProfileNameFilter::class,
'form.factory'=>\Phpfox\Form\FormFactory::class,
'form.render'=>\Phpfox\Form\FormFacades::class,
'group.callback'=>\Neutron\Group\Service\EventListener::class,
'group.profile_filter'=>\Neutron\Group\Service\ProfileNameFilter::class,
'html.description'=>\Phpfox\Assets\HeadDescription::class,
'html.keyword'=>\Phpfox\Assets\HeadKeyword::class,
'html.link'=>\Phpfox\Assets\HeadLink::class,
'html.meta'=>\Phpfox\Assets\HeadMeta::class,
'html.open_graph'=>\Phpfox\Assets\HeadOpenGraph::class,
'html.shutdown.inline_script'=>\Phpfox\Assets\InlineScript::class,
'html.shutdown.script'=>\Phpfox\Assets\ExternalScript::class,
'html.shutdown.static_html'=>\Phpfox\Assets\StaticHtml::class,
'html.start.inline_script'=>\Phpfox\Assets\InlineScript::class,
'html.start.inline_style'=>\Phpfox\Assets\InlineStyle::class,
'html.start.script'=>\Phpfox\Assets\ExternalScript::class,
'html.start.static_html'=>\Phpfox\Assets\StaticHtml::class,
'html.start.style'=>\Phpfox\Assets\ExternalStyle::class,
'html.title'=>\Phpfox\Assets\HeadTitle::class,
'i18n.loader'=>\Neutron\Core\Service\I18nMessageLoader::class,
'image'=>\Phpfox\Image\InterventionFactory::class,
'mailer'=>\Phpfox\Mailer\MailFacades::class,
'mailer.factory'=>\Neutron\Core\Service\MailTransportFactory::class,
'message.callback'=>\Neutron\Message\Service\EventListener::class,
'models'=>\Phpfox\Model\GatewayManager::class,
'models.provider'=>\Phpfox\Package\ModelProvider::class,
'mvc.dispatch'=>\Phpfox\Action\Dispatcher::class,
'mvc.events'=>\Phpfox\Event\EventManager::class,
'mvc.events.loader'=>\Neutron\Core\Service\EventLoader::class,
'mvc.response.ajax'=>\Phpfox\Action\AjaxResponse::class,
'mvc.response.html'=>\Phpfox\Action\HtmlResponse::class,
'navigation'=>\Phpfox\Navigation\NavigationManager::class,
'navigation.loader'=>\Neutron\Core\Service\NavigationLoader::class,
'package'=>\Phpfox\Package\PackageManager::class,
'package.loader'=>\Phpfox\Package\PackageLoader::class,
'pages.browse'=>\Neutron\Pages\Service\Browse::class,
'pages.callback'=>\Neutron\Pages\Service\EventListener::class,
'pages.profile_filter'=>\Neutron\Pages\Service\ProfileNameFilter::class,
'photo.callback'=>\Neutron\Photo\Service\EventListener::class,
'queues'=>\LocalQueueClass::class,
'queues.01'=>\AwsSQS::class,
'require_css'=>\Phpfox\Assets\RequireCss::class,
'require_js'=>\Phpfox\Assets\RequireJs::class,
'router'=>\Phpfox\Routing\Router::class,
'router.provider'=>\Phpfox\Package\RouterProvider::class,
'session'=>\Phpfox\Session\SessionManager::class,
'storage.factory'=>\Neutron\Core\Service\FileStorageFactory::class,
'storage.file_name'=>\Phpfox\Storage\FileNameSupport::class,
'storage.manager'=>\Phpfox\Storage\FileStorageManager::class,
'table_factory'=>\Phpfox\Db\DbTableGatewayFactory::class,
'theme_galaxy.callback'=>\Neutron\ThemeGalaxy\Service\EventListener::class,
'translator'=>\Phpfox\I18n\Translator::class,
'user.browse'=>\Neutron\User\Service\Browse::class,
'user.callback'=>\Neutron\User\Service\EventListener::class,
'user.profile_filter'=>\Neutron\User\Service\ProfileNameFilter::class,
'user.verify_email'=>\Neutron\User\Service\VerifyEmail::class,
'video.callback'=>\Neutron\Video\Service\EventListener::class,
'view.layout'=>\Phpfox\View\ViewLayout::class,
'view.template'=>\Phpfox\View\PhpTemplate::class,
'widgets'=>\Phpfox\Widget\WidgetManager::class]));
    
    override(\Phpfox::build(0), map([
    'assets'=>\Phpfox\Assets\AssetsFacades::class,
'auth'=>\Phpfox\Authentication\AuthFacades::class,
'auth.factory'=>\Neutron\User\Service\AuthFactory::class,
'auth.storage'=>\Phpfox\Authentication\AuthStorageSession::class,
'authorization'=>\Phpfox\Authorization\AuthorizationManager::class,
'blog.callback'=>\Neutron\Blog\Service\EventListener::class,
'breadcrumb'=>\Phpfox\Assets\Breadcrumb::class,
'cms.callback'=>\Neutron\Cms\Service\EventListener::class,
'controller.provider'=>\Phpfox\Package\ActionProvider::class,
'core.callback'=>\Neutron\Core\Service\EventListener::class,
'core.i18n_language'=>\Neutron\Core\Service\I18nLanguage::class,
'event.profile_filter'=>\Neutron\Event\Service\ProfileNameFilter::class,
'form.factory'=>\Phpfox\Form\FormFactory::class,
'form.render'=>\Phpfox\Form\FormFacades::class,
'group.callback'=>\Neutron\Group\Service\EventListener::class,
'group.profile_filter'=>\Neutron\Group\Service\ProfileNameFilter::class,
'html.description'=>\Phpfox\Assets\HeadDescription::class,
'html.keyword'=>\Phpfox\Assets\HeadKeyword::class,
'html.link'=>\Phpfox\Assets\HeadLink::class,
'html.meta'=>\Phpfox\Assets\HeadMeta::class,
'html.open_graph'=>\Phpfox\Assets\HeadOpenGraph::class,
'html.shutdown.inline_script'=>\Phpfox\Assets\InlineScript::class,
'html.shutdown.script'=>\Phpfox\Assets\ExternalScript::class,
'html.shutdown.static_html'=>\Phpfox\Assets\StaticHtml::class,
'html.start.inline_script'=>\Phpfox\Assets\InlineScript::class,
'html.start.inline_style'=>\Phpfox\Assets\InlineStyle::class,
'html.start.script'=>\Phpfox\Assets\ExternalScript::class,
'html.start.static_html'=>\Phpfox\Assets\StaticHtml::class,
'html.start.style'=>\Phpfox\Assets\ExternalStyle::class,
'html.title'=>\Phpfox\Assets\HeadTitle::class,
'i18n.loader'=>\Neutron\Core\Service\I18nMessageLoader::class,
'image'=>\Phpfox\Image\InterventionFactory::class,
'mailer'=>\Phpfox\Mailer\MailFacades::class,
'mailer.factory'=>\Neutron\Core\Service\MailTransportFactory::class,
'message.callback'=>\Neutron\Message\Service\EventListener::class,
'models'=>\Phpfox\Model\GatewayManager::class,
'models.provider'=>\Phpfox\Package\ModelProvider::class,
'mvc.dispatch'=>\Phpfox\Action\Dispatcher::class,
'mvc.events'=>\Phpfox\Event\EventManager::class,
'mvc.events.loader'=>\Neutron\Core\Service\EventLoader::class,
'mvc.response.ajax'=>\Phpfox\Action\AjaxResponse::class,
'mvc.response.html'=>\Phpfox\Action\HtmlResponse::class,
'navigation'=>\Phpfox\Navigation\NavigationManager::class,
'navigation.loader'=>\Neutron\Core\Service\NavigationLoader::class,
'package'=>\Phpfox\Package\PackageManager::class,
'package.loader'=>\Phpfox\Package\PackageLoader::class,
'pages.browse'=>\Neutron\Pages\Service\Browse::class,
'pages.callback'=>\Neutron\Pages\Service\EventListener::class,
'pages.profile_filter'=>\Neutron\Pages\Service\ProfileNameFilter::class,
'photo.callback'=>\Neutron\Photo\Service\EventListener::class,
'queues'=>\LocalQueueClass::class,
'queues.01'=>\AwsSQS::class,
'require_css'=>\Phpfox\Assets\RequireCss::class,
'require_js'=>\Phpfox\Assets\RequireJs::class,
'router'=>\Phpfox\Routing\Router::class,
'router.provider'=>\Phpfox\Package\RouterProvider::class,
'session'=>\Phpfox\Session\SessionManager::class,
'storage.factory'=>\Neutron\Core\Service\FileStorageFactory::class,
'storage.file_name'=>\Phpfox\Storage\FileNameSupport::class,
'storage.manager'=>\Phpfox\Storage\FileStorageManager::class,
'table_factory'=>\Phpfox\Db\DbTableGatewayFactory::class,
'theme_galaxy.callback'=>\Neutron\ThemeGalaxy\Service\EventListener::class,
'translator'=>\Phpfox\I18n\Translator::class,
'user.browse'=>\Neutron\User\Service\Browse::class,
'user.callback'=>\Neutron\User\Service\EventListener::class,
'user.profile_filter'=>\Neutron\User\Service\ProfileNameFilter::class,
'user.verify_email'=>\Neutron\User\Service\VerifyEmail::class,
'video.callback'=>\Neutron\Video\Service\EventListener::class,
'view.layout'=>\Phpfox\View\ViewLayout::class,
'view.template'=>\Phpfox\View\PhpTemplate::class,
'widgets'=>\Phpfox\Widget\WidgetManager::class]));
}