<?php
  require_once("bst.php");

  function testing() {
    $b = new bst;
    echo "Size of tree: " . $b->size() . "<br />";
    echo "-----Begin insert tests-----<br/>";
    $b->insert(5);
    $b->insert(3);
    $b->insert(8);
    $b->insert(-1);
    $b->insert(6);
    $b->insert(2);
    $b->insert(4);
    $b->insert(10);
    $b->insert(542445322345);
    //Oops! Value already exists
    $b->insert(4);
    $b->display();
    echo "-----End insert tests-----<br/><br/>";
    echo "-----Begin existence tests-----<br/>";
    echo $b->exists(5) ? "5 was found <br />" : "5 was not found <br />";
    echo $b->exists(3) ? "3 was found <br />" : "3 was not found <br />";
    echo $b->exists(8) ? "8 was found <br />" : "8 was not found <br />";
    echo $b->exists(-1) ? "-1 was found <br />" : "-1 was not found <br />";
    echo $b->exists(6) ? "6 was found <br />" : "6 was not found <br />";
    echo $b->exists(2) ? "2 was found <br />" : "2 was not found <br />";
    echo $b->exists(4) ? "4 was found <br />" : "4 was not found <br />";
    echo $b->exists(10) ? "10 was found <br />" : "10 was not found <br />";
    echo $b->exists(542445322345) ? "542445322345 was found <br />" : "542445322345 was not found <br />";
    //Non-existence cases
    echo $b->exists(2343) ? "2343 was found <br />" : "2343 was not found <br />";
    echo $b->exists(0) ? "0 was found <br />" : "0 was not found <br />";
    echo $b->exists(-14) ? "-14 was found <br />" : "-14 was not found <br />";
    echo "-----End existence tests-----<br /><br />";

    echo "Size of tree: " . $b->size() . "<br />";

    echo "-----Begin traversal method tests-----<br/>";
    //Use the returnTotal function defined inside of the class to return the total of
    //all the nodes in the tree
    $b->traverse([new bst(), 'returnTotal'], $total);
    echo "Total of all node values in the tree is: " . $total . "<br />";
    echo "Average of all node values: " . $total/$b->size() . "<br />";
    echo "-----End traversal function tests-----<br/><br/>";

    echo "-----Begin removal tests-----<br/>";
    $b->display();
    //2 Child case
    $b->remove(5);
    $b->display();
    //Right leaf case
    $b->remove(4);
    $b->display();
    //Left leaf case
    $b->remove(-1);
    $b->display();
    //Oops
    $b->remove(-20);
    //Remove remaining elements
    $b->remove(6);
    $b->remove(3);
    $b->remove(2);
    $b->remove(8);
    $b->remove(10);
    $b->remove(542445322345);
    //Tree now empty
    $b->size();
    $b->display();
    echo "-----End removal tests-----<br/><br/>";
  }

  testing();
?>
