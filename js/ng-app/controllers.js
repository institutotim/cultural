(function(angular){

    var app = angular.module('CulturalTheme');
		
    app.controller('eventsController', ['$rootScope', '$scope', '$log', '$location', '$timeout', 'searchService', '$sce', '$http', '$q', 'buscaEspacosService', 'buscaProjetosService', 'buscaEnderecoEspaco', function(
                                            $rootScope,   $scope,   $log,   $location,   $timeout,   searchService,   $sce, $http,  $q, buscaEspacosService, buscaProjetosService, buscaEnderecoEspaco){
						
		buscaEspacosService.getSpaces()
			.then(
			function(result) {
				
			//Busca somente de espaços com selo oficial da prefeitura
			var indice=0;
			var spaces = new Array();
			for(var i=0; i<result.length; i++) {
				if(result[i].isVerified){
					spaces.push(result[i]);
					indice++;
				}
			}	
			$scope.data.spaces = spaces;
		  },
		  function(error) {
			console.log(error.statusText);
		  }
		);	
		
		
		buscaProjetosService.getProjects()
			.then(
			function(result) {
				
			//Busca somente de espaços com selo oficial da prefeitura
			var indice=0;
			var projects = new Array();
			for(var i=0; i<result.length; i++) {
				if(result[i].isVerified){
					projects.push(result[i]);
					indice++;
				}
			}	
			$scope.data.projects = projects;
		  },
		  function(error) {
			console.log(error.statusText);
		  }
		);	
		
							
        $scope.keyword = "";
        $scope.mapasUrl = vars.apiUrl.replace('api/', '');

        var mapDataFunction = function(el, i){ return {id: i, name: el}; };
       
        $scope.data = {
            startDate: searchService.data.startDate,
            endDate: searchService.data.endDate
        };

        try{
            $scope.data.linguagens = vars.categoryFilters.linguagens.map(mapDataFunction);
        }catch (e){
            $scope.data.linguagens = vars.generalFilters.linguagens.map(mapDataFunction);
        }
		$scope.data.linguagens = vars.generalFilters.linguagens.map(mapDataFunction);
        try{
            $scope.data.classificacoes = vars.categoryFilters.classificacaoEtaria.map(mapDataFunction);
        }catch (e){
            $scope.data.classificacoes = vars.generalFilters.classificacaoEtaria.map(mapDataFunction);
        }
       
        
        $scope.svc = searchService;

        $scope.loading = false;

		searchService.submit().then(receiveSearch);

        function receiveSearch(events){
            $log.debug('receiveSearch events', events);
            var format = 'YYYY-MM-DD';
            var start = $scope.dateRange.startDate.format(format) + ' 00:00:00';
            var end = $scope.dateRange.endDate.format(format) + ' 00:00:00';

            events.forEach(function(e){
                e.occurrences.forEach(function(occ){
                    occ.inPeriod = (occ.startsOn.date >= start && occ.startsOn.date <= end) || (occ.startsOn.date <= end && occ.until && occ.until.date >= end);
                });
            });
            var $enderecos;
            buscaEnderecoEspaco.getEnderecos().then(function(result) {
					$scope.data.enderecos = result;
			},
			function(error) {
				console.log(error.statusText);
			});	
			
			
			//Busca o endereço do occurrence baseado no spaceId
			if($scope.data.enderecos){
				for(var i=0; i<events.length; i++) {
					for (var j = 0; j <events[i].occurrences.length; j++) {
							var occurrence = events[i].occurrences[j];
							for(var k=0; k<$scope.data.enderecos.length;k++){
								if(occurrence.spaceId == $scope.data.enderecos[k].id){
						
									events[i].occurrences[j].endereco = $scope.data.enderecos[k];
								}
							}						
					}
				}
		}
						
            $scope.events = events;
            $scope.loading = false;
        }

        $scope.complete = false;

        $scope.updateMasonry = function(){
            var $container = jQuery('.js-events-masonry');

            $timeout(function(){
                if(!$scope.complete){
                    $scope.complete = true;
                    $container.masonry({"columnWidth": ".grid-sizer", "gutter": ".gutter-sizer", "itemSelector": ".event"});
                }else{

                    $container.masonry('destroy');
                    $container.masonry({"columnWidth": ".grid-sizer", "gutter": ".gutter-sizer", "itemSelector": ".event"});
                }

                // initialize Masonry after all images have loaded
                $container.imagesLoaded(function() {
                    $container.masonry('destroy');
                    $container.masonry({"columnWidth": ".grid-sizer", "gutter": ".gutter-sizer", "itemSelector": ".event"});
                });
            },0);

        };


        $scope.dateRange = {
            startDate: $scope.data.startDate,
            endDate: $scope.data.endDate
        };

        var keywordTimeout;

        $scope.$watch('keyword', function(){
            $scope.loading = true;
            if(keywordTimeout){
                $timeout.cancel(keywordTimeout);
            }
            keywordTimeout = $timeout(function(){
                searchService.data.keyword = $scope.keyword;
                searchService.submit().then(receiveSearch);
            },500);
        });

        $scope.$watch('dateRange', function(){
            $scope.loading = true;
            searchService.data.startDate = $scope.dateRange.startDate;
            searchService.data.endDate = $scope.dateRange.endDate;
            searchService.submit().then(receiveSearch);
        });

        $scope.toggleListItem = function(list, item){
            $scope.loading = true;
            $log.debug($scope.data[list]);
            $scope.data[list].some(function(i){
                if(i === item){
                    i.active = !i.active;
                    $log.debug(i, item);
                    if(i.active){
						if(list == 'spaces' || list == 'projects'){						
							searchService.data[list].push(i);
                       }else{
						   searchService.data[list].push(i.name);
					   }
                    }else{
                        searchService.data[list].some(function(j, jindex){
							
							//Remover os espacos ou projetos que sairam da busca
							if(list == 'spaces' || list == 'projects'){								
								if(j.id === item.id){							
									searchService.data[list].splice(jindex, 1);
								}
							}else{
								if(j === item.name){
									searchService.data[list].splice(jindex, 1);
								}
							}
                        });
                    }
                }
            });
            searchService.submit().then(receiveSearch);
            
            $log.debug($scope.data[list]);
        };
 
 $scope.filterItem = function(item) {
		  if (!$scope.filterValue) return true;
		  
			var found = item.name.toLowerCase().indexOf($scope.filterValue.toLowerCase()) != -1;
		  
		  if (!found) {          
				angular.forEach(item.children, function(item) {
			  var match = $scope.filterItem(item);
			  if (match) {
				found = true;
			  }
				});
		  }
	  
			return found;
		};
    }]);



    app.controller('eventListController', ['$rootScope', '$scope', '$log', '$location', '$timeout', 'searchService', '$sce', function(
                                            $rootScope,   $scope,   $log,   $location,   $timeout,   searchService,   $sce){

        function receiveSearch (events){
            //$scope.events = events;
            for(var event in events){
                events[event].dateFormatted = moment(events[event].programacao_plain_date[0]).format('DD.MM.YYYY');
                events[event].timeFormatted = events[event].programacao.hora[0];
                events[event].excerpt = $sce.trustAsHtml(events[event].excerpt);
            }
            events.sort(function(a,b){
                return moment(a.programacao_plain_date[0]).diff(b.programacao_plain_date[0],'days');
            });
            $scope.events = events;
        }
        $rootScope.$on('searchDataChange', function(){
			alert('changed');
            searchService.submit().then(receiveSearch);
        });
        var first = false;

        $scope.updateMasonry = function(){
            var $container = jQuery('.results--content');
            if(!first) first = true; else $container.masonry('destroy');
            // initialize Masonry after all images have loaded
            $container.imagesLoaded(function() {
                $container.masonry({
                    "itemSelector": '.masonry-item',
                    "gutter": 0
                });
            });


            $scope.removeFilters = function(){
                $rootScope.$broadcast('removeFilters');
            };

            $scope.isFiltered = function(){
                return searchService.isFiltered();
            };
        };
    }]);

    app.directive('repeatDone', function() {
        return function(scope, element, attrs) {
            if (scope.$last) { // all are rendered
                scope.$eval(attrs.repeatDone);
            }
        };
    });
    
        app.controller('BasicCenterController', [ '$scope', function($scope) {
			
			 $scope.init = function(latitude, longitude)
			  {
				  var mainMarker = {
                lat: parseFloat(latitude),
                    lng: parseFloat(longitude),
                focus: true
            };
				  //This function is sort of private constructor for controller
				angular.extend($scope, {
                london: {
                   lat: parseFloat(latitude),
                    lng: parseFloat(longitude),
                    zoom: 17
                },
                markers: {
                    mainMarker: angular.copy(mainMarker)
                },
            });
			  }
            
       }]);
})(window.angular);
