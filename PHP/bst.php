<?php
  require_once("node.php");

  class bst {
    private $mSize;
    private $mRoot;

    public function __construct() {
      $this->mSize = 0;
      $this->mRoot = NULL;
    }

    public function insert($value) {
      if($this->exists($value)) {
        echo "Insert(): Value '" . $value . "' already exists in tree<br />";
        return;
      }
      if($this->mRoot == NULL) {
        $this->mRoot = new node($value);
        return;
      }
      $n = new node($value);
      $this->mRoot = $this->insertR($n, $this->mRoot);
    }

    public function insertR(node $node = NULL, node $current = NULL) {
      if($current == NULL) { $current = $node; }
      if($node->getData() < $current->getData()) {
        $current->setLeft($this->insertR($node, $current->getLeft()));
      } else if($node->getData() > $current->getData()) {
        $current->setRight($this->insertR($node, $current->getRight()));
      }
      return $current;
    }

    public function remove($value) {
      if(!$this->exists($value)) {
        echo "Remove(): Value '" . $value . "' doesn't exist in the tree<br />";
        return;
      }
      $this->mRoot = $this->removeR($value, $this->mRoot);
    }
    public function removeR($value, node $current = NULL) {
      if($current != NULL) {
        if($value < $current->getData()) {
          $current->setLeft($this->removeR($value, $current->getLeft()));
        } else if($value > $current->getData()) {
          $current->setRight($this->removeR($value, $current->getRight()));
        } else {
          //Leaf case
          if($current->getLeft() == NULL && $current->getRight() == NULL) {
            $current = NULL;
          //One left node case
          } else if ($current->getRight() == NULL) {
            $current = $current->getLeft();
          //One right child node case
          } else if ($current->getLeft() == NULL) {
            $current = $current->getRight();
          //Two child nodes case
          } else {
            $successor = $current->getRight();
            while($successor->getLeft() != NULL) {
              $successor = $successor->getLeft();
            }
            $current->setData($successor->getData());
            $current->setRight($this->removeR($successor->getData(), $current->getRight()));
          }
        }
      }
      return $current;
    }

    public function traverse($callback, &$args) {
      $this->traverseR($callback, $this->mRoot, $args);
    }

    public function traverseR(callable $callback, node $current, &$args) {
      if($current == NULL) { return; }
      //In order traversal
      if($current->getRight() != NULL) {
        $this->traverseR($callback, $current->getRight(), $args);
      }
      $callback($current, $args);
      if($current->getLeft() != NULL) {
        $this->traverseR($callback, $current->getLeft(), $args);
      }
    }

    //Custom defined callback function to total all nodes in the tree
    public function returnTotal($current, &$args) {
      $args += $current->getData();
    }

    public function exists($value) {
      if($this->mRoot == NULL) { return false; }
      $found = false;
      $this->existsR($value, $this->mRoot, $found);
      return $found;
    }

    public function existsR($value, node $current = NULL, &$e) {
      if($current != NULL) {
        if ($current->getData() == $value) { $e = true; }
        if($value < $current->getData()) {
          $this->existsR($value, $current->getLeft(), $e);
        } else if($value > $current->getData()) {
          $this->existsR($value, $current->getRight(), $e);
        }
      }
    }

    public function size() {
      if($this->mRoot == NULL) { return 0; }
      $total = 1;
      $this->sizeR($this->mRoot, $total);
      return $total;
    }

    public function sizeR(node $current = NULL, &$total) {
      if($current->getLeft() != NULL) {
        $total++;
        $this->sizeR($current->getLeft(), $total);
      }
      if($current->getRight() != NULL) {
        $total++;
        $this->sizeR($current->getRight(), $total);
      }
    }

    public function display() {
      if($this->size() <= 0) {
        echo "Display(): Tree is empty<br />";
        return;
      }
      $this->displayR($this->mRoot);
    }

    public function displayR(node $node) {
      //Pre-order
      echo $node->getData() . "<br />";
      if($node->getLeft() != NULL) { $this->displayR($node->getLeft()); }
      if($node->getRight() != NULL) { $this->displayR($node->getRight()); }
      //In-order
      /*if($node->getLeft() != NULL) { $this->displayR($node->getLeft()); }
      echo $node->getData() . "<br />";
      if($node->getRight() != NULL) { $this->displayR($node->getRight()); }*/
      //Post-order
      /*if($node->getLeft() != NULL) { $this->displayR($node->getLeft()); }
      if($node->getRight() != NULL) { $this->displayR($node->getRight()); }
      echo $node->getData() . "<br />";*/
    }
  };
  ?>
