<?php if ($bookDetails): ?>
    <div class="book-details">
        <h2><?= htmlspecialchars($bookDetails['cim']) ?></h2>
        <p><strong>Leírás:</strong> <?= htmlspecialchars($bookDetails['leiras']) ?></p>
        <img src="<?= htmlspecialchars($bookDetails['boritokep_url']) ?>" alt="Borítókép">
        <p><strong>Megjelenés éve:</strong> <?= htmlspecialchars($bookDetails['kiadasi_ev']) ?></p>
        <p><strong>Átlagos értékelés:</strong> <?= htmlspecialchars(number_format($bookDetails['atlag_ertekeles'], 2)) ?></p>
    </div>

    <h3>Vélemények és hozzászólások</h3>
    <?php if ($reviews): ?>
        <ul>
            <?php foreach ($reviews as $review): ?>
                <li>
                    <p><strong><?= htmlspecialchars($review['felhasznalo_nev']) ?>:</strong> <?= htmlspecialchars($review['velemeny']) ?></p>
                    <p><em>Hozzászólás:</em> <?= htmlspecialchars($review['hozzaszolas']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nincsenek vélemények ehhez a könyvhöz.</p>
    <?php endif; ?>
<?php else: ?>
    <p>A megadott könyv nem található.</p>
<?php endif; ?>
