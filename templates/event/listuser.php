<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-12 col-xs-12 page-sidebar">
            <aside>
                <div class="inner-box">
                    <div class="categories">
                        <div class="widget-title">
                            <i class="fas fa-align-justify"></i>
                            <h4>All Categories</h4>
                        </div>
                        <div class="categories-list">
                            <ul>
                                <?php foreach ($topics as $topic){ ?>
                                    <li>
                                        <a href="index.php?module=event&action=search&topic_id=<?php echo $topic['id'] ?>">
                                            <i class="fas fa-desktop"></i>
                                            <?php echo $topic['name'] ?>
                                            <span class="category-counter"></span>
                                        </a>
                                    </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="inner-box">
                    <div class="widget-title">
                        <h4>Premium Ads</h4>
                    </div>
                    <div class="advimg">
                        <ul class="featured-list">
                            <li>
                                <img alt="" src="assets/img/featured/img1.jpg">
                                <div class="hover">
                                    <a href="#"><span>$49</span></a>
                                </div>
                            </li>
                            <li>
                                <img alt="" src="assets/img/featured/img2.jpg">
                                <div class="hover">
                                    <a href="#"><span>$49</span></a>
                                </div>
                            </li>
                            <li>
                                <img alt="" src="assets/img/featured/img3.jpg">
                                <div class="hover">
                                    <a href="#"><span>$49</span></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="inner-box">
                    <div class="widget-title">
                        <h4>Advertisement</h4>
                    </div>
                    <img src="assets/img/img1.jpg" alt="">
                </div>
            </aside>
        </div>
        <div class="col-lg-9 col-md-12 col-xs-12 page-content">

            <div class="product-filter">
                <div class="grid-list-count">
                    <a class="list switchToGrid" href="#"><i class="fas fa-list"></i></a>
                    <a class="grid switchToList" href="#"><i class="fas fa-th-large"></i></a>
                </div>
                <div class="short-name">
                    <span>Short By</span>
                    <form class="name-ordering" method="post">
                        <label>
                            <select id="order_select" name="order" class="column">
                                <option selected="selected" value="menu-order">Order by</option>
                                <option value="name">Ordre alphabetique</option>
                                <option value="id">ordre par ID</option>
                            </select>
                            <select id="direction_select" name="order" class="direction">
                                <option selected="selected" value="menu-order">Direction</option>
                                <option value="asc">ASC</option>
                                <option value="desc">DESC</option>
                            </select>
                        </label>
                    </form>
                </div>
                <div class="Show-item">
                    <span>Show Items</span>
                    <form class="woocommerce-ordering" method="post">
                        <label>
                            <select name="order" class="orderby">
                                <option selected="selected" value="menu-order">49 items</option>
                                <option value="popularity">popularity</option>
                                <option value="popularity">Average ration</option>
                                <option value="popularity">newness</option>
                                <option value="popularity">price</option>
                            </select>
                        </label>
                    </form>
                </div>
            </div>


            <div class="adds-wrapper">



                <?php foreach ($events as $event) {?>
                    <div class="item-list">
                        <div class="row">
                            <div class="col-sm-2 no-padding photobox">
                                <div class="add-image">
                                    <a href="#"><img src="assets/upload/<?php echo $event['image']?>" alt=""></a>
                                    <span class="photo-count"><i class="fas fa-camera"></i>2</span>
                                </div>
                            </div>
                            <div class="col-sm-7 add-desc-box">
                                <div class="add-details">
                                    <h5 class="add-title"><a href="index.php?module=event&action=detail&id=<?php echo $event['id']?>"><?php echo $event['name']?></a></h5>
                                    <div class="info">
                                        <span class="add-type">B</span>
                                        <span class="date">
<i class="fas fa-clock"></i>
16:22:13 2020-02-29
</span> -
                                        <span class="category">Electronics</span> -
                                        <span class="item-location"><i class="fas fa-map-marker"></i> London </span>
                                    </div>
                                    <div class="item_desc">
                                        <a href="#">Donec ut quam felis. Cras egestas, quam in plac erat dictum, erat mauris inte rdum est nec.</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 float-right  price-box">
                                <h2 class="item-price"> $ 215</h2>
                                <a class="btn btn-danger btn-sm" href="index.php?module=event&action=delete&id=<?php echo $event['id']?>"><i class="fas fa-certificate"></i>
                                    <span>Supprimer</span></a>
                                <a class="btn btn-common btn-sm"> <i class="fas fa-eye"></i> <span>215</span> </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="col-12">

                <div class="pagination-bar">
                    <nav>
                        <ul class="pagination">
                            <?php if ($offset - 1){ ?>
                                <li class="page-item">
                                    <a class="page-link active" href="index.php?module=event&action=listuser&offset=<?php echo $offset-1?>">
                                        prev
                                    </a>
                                </li>
                            <?php }?>
                            <?php foreach ($pages as $i){?>
                                <li class="page-item">
                                    <a class="page-link active" href="index.php?module=event&action=listuser&offset=<?php echo $i+1?>">
                                        <?php echo $i+1;?>
                                    </a>
                                </li>
                            <?php }?>
                            <?php if ($offset <$pagesCount-1) { ?>
                                <li class="page-item">
                                    <a class="page-link active" href="index.php?module=event&action=listuser&offset=<?php echo $offset+1?>">
                                        next
                                    </a>
                                </li>
                            <?php }?>
                        </ul>
                    </nav>
                </div>

                <div class="post-promo text-center">
                    <h2> Do you get anything for sell ? </h2>
                    <h5>Sell your products online FOR FREE. It's easier than you think !</h5>
                    <a href="post-ads.html" class="btn btn-post btn-danger">Post a Free Ad </a>
                </div>
            </div>
        </div>
    </div>
</div>