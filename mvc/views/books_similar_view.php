<!-- Hasonlo konyvek megjelenitese -->

<?php if ($similarBooks): ?>
    <h3>Hasonló könyvek</h3>
    <ul>
        <?php foreach ($similarBooks as $book): ?>
            <li>
                <h4><?= htmlspecialchars($book['cim']) ?></h4>
                <p><strong>Leírás:</strong> <?= htmlspecialchars($book['leiras']) ?></p>
                <img src="<?= htmlspecialchars($book['boritokep_url']) ?>" alt="Borítókép">
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Nincsenek hasonló könyvek.</p>
<?php endif; ?>
