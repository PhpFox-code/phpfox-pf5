<?php

namespace PHPSTORM_META {

    override(\Phpfox::findById(0), map([
    'abuse_report_category'=>\Neutron\AbuseReport\Model\AbuseReportCategory::class,
'auth_password'=>\Neutron\User\Model\AuthPassword::class,
'auth_remote'=>\Neutron\User\Model\AuthRemote::class,
'auth_token'=>\Neutron\User\Model\AuthToken::class,
'contact_department'=>\Neutron\ContactUs\Model\ContactDepartment::class,
'core_package'=>\Neutron\Core\Model\CorePackage::class,
'core_role'=>\Neutron\Core\Model\CoreRole::class,
'core_theme'=>\Neutron\Core\Model\CoreTheme::class,
'i18n_language'=>\Neutron\Core\Model\I18nLanguage::class,
'i18n_phrase'=>\Neutron\Core\Model\I18nPhrase::class,
'pages'=>\Neutron\Pages\Model\Pages::class,
'user'=>\Neutron\User\Model\User::class,
'user_auth_history'=>\Neutron\User\Model\AuthHistory::class]));
}