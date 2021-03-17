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
            "NAME" => GetMessage("GROUPS_SETTINGS_NAME"),
            "SORT" => 100
        ]
	],
	"PARAMETERS" => [
        // Настройки связанных элементов
        "IBLOCK_ID" => [
            "PARENT" => "SETTINGS",
            "NAME" => GetMessage("GROUPS_IBLOCK_ID_NAME"),
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "N",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y",
            "SORT" => 100
        ],
        "CACHE_TIME" => ["DEFAULT" => 36000000], // CACHE_SETTINGS to PARENT
	]
];
