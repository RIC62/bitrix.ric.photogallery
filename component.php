<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
if(!CModule::IncludeModule("iblock"))
	return;
// Get detail picture
$arResult = array();
$i=0;
if($arParams["IMG_DETAIL"] == "Y") {
	$el = CIBlockElement::GetList(array(), array("ID" => $arParams['ELEMENT_ID'], "IBLOCK_ID" => $arParams['IBLOCK_ID']), false, false)->GetNext();
	$arResult[$arParams['PROPERTY_CODE']][$i]['ID'] = $el["DETAIL_PICTURE"];
	$arResult[$arParams['PROPERTY_CODE']][$i]['SRC'] = CFile::GetPath($el["DETAIL_PICTURE"]);
	$arResult[$arParams['PROPERTY_CODE']][$i]['HEIGHT'] = $arParams['IMG_DETAIL_HEIGHT'];
	$arResult[$arParams['PROPERTY_CODE']][$i]['WIDTH'] = $arParams['IMG_DETAIL_WIDTH'];
}

// Get more pictures
$db_props = CIBlockElement::GetProperty($arParams['IBLOCK_ID'], $arParams['ELEMENT_ID'], array("sort" => "asc"), Array("CODE" => $arParams['PROPERTY_CODE']));

while($arr = $db_props->Fetch()){
	$i++;
	if($arr['VALUE']=='')break;
	$arResult[$arParams['PROPERTY_CODE']][$i]['ID'] = $arr['VALUE'];
	$arResult[$arParams['PROPERTY_CODE']][$i]['SRC'] = CFile::GetPath($arr['VALUE']);
	$arResult[$arParams['PROPERTY_CODE']][$i]['HEIGHT'] = $arParams['IMG_ALL_HEIGHT'];
	$arResult[$arParams['PROPERTY_CODE']][$i]['WIDTH'] = $arParams['IMG_ALL_WIDTH'];
}

$this->IncludeComponentTemplate();
?>