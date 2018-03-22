<html>

<head>
    <title>TolkienDb</title>
</head>

<body>
<?php
include_once '/var/www/html/SecureWeb/lib.php';

$db=connect();


if(isset($_GET['s'])) {
    $s = $_GET['s'];
    switch ($s) {
        case 1:
            $sid = $_GET['sid'];
            if (isset($sid)) {
                echo "<tr> <td>Books</td></tr>";
                $query="select * from books where storyid=$sid";
                $result=mysqli_query($db, $query);
                while($row=mysqli_fetch_row($result)){
                    echo "<tr> <td> $row[0] </td><td> <a href=index.php?bid=$row[0]&s=2> $row[1] </a></td></tr> \n";
                }
            }
            break;
        case 2:
            $bid = $_GET['bid'];
            if (isset($bid)) {
                echo "<tr> <td>Characters</td></tr>";
                $query="select characterid, name from characters where characterid IN (select characterid from appears where bookid=$bid)";
                $result=mysqli_query($db, $query);
                while($row=mysqli_fetch_row($result)){
                    echo "<tr> <td> $row[0] </td><td> <a href=index.php?cid=$row[0]&s=3> $row[1] </a></td></tr> \n";
                }
                #select characterid, name from characters where characterid IN (select characterid from appears where bookid=(select bookid from books where title='The Hobbit'));
            }
            break;
        case 3:
        $cid = $_GET['cid'];
        if (isset($cid)) {
            echo "<tr> <td>Book</td></tr><tr> <td>Characters</td></tr><tr> <td>Story</td></tr>";
            $query = "select b.title, c.name, s.story from stories s,characters c, appears a, books b where a.characterid=c.characterid and a.characterid=$cid and b.bookid=a.bookid";
            $result = mysqli_query($db, $query);
            while ($row = mysqli_fetch_row($result)) {
                echo "<tr> <td> $row[0] </td><td> <a href=index.php?sid=$row[0]&s=1> $row[1] </a></td><td> $row[2] </td></tr> \n";
            }
        }
        default:
            echo "<tr> <td>Stories</td></tr>";
            $query="SELECT storyid, story from stories";
            $result=mysqli_query($db, $query);
            while($row=mysqli_fetch_row($result)){
                echo "<tr> <td> $row[0] </td><td> <a href=index.php?sid=$row[0]&s=1>$row[1] </a></td></tr> \n";
            }

    }
}else{
    echo "<tr> <td>Stories</td></tr>";
    $query="SELECT storyid, story from stories";
    $result=mysqli_query($db, $query);
    while($row=mysqli_fetch_row($result)){
        echo "<tr> <td> $row[0] </td><td> <a href=index.php?sid=$row[0]&s=1>$row[1] </a></td></tr> \n";
    }
}

?>
</body>
</html>