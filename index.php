<?php get_header(); ?>
<script>
function alteraEstilo(){
	jQuery(".range_inputs").css("display","none");
	jQuery(".calendar").css("display","none");
}
</script>
<div class="content" ng-controller="eventsController">
	 <div class="filter-bar cf" <?php if(is_category()): ?> style="background: <?php echo $cat_color ?>" <?php endif; ?>>
        <div class="filter  filter-date">
            <span class="label"><?php _e('Data', 'cultural'); ?></span>
            <div class="date--picker">
                <i class="fa fa-calendar"></i>
                <!--

                Fonte do plugin jQuery Bootstrap: https://github.com/dangrossman/bootstrap-daterangepicker

                Diretiva Angular para o plugin: https://github.com/fragaria/angular-daterangepicker

                !important: O template, já um pouco modificado do daterangepicker está na linha 48 de js/lib/daterangpicker.js
                @TODO: Passar o template pra fora, aqui para o hipertexto

                -->
                <input class="form-control date-picker date" ng-model="dateRange" id="dateRange"
                       date-range-picker-home
                       style="padding-left:38px"
                       onfocus="this.blur();alteraEstilo()" 
                       onmouseenter="jQuery(this).click(); jQuery('.range_inputs').css('display','none'); jQuery('.calendar').css('display','none')">
            </div>
        </div>

        <div ng-if="data.linguagens.length > 1" class="filter" id="linguagens-home">
            <span class="label"><?php _e('Linguagem', 'cultural'); ?></span>
            <div class="dropdown">
                <div class="placeholder">
                    <span ng-if="!svc.data.linguagens.length"><?php _e('Selecione as linguagens', 'cultural'); ?></span>
                    <span ng-if="svc.data.linguagens.length">{{svc.data.linguagens.join(', ')}}</span>
                </div>
                <div class="submenu-dropdown">
                    <ul class="lista-de-filtro select">
                        <li ng-repeat="linguagem in data.linguagens" ng-class="{'selected': linguagem.active}" ng-click="toggleListItem('linguagens', linguagem)" class="ng-scope">
                            <span>{{linguagem.name}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
       <div  class="filter">
            <span class="label">Espaços</span>
            <div class="dropdown" id="dropdownSpaces">
                <div class="placeholder" id="spanSpaces">
                    <span ng-if="!svc.data.spaces.length"><?php _e('Selecione os espaços', 'cultural'); ?></span>
                    <span ng-if="svc.data.spaces.length">
						<span ng-repeat="space in svc.data.spaces">
							{{space.name}}{{$last ? '' : ', '}}
						</span>
						</span>
                </div>
                <input type="text" placeholder="Busca" id="inputSpaces" style="display:none" class="placeholder buscaSpaces" ng-model="filterValue" />
                <div class="submenu-dropdown">
                    <ul class="lista-de-filtro select">
                        <li ng-repeat="space in data.spaces | filter:filterItem" ng-class="{'selected': space.active}" ng-click="toggleListItem('spaces', space)" class="ng-scope">
                            <span>{{space.name}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
         <div  class="filter">
            <span class="label">Projetos</span>
            <div class="dropdown">
               
                 <div class="placeholder">
                    <span ng-if="!svc.data.projects.length"><?php _e('Selecione os projetos', 'cultural'); ?></span>
                    <span ng-if="svc.data.projects.length">
						<span ng-repeat="project in svc.data.projects">
							{{project.name}}{{$last ? '' : ', '}}
						</span>
						</span>
                </div>
                
                <div class="submenu-dropdown">
                    <ul class="lista-de-filtro select">
                        <li ng-repeat="project in data.projects" ng-class="{'selected': project.active}" ng-click="toggleListItem('projects', project)" class="ng-scope">
                            <span>{{project.name}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="filter filter-keyword">
            <label>
                <span class="label"><?php _e('Evento', 'cultural'); ?></span>
                <input type="text" ng-model="keyword" class="placeholder keyword">
            </label>
        </div>
    </div>
	<div class="centro">
    <?php get_template_part('partials/slider'); ?>
	
    <?php if (have_posts()) : ?>
	
        <div class="grid  js-masonry" data-masonry-options='{ "columnWidth": ".grid-sizer", "gutter": ".gutter-sizer", "itemSelector": ".hentry", "stamp": ".sticky" }'>
            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>
	
            <?php get_template_part('partials/loop') ?>

        </div><!-- /grid -->
	</div>
        <?php cultural_paging_nav(); ?>

    <?php else : ?>

        <?php get_template_part('content', 'none'); ?>

    <?php endif; ?>
</div><!-- /content -->

<?php get_footer(); ?>


