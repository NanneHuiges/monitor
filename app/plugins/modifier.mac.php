<?php

function smarty_modifier_mac($value)
{
  return strtoupper(implode(':', str_split(str_pad(base_convert($value, 10, 16), 12, "0", STR_PAD_LEFT), 2)));
}