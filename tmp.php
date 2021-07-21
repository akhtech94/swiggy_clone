<?php
class Test {
  private $numberOfRows = "Undefined";

  public function rowCount() {
    return $this->numberOfRows;
  }

  public function execute() {
    $this->numberOfRows = 10;
  }
}

$test = new Test();
echo $test->rowCount()."<br>";
$test->execute();
echo $test->rowCount();
?>