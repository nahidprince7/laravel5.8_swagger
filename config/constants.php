<?php
/*pagination*/
define("LIMIT_PER_PAGE_DEFAULT", 40);
define("LIMIT_PER_PAGE", [40,50,60,70,80,90,100]);
//Roles
define('SYSTEM_ADMIN', 1);
define('ADMIN', 2);
define('ROLE_MANAGEMENT', 3);
define('ROLE_CEO', 4);
define('ROLE_CMO', 5);
define('ROLE_HOD', 6);
define('ROLE_EMPLOYEE', 7);
define('DOMAIN_HOSTING', 8);

define('ROLE_GENERAL_SETTINGS', 21);


define('ROLES', [
//    SYSTEM_ADMIN=>'System Admin',
    ADMIN => 'Admin',
    ROLE_MANAGEMENT => 'Management',
    ROLE_CEO => 'CEO',
    ROLE_CMO=> 'CMO',
    ROLE_HOD => 'HOD',
    ROLE_EMPLOYEE => 'Employee',
    ROLE_GENERAL_SETTINGS=> 'General Settings',
    DOMAIN_HOSTING=> 'Domain Hosting',
]);


/*genders*/
define('MALE', 1);
define('FEMALE', 2);
define('GENDER', [
    MALE => 'Male',
    FEMALE => 'Female',
]);

/*religion*/
define('ISLAM', 1);
define('HINDU', 2);
define('BADDA', 3);
define('CHRISTIAN', 4);

define('RELIGIONS', [
    ISLAM => 'Islam',
    HINDU => 'Hindu',
    BADDA => 'Baddha',
    CHRISTIAN => 'Christian',
]);

$fileImageExtensions=['jpeg','JPEG','JPG','png','jpg'];
define('FILE_IMAGE_EXTENSION',['jpeg','JPEG','JPG','png','jpg']);

/*news and notice type*/
define('NEWS_NOTICE_TYPE_CONTENT', 1);
define('NEWS_NOTICE_TYPE_DOCUMENT', 2);

define('NEWS_NOTICE_TYPE', [
    NEWS_NOTICE_TYPE_CONTENT => 'Content',
    NEWS_NOTICE_TYPE_DOCUMENT => 'Document'
]);
/*published / Unpublished*/
define('NEWS_NOTICE_PUBLISHED', 1);
define('NEWS_NOTICE_UNPUBLISHED', 0);

define('NEWS_NOTICE_PUBLISH_STATUS', [
    NEWS_NOTICE_PUBLISHED => 'Published',
    NEWS_NOTICE_UNPUBLISHED => 'Unpublished'
]);
