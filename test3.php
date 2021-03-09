<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Каталог товаров");
?>
<?
define('IBLOCK_PRODUCTS_ID', 2);
if (CModule::IncludeModule("iblock")) {
    $arSelect = array(
                    "ID",
                    "NAME",
                    "PROPERTY_PRICE"
                    );
    $arFilter = array(
                    "IBLOCK_ID" => IBLOCK_PRODUCTS_ID,
                    "ACTIVE" => "Y"
                    );
    $res = CIBlockElement::GetList(array("NAME" => "ASC"),
                                    $arFilter,
                                    false,
                                    false,
                                    $arSelect
                                    );

    echo "<table id='price'>
            <tbody>
                <tr class='header_table'>
                    <th>Название</th>
                    <th>Цена, руб.</th>
                </tr>";
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        echo "<tr>
                <td>{$arFields['NAME']}</td>
                <td>{$arFields['PROPERTY_PRICE_VALUE']}</td>
              </tr>";
    }
    echo "<tbody>
        <table>";
}
?>
    <style>
        #price {
            border: 1px solid #ccc;
            border-collapse: collapse;
            width: 90%
        }

        #price tr:not(:first-child) {
            cursor: pointer;
        }

        #price td, th {
            border: 1px solid #ccc;
            padding: 4px;
        }

        .colorize {
            background: #ccc;
        }
    </style>

    <script>
        BX.ready(function () {
            BX.bindDelegate(
                BX('price'),
                'click',
                {
                    tagName: 'tr'
                },
                function () {
                    if (!BX.hasClass(this, 'header_table')) {
                        BX.toggleClass(this, ["colorize"]);
                    }
                }
            );
        });
    </script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>