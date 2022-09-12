<?
use Bitrix\Main\Loader; 

Loader::includeModule("highloadblock"); 

use Bitrix\Highloadblock as HL; 

$rsData = HL\HighloadBlockTable::getList(array(
    "select" => array("ID", "NAME", "TABLE_NAME"),
    "order" => array("NAME" => "DESC")
));

while ($hldata = $rsData->fetch()) {
    $arHlList[$hldata['ID']] = "[" . $hldata['ID'] ."] ". $hldata['NAME'];
}


$arComponentParameters = array(
   "GROUPS" => array(
      "SETTINGS" => array(
         "NAME" => GetMessage("USRADRESSES_SETTINGS")
      ),
   ),
   "PARAMETERS" => array(
      "HL_TYPE_ID" => array(
         "PARENT" => "SETTINGS",
         "NAME" =>GetMessage("USRADRESSES_HL_TYPE_ID"),
         "TYPE" => "LIST",
         "ADDITIONAL_VALUES" => "N",
         "VALUES" => $arHlList,
      ),
      "ACTIVE_ONLY" => array(
         "PARENT" => "SETTINGS",
         "NAME" =>GetMessage("USRADRESSES_ACTIVE_ONLY"),
         "TYPE" => "CHECKBOX",
      ),
      "CACHE_TIME" => array(),
    )
);
