<header class="c-navbar u-mb-medium">
    <a class="c-navbar__brand u-mr-xsmall" href="<?php echo base_url() ?>" title="<?php echo APP_NAME ?>">
        <img alt="<?php echo APP_NAME ?>" src="<?php echo base_url(APP_LOGO) ?>" style="border-radius: 10px;">
    </a>
    <h1 class="c-navbar__title u-pr-medium">
        <?php echo APP_NAME ?>
    </h1>
    <!-- Navigation items that will be collapes and toggle in small viewports -->
    <nav class="c-nav collapse" id="main-nav">
        <div class="section" id="elementer-navigation">
            <div class="widget LinkList" data-version="2" id="LinkList2">
                <ul class="c-nav__list">
                    <li class="c-nav__item">
                        <a class="c-nav__link" href="<?php echo base_url() ?>" title="Home">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- // Navigation items -->
    <button class="c-nav-toggle u-ml-auto" data-target="#main-nav" data-toggle="collapse" type="button">
        <span class="c-nav-toggle__bar"></span>
        <span class="c-nav-toggle__bar"></span>
        <span class="c-nav-toggle__bar"></span>
    </button><!-- // .c-nav-toggle -->
</header>
