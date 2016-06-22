<?php
/**
 * A featured content slider
 *
 * @package cultural
 */
?>

<div class="ng-hide" ng-show="svc.data.initialSearch > 3 || svc.data.linguagens.length || svc.data.spaces.length || svc.data.projects.length || keyword">	
	<h3 class="aligncenter texcenter" ng-if="!loading">{{events.length}} {{events.length == 1 ? '<?php _e('evento encontrado', 

'cultural'); ?>' : '<?php _e('eventos encontrados', 'cultural'); ?>'}}</h3>

    <div ng-if="loading">
        <div class="spinner-bars">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>

    <div class="events-list grid js-events-masonry" ng-show="!loading">
        <div class="grid-sizer"></div>
        <div class="gutter-sizer"></div>

     <div class="event  event-container" ng-repeat="event in events" repeat-done="updateMasonry()">
   <!--            <figure ng-if="event['@files:avatar.avatarMedium']" class="event__image" style="background:transparent" >
                <img src="{{event['@files:avatar.avatarMedium'].url}}" alt="{{event.name}}" style="width:100%"/>
            </figure>-->
            <div class="event-data">
                <h1 class="event__title">
                    {{event.name}}
                    <!--<a href="{{event.singleUrl}}" target="_blank"><i class="fa fa-external-link"></i></a>-->
                    <span class="event__subtitle">{{event.subTitle}}</span>
                </h1>


                <div class="event__occurrences" ng-repeat="occs in event.occurrences" ng-if="occs.inPeriod">
                    <div class="event__venue">
                        <a href="{{occs.space.singleUrl}}">{{occs.space.name}}</a>
                        <div class="event__time">{{event.occurrence}}</div>
                    </div>
                   <div class="event__time">{{occs.rule.description}}</div>
                   <div class="event_time">
					<b>Endereço: </b>{{occs.endereco.endereco}}
                   </div>
                    <!-- <div class="event__time" data-edit="endereco" >Endereco</div><br /> -->
                        <!--  <div ng-controller="BasicCenterController" ng-init="init(occs.space.location.latitude,occs.space.location.longitude)">
						<leaflet lf-center="london" width="100%" height="320px" markers="markers" ></leaflet>
					</div>-->
			
					<hr/>
                    <div class="event__time">            
                        <figure ng-if="occs.space.avatar.avatarBig.url" class="event__image " style="background:transparent" >
                            <img ng-src="{{occs.space.avatar.avatarBig.url}}" alt="{{event.name}}" class="caixa_corte imagem-eventos" />
                        </figure>{{event.shortDescription}}
                    </div>
                <!--a href="#" class="js-more-occurrences"><i class="fa fa-plus-circle"></i></a-->
                </div>

               <!-- <div class="event__languages" style="margin: -10px 0 10px 0">
                    <h4 class="event__languages--title">{{event.terms.linguagem.length == 1 ? '<?php _e('Linguagem', 'cultural'); 

?>' : '<?php _e('Linguagens', 'cultural'); ?>'}}:</h4> {{event.terms.linguagem.join(', ')}}
                </div> -->
                <span class="event__classification classificacao_etaria_livre" ng-if="event.classificacaoEtaria == 'Livre'">{{event.classificacaoEtaria}}</span>
                <span class="event__classification classificacao_etaria_10" ng-if="event.classificacaoEtaria == '10 anos'">{{event.classificacaoEtaria}}</span>
                <span class="event__classification classificacao_etaria_12" ng-if="event.classificacaoEtaria == '12 anos'">{{event.classificacaoEtaria}}</span>
                <span class="event__classification classificacao_etaria_14" ng-if="event.classificacaoEtaria == '14 anos'">{{event.classificacaoEtaria}}</span>
                <span class="event__classification classificacao_etaria_16" ng-if="event.classificacaoEtaria == '16 anos'">{{event.classificacaoEtaria}}</span>
                <span class="event__classification classificacao_etaria_18" ng-if="event.classificacaoEtaria == '18 anos'">{{event.classificacaoEtaria}}</span>
                
                <div class="event__price">
                    <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-usd fa-stack-1x fa-inverse"></i>
                    </span>
                    {{event.occurrences[0].rule.price}}
                </div>

                <div ng-if="event.traducaoLibras == 'Sim' && event.descricaoSonora == 'Sim'" 

class="event__accessibility"><strong>acessibilidade:</strong> Tradução para LIBRAS, Áudio descrição</div>
                <div ng-if="event.traducaoLibras == 'Sim' && event.descricaoSonora != 'Sim'" 

class="event__accessibility"><strong>acessibilidade:</strong> Tradução para LIBRAS</div>
                <div ng-if="event.traducaoLibras != 'Sim' && event.descricaoSonora == 'Sim'" 

class="event__accessibility"><strong>acessibilidade:</strong> Áudio descrição</div>
                
               <!--                <div ng-if="event.project.name">
                    <h4>projeto:</h4>
                    <a href="{{event.project.singleUrl}}">{{event.project.name}}</a>
                </div>
 <div ng-if="event.owner.name">
                    <h4>publicado por:</h4>
                    <a href="{{event.owner.singleUrl}}">{{event.owner.name}}</a>
                </div> -->
                <a href="{{event.singleUrl}}" target="_blank" class="event__info"><?php _e('Leia mais', 'cultural'); ?></a>
            </div>
        </div>

    </div>

</div>

<?php
$args = array('ignore_sticky_posts' => 1, 'posts_per_page' => '4');

$featured_posts = Cultural_Hightlights::getHighlightedQuery();

if ($featured_posts->have_posts()) :
    ?>
    <div class="swiper  js-swiper">
        <h3 class="slider-title"><i class="fa fa-bullhorn"></i> <?php _e('Destaque', 'cultural'); ?></h3>
        <div class="swiper-wrapper">
            <?php while ($featured_posts->have_posts()) : $featured_posts->the_post(); ?>
                <article class="swiper-slide">
                    <?php if (has_post_thumbnail()) the_post_thumbnail(); ?>
                    <div class="slide-content">
                        <?php the_title(sprintf('<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h1>'); ?>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="read-more"><i class="fa fa-align-left"></i> <?php _e('Leia mais', 'cultural'); ?></a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
        <?php if($featured_posts->found_posts > 1): ?>
            <div class="swiper__pagination"></div>
        <?php else: ?>
            <div class="swiper__pagination" style="display:none"></div>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
