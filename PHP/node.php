<?php
  class node {
    private $data,
            $left,
            $right;

      public function __construct($d) {
        $this->data  = $d;
        $this->left  = NULL;
        $this->right = NULL;
      }
      public function setData($d)     { $this->data = $d; }
      public function getData()       { return $this->data; }
      public function setLeft($l)     { $this->left = $l; }
      public function getLeft()       { return $this->left; }
      public function setRight($r)    { $this->right = $r; }
      public function getRight()      { return $this->right; }
  }

?>
