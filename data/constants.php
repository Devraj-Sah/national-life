<?php
////////////////ADMIN DEFAULT CONSTANTS////////////////////////
define("ADMIN_PAGE_WIDTH", "100%");
define("ADMIN_LEFT_WIDTH", "20%");
define("ADMIN_BODY_WIDTH", "80%");
define("ADMIN_TITLE", "Admin Control Panel");

$setRow = $settings -> getSettings();

define("PAGE_TITLE", cleanQuery($setRow['siteName']));
define("SITE_EMAIL", cleanQuery($setRow['siteEmail']));
define("NO_REPLY_EMAIL", cleanQuery($setRow['noReplyEmail']));
define("SITE_ADDRESS", cleanQuery($setRow['siteDomain']));
define("BASELOCATION", cleanQuery($setRow['baseLocation']));

date_default_timezone_set("Asia/Kathmandu");

////////////////IMAGE FOLDER LOCATIONS////////////////////////
define("CMS_FILES_DIR", "files/download/");
define("CMS_PROJECT_DIR", "files/project/");
define("CMS_LISTING_FILES_DIR", "files/listingfiles/");
define("CMS_GROUPS_DIR", "files/groups/");
define("CMS_TESTIMONIALS_DIR", "files/testimonials/");
define("CMS_MEMBERS_DIR", "files/members/");

define("ADMIN_VIDEO_GALLERY_LIMIT", 6); // VIDEO GALLERY LIMIT FOR ADMIN
define("ADMIN_GALLERY_LIMIT", 10); // IMAGE GALLERY LIMIT FOR ADMIN
define("PAGING_LIMIT", 16); // IMAGE AND VIDEO GALLERY LIMIT FOR CLIENT
define("LISTING_LIMIT", 6); // LISTING TYPE LIMIT FOR CLIENT

define("FINANCIAL", 74);

////////////////LINKS AND PAGE TYPES////////////////////////
$groupTypesArray = array("Menu", "Other Links");

$linkTypesArray = array("Normal Group","Contents Page", "Link", "File", "Gallery", "List", "Video Gallery");

$allowedTypes = array("image/jpg", "image/jpeg", "image/pjpeg", "image/png", "image/gif", "application/pdf", "application/x-pdf", "application/msword", "application/vnd.ms-excel", "application/vnd.ms-powerpoint");
// ****** End Of File ***** //