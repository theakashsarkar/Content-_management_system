<?php
$sql = "SELECT  p.id, p.title, p.tags, p.createDate, p.userId, p.hitCount,
  c.name as category from pages p
  left join category as c on p.category = c.id where p.id = " . $_GET['article'];
$table = mysqli_query( $dbConnect, $sql );
print '<div class="summery"> Total ' . mysqli_num_rows( $table ) . ' Artical Found In This Category</div><hr><br>';

while ( $row = mysqli_fetch_assoc( $table ) ) {
    print '<div class="atricle">';
    print '<h1>' . $row['title'] . '</h1>';
    print '<h3>' . $row["tags"] . '</h3>';
    print '<h2> Create on:' . $row['createDate'] . ', By : ';
    print $row["userId"] . ', in :' . $row["category"] . 'Page Hit : ' . $row['hitCount'] . '</h2>';
    print '<div class="images">';
    findImages( $row['id'] );
    print '</div>';
    $fileName = "airtel/" . str_replace( " ", "_", trim( $row['title'] ) ) . ".html";
    $file = fopen( $fileName, "r" );
    $content = fread( $file, filesize( $fileName ) );
    print '<div>' . $content . '</div>';
    print '<div> Like : <a href="#">0</a>, Comment: <a href="#">0</a></div>';
    print '</div>';
    $comment = '';
    $errComment = '';

    if ( isset( $_POST['submit'] ) ) {
        $comment = $_POST['comment'];
        $error = 0;

        if ( $comment == '' ) {
            $error++;
            $errComment = '<span class="error">Required Comment</span>';
        }
        if ( $error == 0 ) {
            $sql = "INSERT INTO pagesComment(pageId,userId,comment) VALUES (" . $_GET['article'] . ",1,'" . $comment . "')";
            if ( !mysqli_query( $dbConnect, $sql ) ) {
                print '<span class="error">' . mysqli_error( $dbConnect ) . '</span>';
            }
        }
    }
}
?>
  <form action="" method="post">
    <textarea name="comment" id="" cols="30" rows="10"></textarea>
    <input type="submit" value="comment" name="submit">


  </form>
  <?php
$sql = "SELECT id, pageId, userId, dataTime,comment FROM pagesComment WHERE pageId =" . $_GET['article'];
$table = mysqli_query( $dbConnect, $sql );
while ( $row = mysqli_fetch_assoc( $table ) ) {
    print '<div>';
    print '<h3>User : ' . $row['userId'] . ', DateTime : ' . $row['dataTime'] . '</h3>';
    print '<p>' . $row['comment'] . '</p>';
    print '</div>';
}
function findImages( $pid ) {
    global $dbConnect;
    $sql = "SELECT id,title,images FROM pageImages WHERE pageId = " . $pid;
    $table = mysqli_query( $dbConnect, $sql );
    while ( $row = mysqli_fetch_assoc( $table ) ) {
        print '<img src="upload/images' . $row["id"] . '_' . $row['image'] . '" title="' . $row['title'] . '"/>';
    }
}

?>