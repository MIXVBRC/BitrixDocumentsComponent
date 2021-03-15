<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
$this->setFrameMode(true);?>

<?/*
<div class="documents">
    <div class="row">
        <? foreach ($arResult['ITEMS'] as $arItem): ?>
            <div class="col-12 item">
                <h4 class="titile"><?= $arItem['NAME'] ?></h4>
                <p class="description"><?= $arItem['PREVIEW_TEXT'] ?></p>
                <a class="link" href="<?= $arItem['FILE']['PATH'] ?>" target="_blank" download>
                    <i class="icon" style="background-image: url('<?= SITE_TEMPLATE_PATH . '/images/file.svg' ?>')"></i>
                    <span class="file-name"><?= $arItem['FILE']['NAME'] ?></span>
                    <span class="file-size"><?= $arItem['FILE']['SIZE'] ?></span>
                </a>
            </div>
        <? endforeach; ?>
    </div>
</div>
*/?>

<div class="documents">
    <? foreach ($arResult['ITEMS'] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="row item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="col-md-8 file-info-left">
                <h4 class="title"><?= $arItem['NAME'] ?></h4>
                <? if($arItem['PREVIEW_TEXT']): ?><p class="description"><?= $arItem['PREVIEW_TEXT'] ?></p><? endif; ?>
                <a class="link-view" href="<?= $arItem['FILE']['PATH'] ?>" target="_blank">Предпросмотр документа: <span class="file-size"><?= $arItem['FILE']['SIZE'] ?></span></a>
            </div>
            <div class="col-md-4 file-info-right">
                <div class="file-extension"><?= $arItem['FILE']['EXTENSION'] ?></div>
                <a class="link-download" href="<?= $arItem['FILE']['PATH'] ?>" download>Скачать</a>
            </div>
        </div>
    <? endforeach; ?>
</div>

