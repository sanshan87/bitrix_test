<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//Make all properties present in order
//to prevent html table corruption

$arrayIds = array();
foreach($arResult["ITEMS"] as $key => $arElement)
{
	$arRes = array();
	foreach($arParams["PROPERTY_CODE"] as $pid)
	{
		$arRes[$pid] = CIBlockFormatProperties::GetDisplayValue($arElement, $arElement["PROPERTIES"][$pid], "catalog_out");
	}
	$arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"] = $arRes;
	$arrayIds[] = $arElement['ID'];
}
$arSelect = Array("ID", "PROPERTY_PRICE");
$arFilter = Array("IBLOCK_ID"=>2, "ACTIVE"=>"Y", "ID"=>$arrayIds);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
$arPrices = array();
while($ob = $res->GetNextElement())
{
	 
    $arFields = $ob->GetFields();
    $arPrices[$arFields['ID']] =  $arFields['PROPERTY_PRICE_VALUE'];

}

foreach($arResult["ITEMS"] as $key => $arElement)
{
	$arResult["ITEMS"][$key]['PRICE'] = $arPrices[$arElement['ID']];
}




?>