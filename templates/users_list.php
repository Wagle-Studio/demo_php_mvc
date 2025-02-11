<ul>
    <?php foreach ($users as $user) {
        echo ("<li>");
        echo ("<p>{$user->getId()} - {$user->getEmail()}</p>");
        echo ("</li>");
    } ?>
</ul>