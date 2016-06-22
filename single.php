<?php
/**
 * The Template for displaying all single posts.
 *
 * @package cultural
 *
 */
get_header();
?>

<div class="content  content--sidebar">

    <?php while (have_posts()) : the_post(); ?>
	<div>
        <?php get_template_part('content', 'single'); ?>
	<div>
        <?php
        $entity_url = get_post_meta(get_the_ID(), 'mc-entity-relation', true);
        if($entity_url && MapasCulturais2Post::parseEventUrl($entity_url)):
            global $__event_url, $__image;
            $__image = 'avatar.avatarBig';
            $__event_url = $entity_url;
            ?>
            <?php get_template_part('partials/event-box'); ?>
        <?php endif; ?>
	</div>
	<br/>
	<div>
         <?php
        $entity_url = get_post_meta(get_the_ID(), 'mc-entity-relation-2', true);
        if($entity_url && MapasCulturais2Post::parseEventUrl($entity_url)):
            global $__event_url, $__image;
            $__image = 'avatar.avatarBig';
            $__event_url = $entity_url;
            ?>
            <?php get_template_part('partials/event-box'); ?>
        <?php endif; ?>
	</div>
        <br/>
	<div>
         <?php
        $entity_url = get_post_meta(get_the_ID(), 'mc-entity-relation-3', true);
        if($entity_url && MapasCulturais2Post::parseEventUrl($entity_url)):
            global $__event_url, $__image;
            $__image = 'avatar.avatarBig';
            $__event_url = $entity_url;
            ?>
            <?php get_template_part('partials/event-box'); ?>
        <?php endif; ?>
	</div>
        <br/>
	<div>
         <?php
        $entity_url = get_post_meta(get_the_ID(), 'mc-entity-relation-4', true);
        if($entity_url && MapasCulturais2Post::parseEventUrl($entity_url)):
            global $__event_url, $__image;
            $__image = 'avatar.avatarBig';
            $__event_url = $entity_url;
            ?>
            <?php get_template_part('partials/event-box'); ?>
        <?php endif; ?>
        </div>
        <br/>
	<div>
         <?php
        $entity_url = get_post_meta(get_the_ID(), 'mc-entity-relation-5', true);
        if($entity_url && MapasCulturais2Post::parseEventUrl($entity_url)):
            global $__event_url, $__image;
            $__image = 'avatar.avatarBig';
            $__event_url = $entity_url;
            ?>
            <?php get_template_part('partials/event-box'); ?>
        <?php endif; ?>
       	</div>
        <br/>
	<div>
         <?php
        $entity_url = get_post_meta(get_the_ID(), 'mc-entity-relation-6', true);
        if($entity_url && MapasCulturais2Post::parseEventUrl($entity_url)):
            global $__event_url, $__image;
            $__image = 'avatar.avatarBig';
            $__event_url = $entity_url;
            ?>
            <?php get_template_part('partials/event-box'); ?>
        <?php endif; ?>
        <br/>
	</div>
	

    <?php endwhile; // end of the loop. ?>
	</div>
</div><!-- #content .site-content --><!-- #primary .content-area -->

<?php get_sidebar('content'); ?>
<?php get_footer();
