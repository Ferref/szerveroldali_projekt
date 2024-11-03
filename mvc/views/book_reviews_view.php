<!-- Konyv ertekelesek -->
 
<?php if ($reviews): ?>
    <h3>Vélemények és hozzászólások</h3>
    <ul>
        <?php foreach ($reviews as $review): ?>
            <li>
                <p><strong><?= htmlspecialchars($review['felhasznalo_nev']) ?>:</strong> <?= htmlspecialchars($review['velemeny']) ?></p>
                <p><em>Hozzászólás:</em> <?= htmlspecialchars($review['hozzaszolas']) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Ehhez a könyvhöz még nincsenek vélemények.</p>
<?php endif; ?>
