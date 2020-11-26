<?php
function filterItemsByStoreId(array $items, $storeId)
{
    return array_filter($items, function($line) use($storeId){
        return $line['store_id'] == $storeId ;
    });
}

function formatMoneyToDatabase($prince)
{
    return str_replace(['.',','],['', '.'], $prince);
}