<?php echo $header ?>

<article>
    <section>
        <header>
            <h1>首頁</h1>
        </header>
        <p>測試首頁渲染2，<?php echo $text; ?></p>
    </section>
</article>

<article>
    <header>
        <h2>最新消息</h2>
    </header>
    <?php foreach ($newsList as $k => $v) { ?>
        <section>
            <header>
                <h3><?php echo $v['title']; ?></h3>
            </header>
            <p><?php echo $v['content']; ?></p>
        </section>
    <?php } ?>
</article>

<?php echo $footer ?>