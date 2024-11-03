<!-- Veletlenszeruen kivalasztott konyv megleneitese -->

<?php if ($book): ?>
    <div class="book">
        <h2><?= htmlspecialchars($book['cim']) ?></h2>
        <p><strong>Leírás:</strong> <?= htmlspecialchars($book['leiras']) ?></p>
        <img src="<?= htmlspecialchars($book['boritokep_url']) ?>" alt="Borítókép">
        <p><strong>Megjelenés éve:</strong> <?= htmlspecialchars($book['kiadasi_ev']) ?></p>
        <p><a href="<?= htmlspecialchars($book['link_amazon']) ?>">Amazon</a> | 
           <a href="<?= htmlspecialchars($book['link_bookline']) ?>">Bookline</a></p>
    </div>
<?php else: ?>
    <p>Nincs elérhető könyv!</p>
<?php endif; ?>
