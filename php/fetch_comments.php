<?php
// データベース接続情報
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "git_test";

try {
    // PDOインスタンスを作成
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // エラーモードを例外に設定
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // コメントを取得するクエリ
    $sql = "SELECT * FROM comments";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $comments = "";

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $subject = "";
            if ($row["subject"] == 1) {
                $subject = "錦さんへ";
            } elseif ($row["subject"] == 2) {
                $subject = "小山明さんへ";
            } elseif ($row["subject"] == 3) {
                $subject = "西口さんへ";
            } elseif ($row["subject"] == 4) {
                $subject = "西崎さんへ";
            } elseif ($row["subject"] == 5) {
                $subject = "和田さんへ";
            } elseif ($row["subject"] == 6) {
                $subject = "平山さんへ";
            } elseif ($row["subject"] == 7) {
                $subject = "村山さんへ";
            } elseif ($row["subject"] == 8) {
                $subject = "小山ゆさんへ";
            } elseif ($row["subject"] == 9) {
                $subject = "亀ケ澤さんへ";
            } elseif ($row["subject"] == 10) {
                $subject = "梅田さんへ";
            } elseif ($row["subject"] == 11) {
                $subject = "向平さんへ";
            }
            
            $comments .= "<p><strong>件名:</strong> " . $subject . "<br>";
            $comments .= "<strong>名前:</strong> " . $row["name"] . "<br>";
            $comments .= "<strong>メールアドレス:</strong> " . $row["email"] . "<br>";
            $comments .= "<strong>コメント:</strong> " . $row["message"] . "</p>";
        }
    } else {
        $comments = "コメントはありません (No comments)";
    }

    echo $comments;

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

$conn = null;
?>
