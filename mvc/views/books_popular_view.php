<!-- Nepszeru konyvek megjelenitese -->
 
<?php if ($popularBooks): ?>
    <h3>Legnépszerűbb könyvek</h3>
    <ul>
        <?php foreach ($popularBooks as $book): ?>
            <li>
                <h4><?= htmlspecialchars($book['cim']) ?></h4>
                <p><strong>Leírás:</strong> <?= htmlspecialchars($book['leiras']) ?></p>
                <img src="<?= htmlspecialchars($book['boritokep_url']) ?>" alt="Borítókép">
                <p><strong>Átlagos értékelés:</strong> <?= htmlspecialchars(number_format($book['atlag_ertekeles'], 2)) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Nincs elérhető népszerű könyv.</p>
<?php endif; ?>
