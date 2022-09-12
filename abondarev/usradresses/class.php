<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\UI\PageNavigation;

/**
 * компонент выводит в грид список адресов текущего пользователя
 */
class CDemoSqr extends CBitrixComponent
{
    public function executeComponent()
    {
        CModule::IncludeModule('highloadblock');

        $GridOptions = new GridOptions("address_list");
        
        $Sort = $GridOptions->GetSorting(array());
        $this->arResult["Sort"] = $Sort ;
        
        $nav_params = $GridOptions->GetNavParams(array("nPageSize"=>2));
        
        $nav = new PageNavigation('address_list');
        $nav->allowAllRecords(true)
            ->setPageSize($nav_params['nPageSize'])
            ->initFromUri();
        
        $filter = array(
            "UF_USERID" => 0
        );
        
        if ($this->arParams["ACTIVE_ONLY"] == "Y")
        {
            $filter["UF_ACTIVE"] = 1;
        }
        
        global $USER;
        if ($USER->IsAuthorized())
        {
            $filter["UF_USERID"] = (int)$USER->GetID();
        }

        $hlblock = HL\HighloadBlockTable::getById($this->arParams["HL_TYPE_ID"])->fetch();
        $entity = HL\HighloadBlockTable::compileEntity( $hlblock );
        $entity_data_class = $entity->getDataClass();
        $rsData = $entity_data_class::getList(array(
            "filter" => $filter,
            "order" => $Sort["sort"],
            "limit" => $nav->getLimit(),
            "offset" => $nav->getOffset(),
            'count_total' => true,
            'cache' => array(
                'ttl' => $this->arParams["CACHE_TIME"],
            )
        ));
        $nav->setRecordCount($rsData->getCount());
        
        while ($arData = $rsData->fetch())
        {
            $this->arResult["ROWS"][] = array(
                "data"    => array (
                    "ID"    =>    $arData["ID"],
                    'UF_ACTIVE' => $arData['UF_ACTIVE'],
                    'UF_ADRESS' => $arData['UF_ADRESS'],
//                    'UF_USERID' => $arData['UF_USERID']
                )
            );
        }
        
        $this->arResult["SORT"] = $Sort["sort"];
        $this->arResult["SORT_VARS"] = $Sort["vars"];
        $this->arResult["NAV_OBJECT"] = $nav;
        
        $this->includeComponentTemplate();
    }
}