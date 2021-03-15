<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?

if (!CModule::IncludeModule("iblock"))
    return;

function getFileSize($size)
{
    $arSize = [' байт',' Кб',' Мб',' Гб'];

    for ($num = 0; $size > 1024; $num++)
    {
        $size = $size / 1024;

        if ($num >= count($arSize))
            break;
    }

    $size = round($size, 2) . $arSize[$num];

    return $size;
}

$arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_TEXT',);
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'ACTIVE_DATE'=>'Y', 'ACTIVE'=>'Y');
$dbResultElement = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($obResultElement = $dbResultElement->GetNextElement())
{
    $arElements = $obResultElement->GetFields();

    $arProperties = [];
    $dbResultIBlockProperty = CIBlockProperty::GetList(Array('sort'=>'asc', 'name'=>'asc'), Array('ACTIVE'=>'Y', 'IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'PROPERTY_TYPE' => 'F'));
    while ($obResultIBlockProperty = $dbResultIBlockProperty->GetNext())
    {
        $dbResultProperty = CIBlockElement::GetProperty($arParams['IBLOCK_ID'], $arElements['ID'], array("sort" => "asc"), Array("CODE"=>$obResultIBlockProperty['CODE']));
        if($obResultProperty = $dbResultProperty->Fetch())
        {
            $fileInfo = CFile::GetFileArray($obResultProperty['VALUE']);
            $fileInfo['EXTENSION'] = new SplFileInfo($fileInfo['ORIGINAL_NAME']);
            $arElements['FILE'] = [
                'ID' => $fileInfo['ID'],
                'NAME' => $fileInfo['ORIGINAL_NAME'],
                'SIZE' => getFileSize($fileInfo['FILE_SIZE']),
                'PATH' => $fileInfo['SRC'],
                'EXTENSION' => $fileInfo['EXTENSION']->getExtension()
            ];
        }
    }

    $arButtons = CIBlock::GetPanelButtons(
        $arElements["IBLOCK_ID"],
        $arElements["ID"],
        0,
        array("SECTION_BUTTONS"=>false, "SESSID"=>false)
    );
    $arElements["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
    $arElements["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

    $arResult['ITEMS'][] = $arElements;
}

$this->IncludeComponentTemplate();
?>