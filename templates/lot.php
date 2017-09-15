<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php
            foreach ($categories as $value) : ?>
                <li class="nav__item">
                    <a href="all-lots.html"><?=$value?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <section class="lot-item container">
        <h2><?=$lots[$id]['name']?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="<?=$lots[$id]['url']?>" width="730" height="548" alt="<?=$lots[$id]['name']?>">
                </div>
                <p class="lot-item__category">Категория: <span><?=$lots[$id]['category']?></span></p>
                <p class="lot-item__description"><?=$lots[$id]['description']?></p>
            </div>
            <div class="lot-item__right">
                <?php if (isset($_SESSION['user'])): ?>
                <div class="lot-item__state">
                    <div class="lot-item__timer timer">
                        <?=set_lot_time_remaining();?>
                    </div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Текущая цена</span>
                            <span class="lot-item__cost"><?=$lots[$id]['price']?></span>
                        </div>
                        <div class="lot-item__min-cost">
                            Мин. ставка <span>12 000 р</span>
                        </div>
                    </div>
                    <?php
                    foreach ($user_bets as $bet) {
                        if ($bet["id"] === $_GET['id']) {
                            $is_bet_exist = true;
                        }
                    }
                    if (!$is_bet_exist) : ?>
                    <form class="lot-item__form" action="lot.php" method="post">
                        <p class="lot-item__form-item">
                            <span class="form__error"><?=$validation_errors['cost'];?></span>
                            <label for="cost">Ваша ставка</label>
                            <input id="cost" type="number" name="cost" placeholder="12 000" value="<?=$_POST['cost']?>">
                            <input type="hidden" name="lot-id" value="<?=$_GET['id']?>">
                            <input type="hidden" name="date" value="<?=strtotime('now');?>">
                        </p>
                        <button type="submit" class="button">Сделать ставку</button>
                    </form>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <div class="history">
                    <h3>История ставок (<span>4</span>)</h3>

                    <table class="history__list">
                        <?php foreach ($bets as $key => $value) : ?>
                            <tr class="history__item">
                                <td class="history__name"><?=$value['name']; ?></td>
                                <td class="history__price"><?=$value['price']; ?> р</td>
                                <td class="history__time"><?=format_time($value['ts']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>