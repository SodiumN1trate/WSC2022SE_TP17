<?php
$submitted = explode("\n", file_get_contents('submittedAnswers.csv'));
$actual = explode("\n", file_get_contents('actualAnswers.csv'));

?>

<table>
    <thead>
        <tr>
            <th>Question</th>
            <th>Actual Answer</th>
            <th>Submitted Answer</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $score = 0;
        for($i = 0; $i < count($submitted); $i++) {
            if($submitted[$i] === $actual[$i]) {
                $score += 1;
            }
            echo "<tr>";
            echo "<td>" . $i + 1 . "</td>";
            echo "<td>" . $actual[$i] . "</td>";
            echo "<td>" . $submitted[$i] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<?php
    echo "Score: $score/" . count($submitted);
?>

<style>
    tr, td, th, table {
        border: 1px solid black;
    }
</style>