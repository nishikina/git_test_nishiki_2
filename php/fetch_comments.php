<?php
// データベース接続情報
$servername = "localhost"; // データベースのホスト名
$username = "root"; // データベースのユーザー名
$password = ""; // データベースのパスワード
$dbname = "git_test"; // 使用するデータベース名

try {
    // PDOインスタンスを作成
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // エラーモードを例外に設定
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // コメントを取得するクエリ
    $sql = "SELECT * FROM comments";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<div class='comments-container'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $subject = "";
            if ($row["subject"] === 1) {
                $subject = "錦さんへ";
            } elseif ($row["subject"] === 2) {
                $subject = "小山明さんへ";
            } elseif ($row["subject"] === 3) {
                $subject = "西口さんへ";
            } elseif ($row["subject"] === 4) {
                $subject = "西崎さんへ";
            } elseif ($row["subject"] === 5) {
                $subject = "和田さんへ";
            } elseif ($row["subject"] === 6) {
                $subject = "平山さんへ";
            } elseif ($row["subject"] === 7) {
                $subject = "村山さんへ";
            } elseif ($row["subject"] === 8) {
                $subject = "小山ゆさんへ";
            } elseif ($row["subject"] === 9) {
                $subject = "亀ケ澤さんへ";
            } elseif ($row["subject"] === 10) {
                $subject = "梅田さんへ";
            } elseif ($row["subject"] === 11) {
                $subject = "向平さんへ";
            }

            // 投稿日時を取得
            $posted_at = date("Y-m-d H:i:s", strtotime($row["created_at"]));

            echo "<div class='comment'>";
            echo "<table>";
            echo "<tr><td><strong>投稿日時:</strong></td><td>" . htmlspecialchars($posted_at, ENT_QUOTES, 'UTF-8') . "</td></tr>";
            echo "<tr><td><strong>件名:</strong></td><td>" . htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') . "</td></tr>";
            echo "<tr><td><strong>名前:</strong></td><td>" . htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8') . "</td></tr>";
            echo "<tr><td><strong>メールアドレス:</strong></td><td>" . htmlspecialchars($row["email"], ENT_QUOTES, 'UTF-8') . "</td></tr>";
            echo "<tr><td><strong>コメント:</strong></td><td>" . nl2br(htmlspecialchars($row["message"], ENT_QUOTES, 'UTF-8')) . "</td></tr>";
            echo "</table>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "コメントはありません (No comments)";
    }
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

// データベース接続を閉じる
$conn = null;
?>
