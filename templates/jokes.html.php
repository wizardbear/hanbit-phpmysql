
<p><?=$totalJokes?>개 유머글이 있습니다.</p>

<?php foreach ($jokes as $joke): ?>
    <blockquote>
        <p>
            <?=htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8')?>

            (by <a href="mailto:<?=htmlspecialchars($joke['email'], ENT_QUOTES, 'UTF-8'); ?>">
                <?=htmlspecialchars($joke['name'], ENT_QUOTES, 'UTF-8'); ?></a>
            작성일:
            <?php
            $date = new DateTime($joke['jokedate']);

            echo $date->format('jS F Y');
            ?>)
            <a href="index.php?action=edit&id=<?=$joke['id']?>">수정</a>
            <form action="index.php?action=delete" method="post">
                <input type="hidden" name="id" value="<?=$joke['id']?>">
                <input type="submit" value="삭제">
            </form>
        </p>
    </blockquote>
<?php endforeach; ?>