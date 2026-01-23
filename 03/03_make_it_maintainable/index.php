<?php
/* What's the Problem? 
    - PHP logic + HTML in one file
    - Works, but not scalable
    - Repetition will become a problem

    How can we refactor this code so it’s easier to maintain?
*/
/* 
    One thing I learned from this lab is that
    php allows array literals to be passed as arguments.
    I will likely use this to save time in Course Project
    Phase One. 
*/
class HTMLList{
    public $list; //list of items
    public function __construct($list){ //constructs HTMLList object
    $this->list = $list; // saves argument to $list
    } 
    public function displayList(): void { //function to display list in html
        foreach ($this->list as $item): //loop through list items
                echo "<li>" . $item . "</li>"; // display list item as li
        endforeach; //end list loop
    } 
}

$items = new HTMLList (["Home", "About", "Contact"]); //new HTMLList object

?>

<!DOCTYPE html>
<html>
    <head>
        <title>My PHP Page</title>
    </head>
    <body>
        <h1>Welcome</h1>
        <ul>
            <?php  $items->displayList();  
            //use displayList() function to display HTMLList object?> 
        </ul>
        <footer>
            <p>&copy; 2026</p>
        </footer>
    </body>
</html>