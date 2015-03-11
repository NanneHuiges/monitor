<?php

namespace Monitor\Controller;

class Home
{

  public function render()
  {
    $db = \Monitor\Database::instance();
    $stmt = $db->prepare("SELECT * FROM probes ORDER BY `datetime` DESC LIMIT 50");
    $stmt->execute();

    $probes = array();
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $probes[] = $row;
    }

    $smarty = new \Smarty;
    $smarty->assign('probes', $probes);
    $smarty->addPluginsDir('plugins/');
    $smarty->setTemplateDir('view/');
    return $smarty->fetch('index.tpl');
  }

}