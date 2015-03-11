<?php

function smarty_modifier_color($int)
{
  return substr(str_pad(base_convert($int, 10, 16), 12, "0", STR_PAD_LEFT), 0, 6);
}