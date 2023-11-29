<?php

function formatMoney($amount)
{
    $amountFloat = floatval($amount);
    return 'Q' . number_format($amountFloat, 2, '.', ',');
}
