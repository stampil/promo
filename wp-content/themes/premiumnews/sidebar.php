<?php
$top_ten = 30;
?>

<div class="col2">

    <?php /* include('ads/ads-management.php'); */ ?>

    <?php /* include('ads/ads-top.php'); */ ?>

    <div class="sideTabs">

        <ul class="idTabs">
            <li><a href="#comm">TOP <?php echo $top_ten; ?> moins cher</a></li>
            <li><a href="#pop">TOP <?php echo $top_ten; ?> meilleur promo</a></li>
            


        </ul><!--/idTabs-->

    </div><!--/sideTabs-->

    <div class="fix" style="height:2px;"></div>

    <div class="navbox">

        <ul class="list1" id="pop">
            <?php
            global $bdd;
            $ret = $bdd->query('SELECT SQL_CALC_FOUND_ROWS * from game where creato=? order by percent desc, prix_apres asc LIMIT 1,'.$top_ten, array(date('Y-m-d')));
            ?>
            <table style="border:1px solid black;" width="100%">
                <tr>
                    <th width="120">Vignette</th>
                    <th>Titre</th>
                    <th width="45">Remise</th>
                    <th width="45">Prix</th>
                </tr>
                <?php
                foreach ($ret as $game) {
                    ?>
                    <tr onclick="window.open('<?php echo $game->link; ?>', '_blank');">
                        <td><img src="<?php echo $game->img; ?>" /></td>
                        <td class="padding"><?php echo $game->titre; ?></td>
                        <td class="padding" align="right">-<?php echo $game->percent; ?>%</td>
                        <td class="padding" align="right">
                            <div style="text-decoration: line-through;color:gray"><?php echo $game->prix_avant; ?>€</div>
                            <?php echo $game->prix_apres; ?>€
                        </td>
                    </tr>

                <?php } ?>
            </table>

        </ul>

        <ul class="list3" id="comm">
            <?php
            global $bdd;
            $ret = $bdd->query('SELECT SQL_CALC_FOUND_ROWS * from game where creato=? order by  prix_apres asc, titre LIMIT 1,'.$top_ten, array(date('Y-m-d')));
            ?>
            <table style="border:1px solid black;" width="100%">
                <tr>
                    <th width="120">Vignette</th>
                    <th>Titre</th>
                    <th width="45">Remise</th>
                    <th width="45">Prix</th>
                </tr>
                <?php
                foreach ($ret as $game) {
                    ?>
                    <tr onclick="window.open('<?php echo $game->link; ?>', '_blank');">
                        <td><img src="<?php echo $game->img; ?>" /></td>
                        <td class="padding"><?php echo $game->titre; ?></td>
                        <td class="padding" align="right">-<?php echo $game->percent; ?>%</td>
                        <td class="padding" align="right">
                            <div style="text-decoration: line-through;color:gray"><?php echo $game->prix_avant; ?>€</div>
                            <?php echo $game->prix_apres; ?>€
                        </td>
                    </tr>

                <?php } ?>
            </table>                  
        </ul>

        <ul class="list4" id="feat">
            <?php
            $featuredcat = get_option('woo_featured_category'); // ID of the Featured Category				
            $the_query = new WP_Query('category_name=' . $featuredcat . '&showposts=10&orderby=post_date&order=desc');
            while ($the_query->have_posts()) : $the_query->the_post();
                $do_not_duplicate = $post->ID;
                ?>

                <li><a title="<?php _e('Permanent Link to', woothemes); ?> <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>

            <?php endwhile; ?>		
        </ul>



    </div><!--/navbox-->



    <?php include('ads/ads-bottom.php'); ?>

    <div class="fix"></div>

    <!--/subcol-->

    <!--/subcol-->

</div><!--/col2-->
