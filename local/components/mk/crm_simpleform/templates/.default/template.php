<div class="mk-crm-form">
    <?php if (!empty($arResult['ERRORS'])): ?>
        <div class="mk-crm-form__errors">
            <?php foreach ($arResult['ERRORS'] as $err): ?>
                <div class="mk-crm-form__error"><?=htmlspecialcharsbx($err)?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($arResult['SUCCESS']): ?>
        <div class="mk-crm-form__success">
            Спасибо! Ваш вопрос отправлен. ID лида: <?= (int)$arResult['LEAD_ID']; ?>
        </div>
    <?php else: ?>
        <form method="post" action="">
            <?= bitrix_sessid_post(); ?>

            <label class="mk-crm-form__field">
                <span>Имя *</span>
                <input type="text" name="NAME" value="<?=htmlspecialcharsbx($_POST['NAME'] ?? '')?>" required>
            </label>

            <label class="mk-crm-form__field">
                <span>Возраст</span>
                <input type="number" name="AGE" min="0" max="120" value="<?=htmlspecialcharsbx($_POST['AGE'] ?? '')?>">
            </label>

            <label class="mk-crm-form__field">
                <span>Ваш вопрос *</span>
                <textarea name="QUESTION" rows="5" required><?=htmlspecialcharsbx($_POST['QUESTION'] ?? '')?></textarea>
            </label>

            <button type="submit" class="mk-crm-form__submit">Отправить</button>
        </form>
    <?php endif; ?>
</div>