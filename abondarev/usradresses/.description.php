<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); 
$arComponentDescription = array(
    "NAME" => GetMessage("USRADRESSES_NAME"),
    "DESCRIPTION" => GetMessage("USRADRESSES_DESCR"),
    "ICON" => "/images/icon.png",
    "CACHE_PATH" => "Y",
    "PATH" => array(
        "ID" => "content",
        "CHILD" => array(
            "ID" => "Тест",
            "NAME" => "Тест",
        )
    ),
);
