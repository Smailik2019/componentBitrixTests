<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    if (isset($arResult["ROWS"]) && $arResult["ROWS"] ) 
    {
        $APPLICATION->IncludeComponent(
            "bitrix:main.ui.grid",
            "",
            [
            "GRID_ID" => "address_list", 
            "COLUMNS" => [
                ["id" => "UF_ADRESS", "name" => GetMessage("USRADRESSES_ADDRESS_ROW_TITLE"), "sort" => "UF_ADRESS", "default" => true], 
            ],
            "SORT" => $arResult["SORT"],
            "SORT_VARS"=>$arResult["SORT_VARS"],
            "ROWS" => $arResult["ROWS"],
            "SHOW_ROW_CHECKBOXES" => false, 
            "NAV_OBJECT"=>$arResult["NAV_OBJECT"],
            "AJAX_MODE" => "Y", 
            "AJAX_ID" => \CAjax::getComponentID("bitrix:main.ui.grid", ".default", ""), 
            "PAGE_SIZES" => [ 
                ["NAME" => "2", "VALUE" => "2"], 
                ["NAME" => "5", "VALUE" => "5"], 
                ["NAME" => "10", "VALUE" => "10"], 
                ["NAME" => "20", "VALUE" => "20"], 
                ["NAME" => "50", "VALUE" => "50"], 
                ["NAME" => "100", "VALUE" => "100"] 
            ], 
            "AJAX_OPTION_JUMP"          => "N", 
            "SHOW_CHECK_ALL_CHECKBOXES" => false, 
            "SHOW_ROW_ACTIONS_MENU"     => true, 
            "SHOW_GRID_SETTINGS_MENU"   => true, 
            "SHOW_NAVIGATION_PANEL"     => true, 
            "SHOW_PAGINATION"           => true, 
            "SHOW_SELECTED_COUNTER"     => true, 
            "SHOW_TOTAL_COUNTER"        => true, 
            "SHOW_PAGESIZE"             => true, 
            "SHOW_ACTION_PANEL"         => true, 
            "ALLOW_COLUMNS_SORT"        => true, 
            "ALLOW_COLUMNS_RESIZE"      => true, 
            "ALLOW_HORIZONTAL_SCROLL"   => true, 
            "ALLOW_SORT"                => true, 
            "ALLOW_PIN_HEADER"          => true, 
            "AJAX_OPTION_HISTORY"       => "N" 
            ]
        );
    }
    else 
    {
        echo GetMessage("USRADRESSES_NO_ADDRESS_ROWS");
    }
?>