<?php
    $link = mysqli_connect('localhost', 'root', '1234', 'bicycle');

    if(isset($_POST['gu'])) {
      $filtered = mysqli_real_escape_string($link, $_POST['gu']);
    }
  else {
    $filtered = mysqli_real_escape_string($link, $_GET['gu']);
  }

    $query = "select gu, name, bannap-rental AS '포화'
    from rentalreturn2
    where bannap-rental < 0 and gu='{$filtered}'
    ";

    $result = mysqli_query($link, $query);
    $article = '';
    while ($row = mysqli_fetch_array($result)) {
    $article .= '<tr><td>';
    $article .= $row['gu'];
    $article .= '</td><td>';
    $article .= $row['name'];
    $article .= '</td><td>';
    $article .= $row['포화'];
    $article .= '</td><tr>';

}
  mysqli_free_result($result);
  mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset = "utf-8">
  <title> 구별 부족 정보 </title>
<style>
  h2 {
    text-align: center;
  }
  th, td{
    text-align: center;
    padding: 10px;
    border-bottom: 1px
  }
  form {
    text-align: center;
  }
  table {
    width: 50%;
    margin: auto;
    height: 100px;
    text-align: center;
}
.atag {
  text-align: center;
}
</style>
</head>
<body>
    <div style="text-align : center;">
        <img src = "bike.png">
          <p></p>
    </div>
<br>
  <h2> 구별 자전거 부족 정보</h2>
  <div class ="atag">
  <a href="shortage.php"> 뒤로가기 </a>
</div>
  <br>
  <table>
              <tr>
                  <th>구</th>
                  <th>대여소 명</th>
                  <th>부족 개수</th>
              </tr>
              <?= $article ?>
          </table>
</body>
</html>
