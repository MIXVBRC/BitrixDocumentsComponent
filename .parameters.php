<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if (!Bitrix\Main\Loader::includeModule('iblock'))
    return;

// TODO: Получение инфоблоков
$arIBlock = [];
$dbResult = CIBlock::GetList(['SORT' => 'ASC'], ['ACTIVE' => 'Y']);
while ($obResult = $dbResult->Fetch())
    $arIBlock[$obResult['ID']] = '['.$obResult['ID'].'] '.$obResult['NAME'];

$arComponentParameters = [
	"GROUPS" => [
        "SETTINGS" => [
            "NAME" => "Настройки",
            "SORT" => 100
        ]
	],
	"PARAMETERS" => [
        // Настройки связанных элементов
        "IBLOCK_ID" => [
            "PARENT" => "SETTINGS",
            "NAME" => "ID инфоблока",
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "N",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y",
            "SORT" => 100
        ]
	]
];
