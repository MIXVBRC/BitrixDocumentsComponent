<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
$this->setFrameMode(true);?>

<?if($arResult['ITEMS']):?>
    <div class="documents">
        <? foreach ($arResult['ITEMS'] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="row documents__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="col-md-8 file-info-left">
                    <h4 class="documents__title"><?= $arItem['NAME'] ?></h4>
                    <? if($arItem['PREVIEW_TEXT']): ?><p class="documents__description"><?= $arItem['PREVIEW_TEXT'] ?></p><? endif; ?>
                    <a class="documents__link-view" href="<?= $arItem['FILE']['PATH'] ?>" target="_blank"><?=GetMessage('DOCUMENT_PREVIEW')?><span class="documents__file-size"><?= $arItem['FILE']['SIZE'] ?></span></a>
                </div>
                <div class="col-md-4 file-info-right">
                    <div class="documents__extension"><?= $arItem['FILE']['EXTENSION'] ?></div>
                    <a class="documents__download" href="<?= $arItem['FILE']['PATH'] ?>" download><?=GetMessage('DOCUMENT_DOWNLOAD')?></a>
                </div>
            </div>
        <? endforeach; ?>
    </div>
<?endif;?>