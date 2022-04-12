<?php
class Render {
  private static $ext = ".tsl";
  public static function draw(string $template, array $data = []) : void {
    $tpl = file_get_contents(__DIR__."/view/".$template.self::$ext);

    preg_match_all("/<\|.*?>/", $tpl, $matches);
    for($recursion = 0; $recursion < 2; $recursion++) {
      foreach ($matches[0] as $match) {
        if (preg_match("/^<\|t/", $match)) {
          preg_match_all("/\|t:(.*?)>/", $match, $params);
          $param = $params[1][0];
          $tpl_content = @file_get_contents(__DIR__."/view/".$param.self::$ext) . ""; // TODO: mile missing
          $tpl = str_replace($match, $tpl_content ?? "", $tpl);
        }
      }
    }

    preg_match_all("/<\|.*?>/", $tpl, $matches);

    foreach ($matches[0] as $match) {
      if (preg_match("/^<\|v/", $match)) {
        preg_match_all("/\|v:(.*?)>/", $match, $params);
        $param = $params[1][0];
        $tpl = str_replace($match, $data[$param] ?? "", $tpl);
      }
    }
    print $tpl;
  }
}