<?php
$search = "";
if ( isset( $_POST['btnSearch'] ) ) {
    $search = $_POST['search'];

}

?>
<form action="" method="post">
 <input type="text" name="search" value="<?php print $search;?>"/>
 <input type="submit" name="btnSearch" value="Search"/>

</form>
<?php
$dbConnect = mysqli_connect( "localhost", "root", "", "Cms" );
$a = array();

findSubCategory( $_GET['ctg'], $a );
if ( isset( $_GET['likeId'] ) && isset( $_SESSION['type'] ) ) {
    $sql = "INSERT INTO pageLike(pageId,userId) VALUES (" . $_GET['likeId'] . "," . $_SESSION['id'] . ")";
    mysqli_query( $dbConnect, $sql );
}
$sql = "SELECT  p.id, p.title, p.tags, p.createDate, p.userId, p.hitCount,
  c.name as category from pages p
  left join category, (SELECT count(id) FROM pagesComment WHERE pageId = p.id) AS comments
  as c on p.category = c.id where p.category in(" . implode( ",", $a ) . ")";
if ( $search != "" ) {
    $sql .= " and (p.title like '%" . ms( $search ) . "%' or p.tags like '%" . ms( $search ) . "%')";
}
$table = mysqli_query( $dbConnect, $sql );
$totalItem = mysqli_num_rows( $table );
$page = 1;
if ( isset( $_GET['page'] ) ) {
    $page = $_GET['page'];
}
$sql .= " limit " . (  ( $page - 1 ) * 4 ) . ", 4";
$table = mysqli_query( $dbConnect, $sql );
print '<div class="summery"> Total ' . (  (  ( $page - 1 ) * 4 ) + 1 ) . '-' . (  (  ( $page - 1 ) * 4 ) + 4 ) . '/' . $totalItem . ' Artical Found In This Category</div><hr><br>';
$lastPage = $totalItem / 4;
if ( $totalItem % 4 > 0 ) {
    $Lastpage += 1;
}
if ( $page > 1 ) {
    print '<a href="?c=' . $_GET['c'] . '&ctg=' . $_GET['ctg'] . '">First </a>';
    print '<a href="?c=' . $_GET['c'] . '&ctg=' . $_GET['ctg'] . '&page=' . ( $page - 1 ) . '">Previse </a>';
}
if ( $page < $lastPage ) {
    print '<a href="?c=' . $_GET['c'] . '&ctg=' . $_GET['ctg'] . '&page=' . ( $page + 1 ) . '">Next </a>';
    print '<a href="?c=' . $_GET['c'] . '&ctg=' . $_GET['ctg'] . '&page=' . $lastPage . '">Last </a>';
}
while ( $row = mysqli_fetch_assoc( $table ) ) {
    print '<div class="atricle">';
    print '<h1>' . $row['title'] . '</h1>';
    print '<h3>' . $row["tags"] . '</h3>';
    print '<h2> Create on:' . $row['createDate'] . ', By : ';
    print $row["userId"] . ', in :' . $row["category"] . 'Page Hit : ' . $row['hitCount'] . '</h2>';

    $fileName = "airtel/" . str_replace( " ", "_", trim( $row['title'] ) ) . ".html";
    $file = fopen( $fileName, "r" );
    $content = fread( $file, filesize( $fileName ) );
    print '<div>';
    findImages( $row['id'] );
    print substr( strip_tags( $content ), 0, 600 );
    print '<br>... .. . <a href="?c=articalDetails&article=' . $row["id"] . '">Read More</a></div>';
    print '<div>';
    $likeUsers = array();
    $likeUsersName = array();
    findLiks( $pid, $likeUsers, $likeUsersName );
    if ( isset( $_SESSION['type'] ) ) {
        if ( is_array( $_SESSION['id'], $likeUsers ) ) {
            print '<a herf="#">YOU AND OTHER LIKE </a>';
        } else {
            print '<a herf="?c=' . $_GET['c'] . '&ctg=' . $_GET['ctg'] . '&likeId=' . $row['id'] . '"Like : ';
        }
    } else {
        print 'like';
    }
    print '<a href="#" title="' . implode( "\n", $likeUsersName ) . '">' . count( $likeUsers ) . '</a>';
    print '</div>';
    print 'Comment: <a href="#">' . $row['comments'] . '</a></div>';
    print '</div>';
}
function findSubCategory( $cid, &$a ) {
    global $dbConnect;
    $a[] = $cid;
    $sql = "SELECT id from pages where category = " . $cid;
    $table = mysqli_query( $dbConnect, $sql );
    // 'memory_limit', '8192M');
    // memory_limit = '524M';
    while ( $row = mysqli_fetch_assoc( $table ) ) {
        $a[] = $row['id'];
        findSubCategory( $row['id'], $a );
    }
}
function findImages( $pid ) {
    global $dbConnect;
    $sql = "SELECT id,title,images FROM pageImages WHERE pageId = " . $pid . "limit 0, 1";
    $table = mysqli_query( $dbConnect, $sql );
    while ( $row = mysqli_fetch_assoc( $table ) ) {
        print '<img src="upload/images' . $row["id"] . '_' . $row['image'] . '" title="' . $row['title'] . '"/>';
    }
}
function findLiks( $pid, &$likeUsers, &$likeUsersName ) {
    global $dbConnect;
    $sql = "SELECT pl.userId, u.name AS user FROM pageLike As pl LEFT JOIN users AS u ON pl.userId = u.id WHERE pageId = " . $pid;
    $table = mysqli_query( $dbConnect, $sql );
    while ( $row = mysqli_fetch_assoc( $table ) ) {
        $$likeUsers = $row['userId'];
        $likeUsersName = $row['user'];
    }
    print '<a href="#" title="' . $s . '">' . mysqli_num_rows( $table ) . '</a>';
}

?>