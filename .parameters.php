<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();





// Подключение выбора инфоблока

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];

$arSorts = Array("ASC"=>GetMessage("T_IBLOCK_DESC_ASC"), "DESC"=>GetMessage("T_IBLOCK_DESC_DESC"));
$arSortFields = Array(
	"ID"=>GetMessage("T_IBLOCK_DESC_FID"),
	"NAME"=>GetMessage("T_IBLOCK_DESC_FNAME"),
	"ACTIVE_FROM"=>GetMessage("T_IBLOCK_DESC_FACT"),
	"SORT"=>GetMessage("T_IBLOCK_DESC_FSORT"),
	"TIMESTAMP_X"=>GetMessage("T_IBLOCK_DESC_FTSAMP")
);


$arProperty = array();
if (0 < intval($arCurrentValues["IBLOCK_ID"]))
{
	$rsProp = CIBlockProperty::GetList(Array("name"=>"asc"), Array("IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
	while ($arr=$rsProp->Fetch())
	{
		if($arr["PROPERTY_TYPE"] == "F")
			$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}
// ---- Подключение выбора инфоблока
$arComponentParameters = array(
	"GROUPS" => array(
		"IMAGE" => array(
			"NAME" => GetMessage("SETTINGS_IMAGE")
		),
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DEC_LIST_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '',
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
		"ELEMENT_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_SECTION_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => '={$arResult["ID"]}',
		),
		"PROPERTY_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_PROPERTY"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"VALUES" => $arProperty,
			"ADDITIONAL_VALUES" => "Y",
		),
		"IMG_DETAIL" => array(
			"NAME" => GetMessage("IMG_DETAIL"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"PARENT" => "IMAGE",
		),
		"IMG_DETAIL_HEIGHT" => array(
			"NAME" => GetMessage("IMG_DETAIL_HEIGHT"),
			"TYPE" => "STING",
			"DEFAULT" => "300",
			"PARENT" => "IMAGE",
		),
		"IMG_DETAIL_WIDTH" => array(
			"NAME" => GetMessage("IMG_DETAIL_WIDTH"),
			"TYPE" => "STING",
			"DEFAULT" => "300",
			"PARENT" => "IMAGE",
		),
		"IMG_ALL_HEIGHT" => array(
			"NAME" => GetMessage("IMG_ALL_HEIGHT"),
			"TYPE" => "STING",
			"DEFAULT" => "100",
			"PARENT" => "IMAGE",
		),
		"IMG_ALL_WIDTH" => array(
			"NAME" => GetMessage("IMG_ALL_WIDTH"),
			"TYPE" => "STING",
			"DEFAULT" => "100",
			"PARENT" => "IMAGE",
		),
		"IMG_RESIZE" => array(
			"NAME" => GetMessage("IMG_RESIZE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"PARENT" => "IMAGE",
		),
	)
);


?>