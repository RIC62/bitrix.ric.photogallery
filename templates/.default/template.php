<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>

<?
$i=0;
$title = array();
$arrIMG = array();

foreach($arResult[$arParams['PROPERTY_CODE']] as $arrImages) {
	if($arParams['IMG_RESIZE'] == "Y") {
		$file= CFile::GetFileArray($arrImages["ID"]);
		$title[$i]= $file["DESCRIPTION"];
		$renderImage = CFile::ResizeImageGet($arrImages["ID"], Array("width" => $arrImages["WIDTH"], "height" => $arrImages["HEIGHT"]), "BX_RESIZE_IMAGE_PROPORTIONAL_ALT");
		$arrIMG[] = CFile::ShowImage($renderImage['src'], $renderImage["WIDTH"], $renderImage["HEIGHT"], "border=0 title='".$title[$i]."' alt='".$title[$i]."'", $arrImages['SRC'], true);

	}
	else{
		$file= CFile::GetFileArray($arrImages["ID"]);
		$title[$i]= $file["DESCRIPTION"];
		$arrIMG[] = CFile::ResizeImageGet($arrImages["ID"], Array("width" => $arrImages["WIDTH"], "height" => $arrImages["HEIGHT"]),"BX_RESIZE_IMAGE_PROPORTIONAL_ALT");
	}
	$i++;
}


// Get img code


$i=0;
foreach($arrIMG as $img) {
	$result .= '<div class="ric-img-box">';
	if($arParams['IMG_RESIZE'] == "Y") {
		$result .= '<a class="photogallery" title="'.$title[$i].'" href="'.$arResult[$arParams['PROPERTY_CODE']][$i]["SRC"].'" rel="group1" >'.$img.'</a>';
	}else{
		$result .= '<a class="photogallery" title="'.$title[$i].'" href="'.$arResult[$arParams['PROPERTY_CODE']][$i]["SRC"].'" rel="group1" >';
		$result .= '<img title="'.$title[$i].'" src="'.$img["src"].'" WIDTH="'.$arResult[$arParams['PROPERTY_CODE']][$i]["WIDTH"].'" HEIGHT="'.$arResult[$arParams['PROPERTY_CODE']][$i]["HEIGHT"].'" />';
		$result .= '</a>';
	}
	$result .= '</div>';
	$i++;
}?>

<div class="ric-main-photogallery">
	<?=$result?>
</div>