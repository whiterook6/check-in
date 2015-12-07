(function(){
	angular.module('Check-in', ['ngResource', 'angular-loading-bar', 'ngAnimate'])
		.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
			cfpLoadingBarProvider.includeSpinner = false;
		}]);
})();
